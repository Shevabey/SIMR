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
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'role' => $this->input->post('role')
        ];

        $this->db->insert('users', $data);

        redirect('user');
    }

    public function hapus($id)
    {
        $this->db->delete('users', ['id' => $id]);

        redirect('user');
    }
}
