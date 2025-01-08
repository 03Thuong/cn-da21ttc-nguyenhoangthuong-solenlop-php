<?php
class thongkeModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Initialize database connection
    }

    public function get_tong_so_tiet_by_gv($semester = null, $year = null)
    {
        $this->db->select('
            mh.maMH,
            mh.tenMH,
            gv.tenGV,
            nh.tenlopmonhoc,
            SUM(ctl.sotietlt) as tong_sotietlt,
            SUM( ctl.sotietth) as tong_sotietth,
            (SUM(ctl.sotietlt) + SUM(ctl.sotietth)) as tong_sotiet
        ');
        $this->db->from('chi_tiet_so_len_lop ctl');
        $this->db->join('phan_cong pc', 'ctl.maPC = pc.maPC');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('hoc_ky hk', 'pc.maHK = hk.maHK');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->where('gv.maGV', $this->session->userdata('username'));
    
        // Filter by semester if provided
        if ($semester) {
            $this->db->where('pc.maHK', $semester);
        }
    
        // Filter by academic year if provided
        if ($year) {
            $this->db->where('hk.namhoc', $year);
        }
    
        $this->db->group_by(['mh.maMH', 'mh.tenMH', 'nh.tenlopmonhoc']);
        $query = $this->db->get();
        return $query->result();
    }


public function get_hoc_ky_unique_namhoc() {
    $this->db->select('namhoc');
    $this->db->distinct(); // Lọc năm học không trùng
    $query = $this->db->get('hoc_ky'); 
    return $query->result_array(); 
}

public function get_all_gv() {
    $query = $this->db->get('giang_vien'); // Get all records from giang_vien table
    $this->db->where('maGV', $this->session->userdata('username'));
    return $query->result(); // Return the result as an array of objects
}

public function get_hoc_ky() {
    $query = $this->db->get('hoc_ky'); // Lấy tất cả dữ liệu từ bảng hoc_ky
    return $query->result_array(); // Trả về mảng kết quả
}

public function get_don_vi() {
    $query = $this->db->get('don_vi'); // Lấy tất cả dữ liệu từ bảng don_vi
    return $query->result_array(); // Trả về mảng kết quả
}

public function get_teacher_name($maGV) {
    $this->db->select('tenGV');
    $this->db->from('giang_vien'); // Replace 'teachers' with your actual table name
    $this->db->where('maGV', $maGV);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->tenGV; // Assuming 'tenGV' is the column name for the teacher's name
    }
    return null; // Return null if no teacher found
}
public function get_tong_so_tiet_all_gv($semester = null, $year = null, $donvi = null, $limit = null, $offset = null)
{
    $this->db->select('
        gv.maGV,
        gv.tenGV,
        mh.maMH,
        mh.tenMH,
        nh.tenlopmonhoc,
        SUM(ctl.sotietlt) as tong_sotietlt,
        SUM(ctl.sotietth) as tong_sotietth,
        (SUM(ctl.sotietlt) + SUM(ctl.sotietth)) as tong_sotiet
    ');
    $this->db->from('chi_tiet_so_len_lop ctl');
    $this->db->join('phan_cong pc', 'ctl.maPC = pc.maPC');
    $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
    $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
    $this->db->join('hoc_ky hk', 'pc.maHK = hk.maHK');
    $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
    $this->db->join('don_vi dv', 'gv.madv = dv.madv');
    
    // Filter by semester if provided
    if ($semester) {
        $this->db->where('pc.maHK', $semester);
    }

    if ($donvi) {
        $this->db->where('gv.madv', $donvi);
    }

    // Filter by academic year if provided
    if ($year) {
        $this->db->where('hk.namhoc', $year);
    }

    $this->db->group_by(['gv.maGV', 'mh.maMH', 'mh.tenMH', 'nh.tenlopmonhoc']);

    // Apply limit and offset for pagination
    if ($limit) {
        $this->db->limit($limit, $offset);
    }

    $query = $this->db->get();
    return $query->result();
}

// Add a method to count total records
public function count_tong_so_tiet_all_gv($semester = null, $year = null, $donvi = null)
{
    $this->db->select('COUNT(*) as total');
    $this->db->from('chi_tiet_so_len_lop ctl');
    $this->db->join('phan_cong pc', 'ctl.maPC = pc.maPC');
    $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
    $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
    $this->db->join('hoc_ky hk', ' pc.maHK = hk.maHK');
    $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
    $this->db->join('don_vi dv', 'gv.madv = dv.madv');
    
    // Filter by semester if provided
    if ($semester) {
        $this->db->where('pc.maHK', $semester);
    }

    // Filter by academic year if provided
    if ($year) {
        $this->db->where('hk.namhoc', $year);
    }

    
    if ($donvi) {
        $this->db->where('gv.madv', $donvi);
    }
    $query = $this->db->get();
    return $query->row()->total;
}


}
?>