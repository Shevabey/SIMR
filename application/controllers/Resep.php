<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resep extends MY_Controller
{

    public function index()
    {
        $q = trim((string) $this->input->get('q'));
        $sql = "
            SELECT r.id, r.tanggal, r.total, p.nama AS pasien_nama, d.nama AS dokter_nama
            FROM resep r
            JOIN pasien p ON p.id = r.pasien_id
            JOIN dokter d ON d.id = r.dokter_id
        ";
        $params = [];
        if ($q !== '') {
            $sql .= " WHERE (p.nama LIKE ? OR d.nama LIKE ? OR r.tanggal LIKE ?) ";
            $like = '%' . $q . '%';
            $params = [$like, $like, $like];
        }
        $sql .= " ORDER BY r.id DESC ";
        $data['resep'] = $this->db->query($sql, $params)->result();
        $data['q'] = $q;

        $data['pasien'] = $this->db->get('pasien')->result();
        $data['dokter'] = $this->db->get('dokter')->result();
        $data['obat'] = $this->db->get('obat')->result();

        $this->template('resep/index', $data);
    }

    public function simpan()
    {
        $obatIds = $this->input->post('obat_id');
        $qtys = $this->input->post('qty');
        $hargas = $this->input->post('harga');
        $subtotals = $this->input->post('subtotal');
        $grandTotal = (int) $this->input->post('grand_total');

        if (empty($obatIds) || !is_array($obatIds)) {
            redirect('resep');
            return;
        }

        $this->db->trans_start();

        $resep = [
            'pasien_id' => $this->input->post('pasien_id'),
            'dokter_id' => $this->input->post('dokter_id'),
            'user_id' => $this->session->userdata('id'),
            'tanggal' => $this->input->post('tanggal') ?: date('Y-m-d'),
            'total' => $grandTotal
        ];

        $this->db->insert('resep', $resep);

        $resep_id = $this->db->insert_id();
        $detailRows = [];

        for ($i = 0; $i < count($obatIds); $i++) {
            if (empty($obatIds[$i])) {
                continue;
            }

            $detailRows[] = [
                'resep_id' => $resep_id,
                'obat_id' => (int) $obatIds[$i],
                'qty' => isset($qtys[$i]) ? (int) $qtys[$i] : 0,
                'harga' => isset($hargas[$i]) ? (int) $hargas[$i] : 0,
                'subtotal' => isset($subtotals[$i]) ? (int) $subtotals[$i] : 0
            ];
        }

        if (!empty($detailRows)) {
            $this->db->insert_batch('resep_detail', $detailRows);
        }

        $this->db->trans_complete();

        redirect('resep');
    }

    public function detail($id)
    {
        $data['header'] = $this->db->query("
            SELECT r.*, p.nama AS pasien_nama, d.nama AS dokter_nama, u.nama AS user_nama
            FROM resep r
            JOIN pasien p ON p.id = r.pasien_id
            JOIN dokter d ON d.id = r.dokter_id
            LEFT JOIN users u ON u.id = r.user_id
            WHERE r.id = ?
        ", [(int) $id])->row();

        $data['detail'] = $this->db->query("
            SELECT rd.*, o.nama_obat
            FROM resep_detail rd
            JOIN obat o ON o.id = rd.obat_id
            WHERE rd.resep_id = ?
        ", [(int) $id])->result();

        $this->load->view('resep/print', $data);
    }

    public function print($id)
    {
        $this->detail($id);
    }
}
