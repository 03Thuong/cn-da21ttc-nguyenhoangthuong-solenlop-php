<?php
defined('BASEPATH') or exit('No direct script access allowed');

class xacnhansv_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Khởi tạo kết nối cơ sở dữ liệu
    }
    public function getAllPhanCong($limit, $offset)
    {
        $this->db->select('
            pc.maPC,
            hk.tenHK,
            hk.namhoc,
            nh.maMH,
            mh.tenMH,
            mh.tongsotiet,
            mh.SoTC,
            nh.tenlopmonhoc,
            gv.tenGV,
            nh.manhom

        ');
        $this->db->from('phan_cong pc');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('hoc_ky hk', 'pc.maHK = hk.maHK');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        $this->db->join('sinh_vien sv', 'nh.manhom = sv.manhom AND nh.maMH = sv.maMH');
        $this->db->where('sv.maSV', $this->session->userdata('username')); // Thêm điều kiện maSV
        $this->db->order_by('hk.maHK', 'ASC'); // Sắp xếp tên học kỳ tăng dần
        $this->db->order_by('hk.namhoc', 'ASC'); // Sắp xếp năm học tăng dần
        $this->db->limit($limit, $offset); // Thêm giới hạn và offset ở đây
        $query = $this->db->get();
        return $query->result();
    }
    public function getTotalRows()
    {
        $this->db->from('phan_cong pc');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->join('sinh_vien sv', 'nh.manhom = sv.manhom AND nh.maMH = sv.maMH');


        $this->db->where('sv.maSV', $this->session->userdata('username'));


        return $this->db->count_all_results(); // Đếm số hàng với các điều kiện
    }



    public function get_hoc_ky()
    {
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
        $this->db->select('mh.*');
        $this->db->from('mon_hoc mh');
        $this->db->join('nhommonhoc nh', 'mh.maMH = nh.maMH', 'inner');
        $this->db->join('sinh_vien sv', 'nh.manhom = sv.manhom AND mh.maMH = sv.maMH', 'inner');
        $this->db->where('sv.maSV', $this->session->userdata('username')); // Thêm điều kiện maSV
        $query = $this->db->get();

        return $query->result_array();
    }


    public function searchPhanCong($keyword, $limit, $offset, $ma_hk = null, $ma_mon = null)
    {
        $this->db->select('
            pc.maPC,
            hk.maHK,
            hk.tenHK,
            hk.namhoc,
            nh.maMH,
            mh.tenMH,
            nh.manhom,
            mh.SoTC,
            nh.tenlopmonhoc,
            gv.maGV,
            gv.tenGV,
            dv.tendonvi,
            mh.tongsotiet
        ');
        $this->db->from('phan_cong pc');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('hoc_ky hk', 'pc.maHK = hk.maHK');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        $this->db->join('don_vi dv', 'gv.madv = dv.madv');
        $this->db->order_by('hk.maHK', 'ASC'); // Sắp xếp tên học kỳ tăng dần
        $this->db->order_by('hk.namhoc', 'ASC'); // Sắp xếp năm học tăng dần

        // Add conditions for ma_hk and ma_mon if provided
        if (!empty($ma_hk)) {
            $this->db->where('hk.maHK', $ma_hk);
        }
        if (!empty($ma_mon)) {
            $this->db->where('mh.maMH', $ma_mon);
        }

        // Group search conditions
        $this->db->group_start();
        $this->db->like('hk.maHK', $keyword);
        $this->db->or_like('mh.tenMH', $keyword);
        $this->db->or_like('nh.maMH', $keyword);
        $this->db->or_like('gv.tenGV', $keyword);
        $this->db->or_like('gv.maGV', $keyword);
        $this->db->group_end();

        // Apply limit and offset
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllSV()
    {
        $this->db->select('sinh_vien.*, tai_khoan.username');
        $this->db->from('sinh_vien');
        $this->db->join('tai_khoan', 'sinh_vien.matk = tai_khoan.matk', 'left');
        $this->db->where('tai_khoan.username', $this->session->userdata('username'));
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    private function buildSearchConditions($keyword, $ma_nhom = null, $ma_mon = null, $toTH = null)
    {
        // Bắt đầu nhóm các điều kiện tìm kiếm
        $this->db->group_start();
        $this->db->like('maSV', $keyword); // Tìm kiếm theo mã sinh viên
        $this->db->or_like('holot', $keyword); // Tìm kiếm theo họ lót
        $this->db->or_like('tenSV', $keyword); // Tìm kiếm theo tên sinh viên
        $this->db->or_like('malop', $keyword); // Tìm kiếm theo mã lớp
        $this->db->or_like('tenlop', $keyword); // Tìm kiếm theo tên lớp
        $this->db->or_like('toTH', $keyword); // Tìm kiếm theo tổ thực hành
        $this->db->or_like('manhom', $keyword); // Tìm kiếm theo mã nhóm
        $this->db->or_like('maMH', $keyword); // Tìm kiếm theo mã nhóm
        $this->db->group_end(); // Kết thúc nhóm các điều kiện tìm kiếm

        // Thêm điều kiện cho mã nhóm nếu được cung cấp
        if ($ma_nhom) {
            $this->db->where('manhom', $ma_nhom);
        }

        if ($ma_mon) {
            $this->db->where('maMH', $ma_mon);
        }
        // Thêm điều kiện cho tổ thực hành nếu được cung cấp
        if ($toTH) {
            $this->db->where('toTH', $toTH);
        }
    }

    public function searchSinhVien($keyword, $ma_nhom = null, $ma_mon = null, $toTH = null, $limit, $offset)
    {
        // Xây dựng các điều kiện tìm kiếm
        $this->buildSearchConditions($keyword, $ma_nhom, $ma_mon, $toTH);

        // Thiết lập giới hạn số lượng kết quả và vị trí bắt đầu
        $this->db->limit((int) $limit, (int) $offset);

        // Thực thi truy vấn tìm kiếm
        $query = $this->db->get('sinh_vien');

        // Trả về kết quả dưới dạng mảng
        return $query->result_array();
    }

    public function getTotalRowsSearchSinhVien($keyword, $ma_nhom = null, $ma_mon = null, $toTH = null)
    {
        // Xây dựng các điều kiện tìm kiếm
        $this->buildSearchConditions($keyword, $ma_nhom, $ma_mon, $toTH);

        // Đếm tổng số kết quả phù hợp
        return $this->db->count_all_results('sinh_vien');
    }


    public function getSinhVienInfo()
    {
        $this->db->select('maSV, holot, tenSV');
        $this->db->from('sinh_vien');
        $this->db->where('maSV', $this->session->userdata('username')); // Lọc theo tài khoản
        $query = $this->db->get();

        return $query->result_array();
    }

    public function updateXacNhanSV($maCT, $data)
    {
        // Lấy thông tin sinh viên từ phương thức getSinhVienInfo
        $sinhVienInfo = $this->getSinhVienInfo();

        // Check nếu không lấy được thông tin sinh viên thì dừng lại
        if (empty($sinhVienInfo)) {
            return false; // Hoặc xử lý lỗi
        }

        $maSV = $sinhVienInfo[0]['maSV'];
        $holot = $sinhVienInfo[0]['holot'];
        $tenSV = $sinhVienInfo[0]['tenSV'];

        $data = array(
            'xacnhansv' => $maSV . '-' . $holot . ' ' . $tenSV // Tạo chuỗi xác nhận sinh viên
        );

        $this->db->where('maCT', $maCT);
        return $this->db->update('chi_tiet_so_len_lop', $data);
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
            pc.maPC,
                    dv.tendonvi,
        mh.tongsotiet
        ');
        $this->db->from('chi_tiet_so_len_lop ctl');
        $this->db->join('phan_cong pc', 'ctl.maPC = pc.maPC');
        $this->db->join('giang_vien gv', 'pc.maGV = gv.maGV');
        $this->db->join('mon_hoc mh', 'pc.maMH = mh.maMH');
        $this->db->join('nhommonhoc nh', 'pc.manhom = nh.manhom AND pc.maMH = nh.maMH');
        $this->db->join('don_vi dv', 'gv.madv = dv.madv');
        $this->db->where('pc.maPC', $maPC);
        // Sắp xếp theo ngày trước
        $this->db->order_by('ctl.ngaylenlop', 'ASC');

        // Sắp xếp theo buổi (giả sử buổi được lưu trữ dưới dạng chuỗi)
        // Sắp xếp theo buổi
        $this->db->order_by('ctl.buoi', 'ASC');
        $query = $this->db->get(); // Thực hiện truy vấn
        return $query->result(); // Trả về kết quả


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


    public function checkSinhVienExist($maSV, $maCT)
    {
        $this->db->where('maCT', $maCT);
        $this->db->where('tenSV_vang LIKE', "%$maSV%");
        $query = $this->db->get('chi_tiet_so_len_lop');
        return $query->num_rows() > 0; // Kiểm tra xem có kết quả trả về không
    }

}
