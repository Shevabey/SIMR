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
        $id = (int) $id;
        if ($id <= 0) {
            redirect('pasien');
            return;
        }

        $isUsed = $this->db->where('pasien_id', $id)->count_all_results('resep') > 0;
        if ($isUsed) {
            $this->session->set_flashdata('error', 'Pasien tidak bisa dihapus karena sudah dipakai pada data resep.');
            redirect('pasien');
            return;
        }

        $this->db->delete('pasien', ['id' => $id]);
        $this->session->set_flashdata('success', 'Data pasien berhasil dihapus.');

        redirect('pasien');
    }
}
