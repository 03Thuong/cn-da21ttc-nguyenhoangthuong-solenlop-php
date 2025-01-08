<?php
class ctsllModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Initialize database connection
    }

    public function get_all_solenlop($maPC)
    {
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
            gv.maGV,
            gv.tenGV,
            mh.maMH,
            mh.tenMH,
            nh.manhom,
            nh.tenlopmonhoc,
            pc.maPC
        ');
        $this->db->from('chi_tiet_so_len_lop ctl');
        $this->db->join('phan_cong pc', 'ctl.maPC = pc.maPC');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->where('pc.maPC', $maPC);
        // Sắp xếp theo ngày trước
        $this->db->order_by('ctl.ngaylenlop', 'ASC');

        // Sắp xếp theo buổi (giả sử buổi được lưu trữ dưới dạng chuỗi)
        // Sắp xếp theo buổi
        $this->db->order_by('ctl.buoi', 'ASC');
        $query = $this->db->get(); // Thực hiện truy vấn
        return $query->result(); // Trả về kết quả

        
    }

    public function get_image_paths($maCT) {
        $this->db->select('xacnhangv');
        $this->db->from('chi_tiet_so_len_lop');
        $this->db->where('maCT', $maCT);
        $query = $this->db->get();

        $result = $query->result_array();
        $image_paths = [];

        foreach ($result as $row) {
            $image_path = $row['xacnhangv'];
            if (filter_var($image_path, FILTER_VALIDATE_URL)) {
                $image_path = basename($image_path); // Lấy tên file từ URL
            }
            $image_paths[] = $image_path; // Lưu tất cả các đường dẫn hình ảnh
        }

        return $image_paths;
    }
    public function calculate_totals($maPC)
    {
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
        gv.maGV,
        dv.tendonvi,
        mh.tongsotiet
    ');
        $this->db->from('phan_cong pc');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('hoc_ky hk', 'pc.maHK = hk.maHK');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        $this->db->join('don_vi dv', 'gv.madv = dv.madv');
        $this->db->where('pc.maPC', $maPC);

        $query = $this->db->get();
        return $query->row_array(); // Trả về một mảng dữ liệu
    }

    // Lấy tổng số dòng trong bảng chi_tiet_so_len_lop
    public function getTotalRows()
    {
        return $this->db->count_all('chi_tiet_so_len_lop');
    }

    // Lấy thông tin chi tiết theo IDpublic function getChiTietById($maCT)
    public function getChiTietById($maCT)
    {
        $query = $this->db->get_where('chi_tiet_so_len_lop', array('maCT' => $maCT));
        return $query->row_array();
    }
    
    public function updateChiTietSoLenLop($maCT, $data)
    {
        $this->db->where('maCT', $maCT);
        return $this->db->update('chi_tiet_so_len_lop', $data);
    }
    // Thêm mới bản ghi
    public function addChiTietSoLenLop($data)
    {
        return $this->db->insert('chi_tiet_so_len_lop', $data);
    }

    public function getChiTietByMaPCNgayBuoi($maPC, $ngaylenlop, $buoi)
    {
        // Sử dụng Query Builder để thực hiện truy vấn
        $this->db->where('maPC', $maPC);
        $this->db->where('ngaylenlop', $ngaylenlop);
        $this->db->where('buoi', $buoi);
        $query = $this->db->get('chi_tiet_so_len_lop'); // Thay 'ten_bang_cua_ban' bằng tên bảng thực tế

        // Kiểm tra xem có bản ghi nào không
        if ($query->num_rows() > 0) {
            return $query->row(); // Trả về bản ghi đầu tiên
        } else {
            return null; // Không có bản ghi nào
        }
    }
    // Cập nhật bản ghi

    // Xóa bản ghi
    public function deleteChiTietSoLenLop($maCT)
    {
        $this->db->where('maCT', $maCT);
        return $this->db->delete('chi_tiet_so_len_lop');
    }

    // Tìm kiếm bản ghi
    public function getTotalRowsSearch($keyword)
    {
        $this->db->like('tomtatnoidung', $keyword);
        $query = $this->db->get('chi_tiet_so_len_lop');
        return $query->num_rows();
    }

    public function searchChiTietSoLenLop($keyword, $limit, $offset)
    {
        $this->db->like('tomtatnoidung', $keyword);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('chi_tiet_so_len_lop');
        return $query->result_array();
    }

    public function getAllNhomMonHoc()
    {
        $this->db->select('nhommonhoc.*, mon_hoc.TenMH'); // Select fields from both tables
        $this->db->from('nhommonhoc');
        $this->db->join('mon_hoc', 'nhommonhoc.maMH = mon_hoc.maMH'); // Join with the mon_hoc table
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTotalRowsSinhVien($maCT)
    {
        // Prepare the query to count the total number of students
        $this->db->select('COUNT(sv.maSV) AS total');
        $this->db->from('sinh_vien sv');
        $this->db->join('nhommonhoc nm', 'sv.manhom = nm.manhom AND sv.maMH = nm.maMH');
        $this->db->join('phan_cong pc', 'nm.manhom = pc.manhom AND nm.maMH = pc.maMH');
        $this->db->join('chi_tiet_so_len_lop ct', 'pc.maPC = ct.maPC');
        
        if ($maCT) {
            $this->db->where('ct.maCT', $maCT);
        }

        $query = $this->db->get();
        return $query->row()->total;
    }

    public function getAllSinhVien($limit, $offset, $maCT)
{
    $this->db->select('sv.*, pc.maPC');
    $this->db->from('sinh_vien sv');
    $this->db->join('nhommonhoc nm', 'sv.manhom = nm.manhom AND sv.maMH = nm.maMH');
    $this->db->join('phan_cong pc', 'nm.manhom = pc.manhom AND nm.maMH = pc.maMH');
    $this->db->join('chi_tiet_so_len_lop ct', 'pc.maPC = ct.maPC');

    if ($maCT) {
        $this->db->where('ct.maCT', $maCT);
    }

    $this->db->limit($limit, $offset);
    $query = $this->db->get();
    return $query->result_array(); // Change this line
}

// Tìm kiếm sinh viên
private function buildSearchConditions($keyword, $toTH = null)
{
    // Bắt đầu nhóm các điều kiện tìm kiếm
    $this->db->group_start();
    $this->db->like('maSV', $keyword); // Tìm kiếm theo mã sinh viên
    $this->db->or_like('holot', $keyword); // Tìm kiếm theo họ lót
    $this->db->or_like('tenSV', $keyword); // Tìm kiếm theo tên sinh viên
    $this->db->or_like('malop', $keyword); // Tìm kiếm theo mã lớp
    $this->db->or_like('tenlop', $keyword); // Tìm kiếm theo tên lớp
    $this->db->or_like('toTH', $keyword); // Tìm kiếm theo tổ thực hành
    $this->db->group_end(); // Kết thúc nhóm các điều kiện tìm kiếm

    // Thêm điều kiện cho tổ thực hành nếu được cung cấp
    if ($toTH) {
        $this->db->where('toTH', $toTH);
    }
}

public function searchSinhVien($keyword, $toTH = null, $limit, $offset)
{
    // Xây dựng các điều kiện tìm kiếm
    $this->buildSearchConditions($keyword, $toTH);

    // Thiết lập giới hạn số lượng kết quả và vị trí bắt đầu
    $this->db->limit((int) $limit, (int) $offset);

    // Thực thi truy vấn tìm kiếm
    $query = $this->db->get('sinh_vien');

    // Trả về kết quả dưới dạng mảng
    return $query->result_array();
}

public function getTotalRowsSearchSinhVien($keyword, $toTH = null)
{
    // Xây dựng các điều kiện tìm kiếm
    $this->buildSearchConditions($keyword, $toTH);

    // Đếm tổng số kết quả phù hợp
    return $this->db->count_all_results('sinh_vien');
}
public function saveAbsentees($maCT,$data) {
    $this->db->where('maCT', $maCT);
    return $this->db->update('chi_tiet_so_len_lop', $data);
}
public function getMaPCByMaCT($maCT) {
    $this->db->select('pc.maPC');
    $this->db->from('chi_tiet_so_len_lop ct');
    $this->db->join('phan_cong pc', 'ct.maPC = pc.maPC');
    $this->db->where('ct.maCT', $maCT);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->maPC; // Return the maPC
    }
    return null; // Return null if not found
}

// thông tin tài khoản
public function getAllGiangVien()
{
    $this->db->select('giang_vien.*, don_vi.tendonvi');
    $this->db->from('giang_vien');
    $this->db->join('don_vi', 'giang_vien.madv = don_vi.madv', 'left');
    $this->db->where('maGV', $this->session->userdata('username'));
    $query = $this->db->get();
    return $query->result_array();
}

// Hàm lấy đường dẫn hình ảnh từ bảng chi_tiet_so_len_lop
public function getImagesByMaPC($maPC)
{
    $this->db->select('xacnhangv');
    $this->db->from('chi_tiet_so_len_lop');
    $this->db->where('maPC', $maPC);

    $query = $this->db->get();
    $result = $query->row_array();

    if ($result && !empty($result['xacnhangv'])) {
        return explode(',', $result['xacnhangv']); // Tách đường dẫn hình ảnh thành mảng
    }

    return null; // Không có dữ liệu
}


}
?>