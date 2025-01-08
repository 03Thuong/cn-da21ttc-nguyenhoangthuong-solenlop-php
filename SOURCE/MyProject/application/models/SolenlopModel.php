<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SolenlopModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Initialize database connection
    }

    public function get_all_solenlop($maPC) {
        $this->db->select('
            ctl.maCT,
            ctl.ngaylenlop,
            ctl.phonghoc,
            ctl.buoi,
            ctl.sotietlt,
            ctl.sotietth,
            ctl.tomtatnoidung,
            ctl.tenSV_vang,
            ctl.xacnhangv,
            ctl.xacnhansv,
            pc.maGV,
            gv.tenGV,
            mh.maMH,
            mh.tenMH,
            nh.manhom,
            nh.tenlopmonhoc
        ');
        $this->db->from('chi_tiet_so_len_lop ctl');
        $this->db->join('phan_cong pc', 'ctl.maPC = pc.maPC');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->where('pc.maPC', $maPC);
        $this->db->order_by('ctl.ngaylenlop', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function getPhanCongById($maPC)
{
    // Truy vấn dữ liệu từ bảng phan_cong
    $this->db->select('
        pc.maPC,
        hk.maHK,
        hk.namhoc,
        mh.maMH,
        mh.tenMH,
        nh.manhom,
        nh.tenlopmonhoc,
        gv.tenGV,
        gv.maGV
    ');
    $this->db->from('phan_cong pc');
    $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
    $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
    $this->db->join('hoc_ky hk', 'pc.maHK = hk.maHK');
    $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
    $this->db->where('pc.maPC', $maPC);
    
    $query = $this->db->get();
    return $query->row_array(); // Trả về một mảng dữ liệu
}
    
    public function calculate_totals($maPC) {
        // Gọi hàm get_all_solenlop để lấy dữ liệu
        $results = $this->get_all_solenlop($maPC);
        
        // Khởi tạo biến tổng
        $totalTheory = 0;
        $totalPractice = 0;
        $totalSessions = 0; // Tổng số buổi
    
        // Duyệt qua kết quả và tính tổng
        foreach ($results as $row) {
            $totalTheory += $row->sotietlt; // Cộng số tiết lý thuyết
            $totalPractice += $row->sotietth; // Cộng số tiết thực hành
            $totalSessions++; // Tăng tổng số buổi
        }
    
        // Trả về mảng chứa tổng số tiết và buổi
        return [
            'total_theory' => $totalTheory,
            'total_practice' => $totalPractice,
            'total_sessions' => $totalSessions
        ];
    }
    
}
