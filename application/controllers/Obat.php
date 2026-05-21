<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends MY_Controller
{

    public function index()
    {
        $q = trim((string) $this->input->get('q'));
        if ($q !== '') {
            $this->db->group_start()
                ->like('nama_obat', $q)
                ->or_like('stok', $q)
                ->or_like('harga', $q)
                ->group_end();
        }
        $data['q'] = $q;
        $data['obat'] = $this->db->get('obat')->result();

        $this->template('obat/index', $data);
    }

    public function simpan()
    {
        $obat_id = $this->input->post('obat_id');
        $data = [
            'nama_obat' => $this->input->post('nama_obat'),
            'stok' => $this->input->post('stok'),
            'harga' => $this->input->post('harga')
        ];

        if (!empty($obat_id)) {
            $this->db->update('obat', $data, ['id' => $obat_id]);
            $this->session->set_flashdata('success', 'Data obat berhasil diperbarui.');
        } else {
            $this->db->insert('obat', $data);
            $this->session->set_flashdata('success', 'Data obat berhasil ditambahkan.');
        }

        redirect('obat');
    }

    public function hapus($id)
    {
        $id = (int) $id;
        if ($id <= 0) {
            redirect('obat');
            return;
        }

        $isUsed = $this->db->where('obat_id', $id)->count_all_results('resep_detail') > 0;
        if ($isUsed) {
            $this->session->set_flashdata('error', 'Obat tidak bisa dihapus karena sudah dipakai pada data resep.');
            redirect('obat');
            return;
        }

        $this->db->delete('obat', ['id' => $id]);
        $this->session->set_flashdata('success', 'Data obat berhasil dihapus.');

        redirect('obat');
    }
}
