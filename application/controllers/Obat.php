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
        $data = [
            'nama_obat' => $this->input->post('nama_obat'),
            'stok' => $this->input->post('stok'),
            'harga' => $this->input->post('harga')
        ];

        $this->db->insert('obat', $data);

        redirect('obat');
    }

    public function hapus($id)
    {
        $this->db->delete('obat', ['id' => $id]);

        redirect('obat');
    }
}
