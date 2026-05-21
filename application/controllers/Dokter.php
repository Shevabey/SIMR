<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends MY_Controller
{

    public function index()
    {
        $q = trim((string) $this->input->get('q'));
        if ($q !== '') {
            $this->db->group_start()
                ->like('nama', $q)
                ->or_like('spesialis', $q)
                ->or_like('no_hp', $q)
                ->group_end();
        }
        $data['q'] = $q;
        $data['dokter'] = $this->db->get('dokter')->result();

        $this->template('dokter/index', $data);
    }

    public function simpan()
    {
        $dokter_id = $this->input->post('dokter_id');
        $data = [
            'nama' => $this->input->post('nama'),
            'spesialis' => $this->input->post('spesialis'),
            'no_hp' => $this->input->post('no_hp')
        ];

        if (!empty($dokter_id)) {
            $this->db->update('dokter', $data, ['id' => $dokter_id]);
            $this->session->set_flashdata('success', 'Data dokter berhasil diperbarui.');
        } else {
            $this->db->insert('dokter', $data);
            $this->session->set_flashdata('success', 'Data dokter berhasil ditambahkan.');
        }

        redirect('dokter');
    }

    public function hapus($id)
    {
        $id = (int) $id;
        if ($id <= 0) {
            redirect('dokter');
            return;
        }

        $isUsed = $this->db->where('dokter_id', $id)->count_all_results('resep') > 0;
        if ($isUsed) {
            $this->session->set_flashdata('error', 'Dokter tidak bisa dihapus karena sudah dipakai pada data resep.');
            redirect('dokter');
            return;
        }

        $this->db->delete('dokter', ['id' => $id]);
        $this->session->set_flashdata('success', 'Data dokter berhasil dihapus.');

        redirect('dokter');
    }
}
