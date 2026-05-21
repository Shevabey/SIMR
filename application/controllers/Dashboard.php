<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function index()
    {
        $data['jumlah_pasien'] = $this->db->count_all('pasien');
        $data['jumlah_dokter'] = $this->db->count_all('dokter');
        $data['jumlah_obat'] = $this->db->count_all('obat');
        $data['jumlah_resep'] = $this->db->count_all('resep');

        $this->template('dashboard/index', $data);
    }
}
