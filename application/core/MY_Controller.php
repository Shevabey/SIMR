<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
    }

    public function template($view, $data = [])
    {
        $data['content'] = $view;
        $this->load->view('template/main', $data);
    }
}
