<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GiangVienModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Khởi tạo kết nối cơ sở dữ liệu
    }

    // Lấy danh sách giảng viên
    public function getAllGiangVien($limit, $offset)
{
    $this->db->select('giang_vien.*, don_vi.tendonvi');
    $this->db->from('giang_vien');
    $this->db->join('don_vi', 'giang_vien.madv = don_vi.madv', 'left');
    $this->db->limit($limit, $offset);
    $query = $this->db->get();
    return $query->result_array();
}

    public function getTotalRows()
    {
        return $this->db->count_all('giang_vien');
    }

    public function getAllDonVi()
{
    $query = $this->db->get('don_vi');
    return $query->result_array();
}
    // Lấy thông tin chi tiết của giảng viên theo ID
    public function getGiangVienById($maGV)
    {
        $query = $this->db->get_where('giang_vien', array('maGV' => $maGV));
        return $query->row_array();
    }

    // Thêm mới giảng viên
    public function addGiangVien($data)
    {
        return $this->db->insert('giang_vien', $data);
    }

    // Cập nhật thông tin giảng viên
    public function updateGiangVien($maGV, $data)
    {
        $this->db->where('maGV', $maGV);
        return $this->db->update('giang_vien', $data);
    }



    // Xóa giảng viên
    public function deleteGiangVien($maGV)
    {
        $this->db->where('maGV', $maGV);
        return $this->db->delete('giang_vien');
    }

    // Tìm kiếm giảng viên
    public function getTotalRowsSearch($keyword)
    {
        $this->db->like('tenGV', $keyword);
        $query = $this->db->get('giang_vien');
        return $query->num_rows();
    }

    public function searchGiangVien($keyword, $limit, $offset)
    {
        $this->db->like('tenGV', $keyword);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('giang_vien');
        return $query->result_array();
    }
}