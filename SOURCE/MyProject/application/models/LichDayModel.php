<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LichDayModel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Khởi tạo kết nối cơ sở dữ liệu
    }
    public function getAllPhanCong($limit, $offset) {
        $this->db->select('
            pc.maPC,
            hk.tenHK,
            hk.namhoc,
            mh.maMH,
            mh.tenMH,
            mh.tongsotiet,
            mh.SoTC,
            nh.tenlopmonhoc,
            gv.tenGV
        ');
        $this->db->from('phan_cong pc');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('hoc_ky hk', 'pc.maHK = hk.maHK');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        $this->db->where('pc.maGV', $this->session->userdata('username'));
        $this->db->limit($limit, $offset); // Thêm giới hạn và offset ở đây
        $query = $this->db->get();
        return $query->result();
    }
    public function getTotalRows() {
        $this->db->where('maGV', $this->session->userdata('username'));
        return $this->db->count_all_results('phan_cong');
    }

    public function get_hoc_ky() {
        $query = $this->db->get('hoc_ky'); // Lấy tất cả dữ liệu từ bảng hoc_ky
        return $query->result_array(); // Trả về mảng kết quả
    }
    
    
     // Lấy nhà sản xuất
     public function get_all_nhom()
     {
         $this->db->select('*');
         $this->db->from('nhommonhoc');
         $query = $this->db->get();
 
         return $query->result_array();
     }

     public function get_all_giangvien()
     {
         $this->db->select('*');
         $this->db->from('giang_vien');
         $query = $this->db->get();
 
         return $query->result_array();
     }

     public function get_all_monhoc()
     {
         $this->db->select('*');
         $this->db->from('mon_hoc');
         $query = $this->db->get();
 
         return $query->result_array();
     }

     public function searchPhanCong($searchTerm, $limit, $offset) {
        $this->db->select('
            pc.maPC,
            hk.maHK,
            hk.tenHK,
            hk.namhoc,
            nh.maMH,
            mh.tenMH,
            mh.tongsotiet,
            mh.SoTC,
            nh.tenlopmonhoc,
            gv.maGV,
            gv.tenGV
        ');
        $this->db->from('phan_cong pc');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('hoc_ky hk', 'pc.maHK = hk.maHK');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        $this->db->where('pc.maGV', $this->session->userdata('username'));
        
        // Thay đổi điều kiện tìm kiếm để tìm theo mã học kỳ
        $this->db->group_start(); // Bắt đầu nhóm điều kiện
        $this->db->like('hk.maHK', $searchTerm); // Tìm kiếm theo mã học kỳ
        $this->db->or_like('mh.tenMH', $searchTerm); // Tìm kiếm theo tên môn học
        $this->db->or_like('nh.maMH', $searchTerm);
        $this->db->or_like('gv.tenGV', $searchTerm);
        $this->db->or_like('gv.maGV', $searchTerm);
       
        $this->db->group_end(); // Kết thúc nhóm điều kiện
        
        // Apply limit and offset
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }

    
    
    
}
