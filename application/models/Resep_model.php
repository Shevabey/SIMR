<?php

class Resep_model extends CI_Model
{

    public function get_pasien()
    {
        return $this->db->get('pasien')->result();
    }

    public function get_dokter()
    {
        return $this->db->get('dokter')->result();
    }

    public function get_obat()
    {
        return $this->db->get('obat')->result();
    }

    public function insert_resep($data)
    {
        $this->db->insert('resep', $data);

        return $this->db->insert_id();
    }

    public function insert_detail($data)
    {
        return $this->db->insert('resep_detail', $data);
    }
}
