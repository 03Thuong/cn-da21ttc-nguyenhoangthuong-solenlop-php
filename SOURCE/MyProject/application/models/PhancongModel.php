<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PhancongModel extends CI_Model {
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
        $this->db->limit($limit, $offset); // Thêm giới hạn và offset ở đây
        $query = $this->db->get();
        return $query->result();
    }
    public function getTotalRows() {
        return $this->db->count_all('phan_cong');
    }
    

    public function get_hoc_ky() {
        $query = $this->db->get('hoc_ky'); // Lấy tất cả dữ liệu từ bảng hoc_ky
        return $query->result_array(); // Trả về mảng kết quả
    }
    public function insert_account($maGV) {
        $query = "INSERT IGNORE INTO tai_khoan (username, matkhau, quyen) VALUES ('$maGV', '$maGV', 'Giảng viên')";
        $this->db->query($query);
        
        // Return the last inserted ID
        return $this->db->insert_id();
    }

    public function checkAndInsertDonVi($tendonvi) {
        // Kiểm tra xem tên đơn vị đã tồn tại chưa
        $this->db->where('tendonvi', $tendonvi);
        $query = $this->db->get('don_vi');

        if ($query->num_rows() == 0) {
            // Nếu không tồn tại, thêm tên đơn vị vào bảng
            $this->db->insert('don_vi', ['tendonvi' => $tendonvi]);
            return $this->db->insert_id(); // Lấy ID vừa chèn
        } else {
            // Nếu đã tồn tại, lấy mã đơn vị
            $row = $query->row();
            return $row->madv; // Trả về mã đơn vị
        }
    }
    
    public function insert_giang_vien($GVData) {
        $query = "INSERT IGNORE INTO giang_vien (maGV, tenGV, madv, matk) 
                  VALUES ('{$GVData['maGV']}', '{$GVData['tenGV']}', '{$GVData['madv']}', '{$GVData['matk']}')
                          ";
        return $this->db->query($query);
    }

    public function insert_mon_hoc($maMH, $tenMH, $tongsotiet, $soTC) {
        // Kiểm tra dữ liệu đầu vào
        if (empty($maMH) || empty($tenMH) || empty($tongsotiet) || empty($soTC)) {
            return false; // Nếu dữ liệu không hợp lệ thì không insert
        }
    
        // Escape dữ liệu để tránh SQL Injection
        $maMH = $this->db->escape_str($maMH);
        $tenMH = $this->db->escape_str($tenMH);
        $tongsotiet = $this->db->escape_str($tongsotiet);
        $soTC = $this->db->escape_str($soTC);
    
        // Sử dụng truy vấn INSERT IGNORE
        $sql = "INSERT IGNORE INTO mon_hoc (maMH, tenMH, tongsotiet, SoTC) 
                VALUES ('$maMH', '$tenMH', '$tongsotiet', '$soTC')";
    
        // Thực thi truy vấn
        return $this->db->query($sql);
    }
    
    

    public function insert_nhom_mon_hoc($manhom, $maMH, $tenlopmonhoc) {
        // Escape dữ liệu để tránh SQL Injection
        $manhom = $this->db->escape_str($manhom);
        $maMH = $this->db->escape_str($maMH);
        $tenlopmonhoc = $this->db->escape_str($tenlopmonhoc);
    
        // Truy vấn INSERT IGNORE
        $sql = "INSERT IGNORE INTO nhommonhoc (manhom, maMH, tenlopmonhoc) 
                VALUES ('$manhom', '$maMH', '$tenlopmonhoc')";
    
        // Thực thi truy vấn
        return $this->db->query($sql);
    }
    public function insert_phan_cong($manhom, $maMH, $maGV, $maHK) {
        // Kiểm tra dữ liệu đã tồn tại
        $this->db->where('maHK', $maHK);
        $this->db->where('maMH', $maMH);
        $this->db->where('maGV', $maGV);
        $exists = $this->db->count_all_results('phan_cong');
    
        if ($exists > 0) {
            return false; // Nếu dữ liệu đã tồn tại, không insert
        }
    
        // Truy vấn INSERT IGNORE
        $sql = "INSERT IGNORE INTO phan_cong (manhom, maMH, maGV, maHK) 
                VALUES ('$manhom', '$maMH', '$maGV', '$maHK')";
    
        // Thực thi truy vấn
        return $this->db->query($sql);
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

    
    public function getTotalRowsSearch($searchTerm) {
        $this->db->select('COUNT(*) as total');
        $this->db->from('phan_cong pc');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('hoc_ky hk', 'pc.maHK = hk.maHK');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        
        // Điều kiện tìm kiếm tương tự như trong hàm searchPhanCong
        $this->db->group_start(); // Bắt đầu nhóm điều kiện
        $this->db->like('hk.maHK', $searchTerm); // Tìm kiếm theo mã học kỳ
        $this->db->or_like('mh.tenMH', $searchTerm); // Tìm kiếm theo tên môn học
        $this->db->or_like('nh.maMH', $searchTerm);
        $this->db->or_like('gv.tenGV', $searchTerm);
        $this->db->or_like('gv.maGV', $searchTerm);
        $this->db->group_end(); // Kết thúc nhóm điều kiện
        
        $query = $this->db->get();
        $result = $query->row();
        
        // Trả về tổng số dòng tìm thấy
        return $result ? $result->total : 0;
    }
    
    
}
