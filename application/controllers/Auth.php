<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = (string) $this->input->post('password');
        $user = $this->db->get_where('users', ['username' => $username])->row();

        if ($user && $this->isPasswordValid($password, $user->password)) {

            $data = [
                'id' => $user->id,
                'nama' => $user->nama,
                'username' => $user->username,
                'role' => $user->role,
                'login' => true
            ];

            $this->session->set_userdata($data);

            redirect('dashboard');
        } else {
            $this->session->set_flashdata('auth_error', 'Login gagal. Username atau password salah.');
            redirect('auth');
        }
    }

    public function register()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => password_hash((string) $this->input->post('password'), PASSWORD_DEFAULT),
            'role' => 'admin'
        ];

        $this->db->insert('users', $data);

        redirect('auth');
    }
    public function register_view()
    {
        $this->load->view('auth/register');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    private function isPasswordValid($plainPassword, $storedPassword)
    {
        if (password_verify($plainPassword, $storedPassword)) {
            return true;
        }

        return md5($plainPassword) === $storedPassword;
    }
}
