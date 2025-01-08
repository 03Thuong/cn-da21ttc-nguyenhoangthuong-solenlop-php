<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HocKyModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Initialize database connection
    }

    // Get all semesters
    public function getAllHocKy($limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('hoc_ky');
        return $query->result_array();
    }

    public function getTotalRows()
    {
        return $this->db->count_all('hoc_ky');
    }

    // Get semester details by ID
    public function getHocKyById($maHK)
    {
        $query = $this->db->get_where('hoc_ky', array('maHK' => $maHK));
        return $query->row_array();
    }

    // Add new semester
    public function addHocKy($data)
    {
        return $this->db->insert('hoc_ky', $data);
    }

    // Update semester information
    public function updateHocKy($maHK, $data)
    {
        $this->db->where('maHK', $maHK);
        return $this->db->update('hoc_ky', $data);
    }

    // Delete semester
    public function deleteHocKy($maHK)
    {
        $this->db->where('maHK', $maHK);
        return $this->db->delete('hoc_ky');
    }

    // Search semesters
    public function getTotalRowsSearch($keyword)
    {
        $this->db->like('tenHK', $keyword);
        $query = $this->db->get('hoc_ky');
        return $query->num_rows();
    }

    public function searchHocKy($keyword, $limit, $offset)
    {
        $this->db->like('tenHK', $keyword);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('hoc_ky');
        return $query->result_array();
    }
}