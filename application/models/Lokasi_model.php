<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_all()
    {
        $query = $this->db->get('lokasi');
        return $query->result_array();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('lokasi', array('id' => $id));
        return $query->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('lokasi', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('lokasi', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('lokasi', array('id' => $id));
    }
}
