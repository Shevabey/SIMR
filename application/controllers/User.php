<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

    public function index()
    {
        $q = trim((string) $this->input->get('q'));
        if ($q !== '') {
            $this->db->group_start()
                ->like('nama', $q)
                ->or_like('username', $q)
                ->or_like('role', $q)
                ->group_end();
        }
        $data['q'] = $q;
        $data['user'] = $this->db->get('users')->result();

        $this->template('user/index', $data);
    }

    public function simpan()
    {
        $user_id = $this->input->post('user_id');
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'role' => $this->input->post('role')
        ];

        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = md5($password);
        }

        if (!empty($user_id)) {
            $this->db->update('users', $data, ['id' => $user_id]);
            $this->session->set_flashdata('success', 'Data user berhasil diperbarui.');
        } else {
            $data['password'] = md5($password);
            $this->db->insert('users', $data);
            $this->session->set_flashdata('success', 'Data user berhasil ditambahkan.');
        }

        redirect('user');
    }

    public function hapus($id)
    {
        $this->db->delete('users', ['id' => $id]);
        $this->session->set_flashdata('success', 'Data user berhasil dihapus.');

        redirect('user');
    }
}
