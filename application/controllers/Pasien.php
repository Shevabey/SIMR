<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends MY_Controller
{

    public function index()
    {
        $q = trim((string) $this->input->get('q'));
        if ($q !== '') {
            $this->db->group_start()
                ->like('nama', $q)
                ->or_like('alamat', $q)
                ->or_like('no_hp', $q)
                ->group_end();
        }
        $data['q'] = $q;
        $data['pasien'] = $this->db->get('pasien')->result();

        $this->template('pasien/index', $data);
    }

    public function simpan()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir')
        ];

        $this->db->insert('pasien', $data);

        redirect('pasien');
    }

    public function hapus($id)
    {
        $this->db->delete('pasien', ['id' => $id]);

        redirect('pasien');
    }
}
