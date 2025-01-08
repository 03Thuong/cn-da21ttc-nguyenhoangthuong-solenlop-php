<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SinhVienModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Khởi tạo kết nối cơ sở dữ liệu
    }

    // Lấy thông tin sinh viên theo ID
    public function getSinhVienById($maSV)
    {
        $query = $this->db->get_where('sinh_vien', array('maSV' => $maSV));
        return $query->row_array();
    }

    // Lấy danh sách sinh viên với paging
    public function getAllSinhVien($limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('sinh_vien');
        return $query->result_array();
    }

    // Lấy tổng số dòng sinh viên
    public function getTotalRowsSinhVien()
    {
        return $this->db->count_all('sinh_vien');
    }

    public function get_student_by_maSV($maSV)
    {
        $query = $this->db->get_where('sinh_vien', array('maSV' => $maSV));
        return $query->row(); // Trả về một hàng dữ liệu
    }

    public function insert_account($maSV)
    {
        $query = "INSERT IGNORE INTO tai_khoan (username, matkhau, quyen) VALUES ('$maSV', '$maSV', 'Sinh viên')";
        $this->db->query($query);

        // Return the last inserted ID
        return $this->db->insert_id();
    }

    public function insert_student($studentData)
    {
        // Truy vấn để chèn dữ liệu mới
        $queryInsert = "INSERT INTO sinh_vien (maSV, holot, tenSV, manhom, maMH, malop, tenlop, sdt, email, toTH, matk) 
                    VALUES ('{$studentData['maSV']}', '{$studentData['holot']}', '{$studentData['tenSV']}', '{$studentData['manhom']}', 
                            '{$studentData['maMH']}', '{$studentData['malop']}', '{$studentData['tenlop']}', '{$studentData['sdt']}', 
                            '{$studentData['email']}', '{$studentData['toTH']}', '{$studentData['matk']}')";

        return $this->db->query($queryInsert);
    }






    // Cập nhật thông tin sinh viên
    public function updateSinhVien($maSV, $data)
    {
        $this->db->where('maSV', $maSV);
        return $this->db->update('sinh_vien', $data);
    }

    // Xóa sinh viên
    public function deleteSinhVien($maSV)
    {
        // Xóa tài khoản liên quan trước khi xóa sinh viên
        $this->db->delete('tai_khoan', array('username' => $maSV));
        return $this->db->delete('sinh_vien', array('maSV' => $maSV));
    }

    // Tìm kiếm sinh viên
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
        $this->buildSearchConditions($keyword, $ma_nhom, $ma_mon,$toTH);

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
        $this->buildSearchConditions($keyword, $ma_nhom, $ma_mon,$toTH);

        // Đếm tổng số kết quả phù hợp
        return $this->db->count_all_results('sinh_vien');
    }


    // Lấy tất cả nhóm môn học
    public function getAllNhomMonHoc()
    {
        $this->db->select('nhommonhoc.*, mon_hoc.TenMH'); // Select fields from both tables
        $this->db->from('nhommonhoc');
        $this->db->join('mon_hoc', 'nhommonhoc.maMH = mon_hoc.maMH'); // Join with the mon_hoc table
        $this->db->join('phan_cong pc ', 'nhommonhoc.maMH = pc.maMH AND nhommonhoc.manhom = pc.manhom'); // Join with the phan_cong table
        $this->db->where('pc.maGV', $this->session->userdata('username'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getNhomMonHoc()
    {
        
        $this->db->select('nhommonhoc.*, mon_hoc.TenMH'); // Select fields from both tables
        $this->db->from('nhommonhoc');
        $this->db->join('mon_hoc', 'nhommonhoc.maMH = mon_hoc.maMH'); // Join with the mon_hoc table
        $this->db->join('phan_cong pc ', 'nhommonhoc.maMH = pc.maMH AND nhommonhoc.manhom = pc.manhom'); // Join with the phan_cong table
        $query = $this->db->get();
        return $query->result_array();
    }
}
