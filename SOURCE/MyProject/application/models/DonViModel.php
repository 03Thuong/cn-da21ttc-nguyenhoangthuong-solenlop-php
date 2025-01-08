<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DonViModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Khởi tạo kết nối cơ sở dữ liệu
    }

    // Lấy danh sách đơn vị
    public function getAllDonVi($limit, $offset)
    {
        $this->db->select('*');
        $this->db->from('don_vi');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Lấy tổng số dòng trong bảng don_vi
    public function getTotalRows()
    {
        return $this->db->count_all('don_vi');
    }

    // Lấy thông tin chi tiết của đơn vị theo ID
    public function getDonViById($madv)
    {
        $query = $this->db->get_where('don_vi', array('madv' => $madv));
        return $query->row_array();
    }

    // Thêm mới đơn vị
    public function addDonVi($data)
    {
        return $this->db->insert('don_vi', $data);
    }

    // Cập nhật thông tin đơn vị
    public function updateDonVi($madv, $data)
    {
        $this->db->where('madv', $madv);
        return $this->db->update('don_vi', $data);
    }

    // Xóa đơn vị
    public function deleteDonVi($madv)
    {
        $this->db->where('madv', $madv);
        return $this->db->delete('don_vi');
    }

    // Tìm kiếm đơn vị
    public function getTotalRowsSearch($keyword)
    {
        $this->db->like('tendonvi', $keyword);
        $query = $this->db->get('don_vi');
        return $query->num_rows();
    }

    public function searchDonVi($keyword, $limit, $offset)
    {
        $this->db->like('tendonvi', $keyword);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('don_vi');
        return $query->result_array();
    }
}