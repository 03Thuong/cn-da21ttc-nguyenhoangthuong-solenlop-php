<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NhomMonHocModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Initialize database connection
    }

    // Get all subject groups
    public function getAllNhomMonHoc($limit, $offset)
    {
        $this->db->select('nhommonhoc.*, mon_hoc.TenMH'); // Select fields from both tables
        $this->db->from('nhommonhoc');
        $this->db->join('mon_hoc', 'nhommonhoc.maMH = mon_hoc.maMH'); // Join with the mon_hoc table
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllMonHoc()
    {
        $query = $this->db->get('mon_hoc'); // Lấy toàn bộ dữ liệu từ bảng môn học
        return $query->result_array(); // Trả về mảng dữ liệu
    }
    // Get total number of subject groups
    public function getTotalRows()
    {
        return $this->db->count_all('nhommonhoc');
    }

    

    // Add new subject group
    public function addNhomMonHoc($data)
    {
        return $this->db->insert('nhommonhoc', $data);
    }

    public function getNhomMonHocById($manhom, $maMH)
    {
        $query = $this->db->get_where('nhommonhoc', array('manhom' => $manhom, 'maMH' => $maMH));
        return $query->row_array();
    }

    // Cập nhật thông tin nhóm môn học
    public function updateNhomMonHoc($manhom, $maMH, $data)
    {
        $this->db->where('manhom', $manhom);
        $this->db->where('maMH', $maMH);
        return $this->db->update('nhommonhoc', $data);
    }
    // Delete subject group
    public function deleteNhomMonHoc($manhom, $maMH)
    {
        $this->db->where('manhom', $manhom);
        $this->db->where('maMH', $maMH);
        return $this->db->delete('nhommonhoc');
    }

    // Search subject groups
    public function getTotalRowsSearch($keyword)
    {
        $this->db->select('nhommonhoc.*, mon_hoc.TenMH'); // Select cột TenMH từ bảng mon_hoc
        $this->db->from('nhommonhoc');
        $this->db->join('mon_hoc', 'nhommonhoc.maMH = mon_hoc.maMH', 'left'); // Join bảng mon_hoc
        $this->db->group_start();
        $this->db->like('tenMH', $keyword);
        $this->db->or_like('tenlopmonhoc', $keyword);
        $this->db->group_end();
        $query = $this->db->get();
        return $query->num_rows();
    }



    public function searchNhomMonHoc($keyword, $limit, $offset)
    {
        $this->db->select('nhommonhoc.*, mon_hoc.TenMH');
        $this->db->from('nhommonhoc');
        $this->db->join('mon_hoc', 'nhommonhoc.maMH = mon_hoc.maMH', 'left'); // Join bảng mon_hoc
        $this->db->group_start();
        $this->db->like('tenMH', $keyword);
        $this->db->or_like('tenlopmonhoc', $keyword);
        $this->db->group_end();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }


}