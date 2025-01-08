<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MonHocModel extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Khởi tạo kết nối cơ sở dữ liệu
    }

    // Lấy danh sách môn học
    public function getAllMonHoc($limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('mon_hoc');
        return $query->result_array();
    }

    public function getTotalRows()
    {
        return $this->db->count_all('mon_hoc');
    }
    public function getTotalRowsSearch($keyword)
    {
        $this->db->like('tenMH', $keyword);
        $query = $this->db->get('mon_hoc');
        return $query->num_rows();
    }
    public function searchMonHoc($keyword, $limit, $offset)
    {
        $this->db->like('tenMH', $keyword);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('mon_hoc');
        return $query->result_array();
    }
    // Lấy thông tin chi tiết của môn học theo ID
    public function getMonHocById($maMH)
    {
        $query = $this->db->get_where('mon_hoc', array('maMH' => $maMH));
        return $query->row_array();
    }

    // Thêm mới môn học
    public function addMonHoc($data)
    {
        return $this->db->insert('mon_hoc', $data);
    }

    // Cập nhật thông tin môn học
    public function updateMonHoc($maMH, $data)
    {
        $this->db->where('maMH', $maMH);
        return $this->db->update('mon_hoc', $data);
    }

    // Xóa môn học
    public function deleteMonHoc($maMH)
    {
        $this->db->where('maMH', $maMH);
        return $this->db->delete('mon_hoc');
    }

    // Tìm kiếm môn học
    

    
}
