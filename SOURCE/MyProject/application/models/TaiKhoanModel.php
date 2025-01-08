<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TaiKhoanModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Khởi tạo kết nối cơ sở dữ liệu
    }

    // Lấy danh sách tài khoản
    public function getAllTaiKhoan($limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('tai_khoan');
        return $query->result_array();
    }

    public function getTotalRows()
    {
        return $this->db->count_all('tai_khoan');
    }

    // Lấy thông tin chi tiết của tài khoản theo ID
    public function getTaiKhoanById($matk)
    {
        $query = $this->db->get_where('tai_khoan', array('matk' => $matk));
        return $query->row_array();
    }

    // Thêm mới tài khoản
    public function addTaiKhoan($data)
    {
        // Kiểm tra nếu tên tài khoản đã tồn tại
        $this->db->where('username', $data['username']);
        $query = $this->db->get('tai_khoan');

        if ($query->num_rows() > 0) {
            return false; // Tên tài khoản đã tồn tại
        }

        return $this->db->insert('tai_khoan', $data);
    }

    // Cập nhật thông tin tài khoản
    public function updateTaiKhoan($matk, $data)
    {
        $this->db->where('matk', $matk);
        return $this->db->update('tai_khoan', $data);
    }

    public function xoa_sinh_vien($matk)
    {
        $this->db->where('matk', $matk);
        return $this->db->delete('sinh_vien');
    }

    public function xoa_giang_vien($matk)
    {
        $this->db->where('matk', $matk);
        return $this->db->delete('giang_vien');
    }


    // Xóa tài khoản
    public function deleteTaiKhoan($matk)
    {
        $this->db->where('matk', $matk);
        return $this->db->delete('tai_khoan');
    }

    // Tìm kiếm tài khoản
    public function getTotalRowsSearch($keyword)
    {
        $this->db->like('username', $keyword);
        $query = $this->db->get('tai_khoan');
        return $query->num_rows();
    }

    public function searchTaiKhoan($keyword, $limit, $offset)
    {
        $this->db->like('username', $keyword);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('tai_khoan');
        return $query->result_array();
    }
}
