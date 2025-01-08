<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'scr/vendor/autoload.php'; // Autoloader của Composer
use PhpOffice\PhpSpreadsheet\IOFactory;
class SinhVienController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SinhVienModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    // Trang hiển thị danh sách sinh viên
    public function index_sv()
    {
        $username = $this->session->userdata('username');
        $limit = 15; // Số lượng sinh viên trên mỗi trang
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
    
        // Lấy danh sách nhóm môn học
        $data['nhommonhoc'] = $this->SinhVienModel->getAllNhomMonHoc();
    
        // Lấy các tham số tìm kiếm
        $keyword = $this->input->get('keyword');
        $ma_nhom = $this->input->get('ma_nhom');
        $ma_mon = $this->input->get('ma_mon');
        $toTH = $this->input->get('to_th');
    
        // Kiểm tra xem có từ khóa tìm kiếm hay không
        if (!empty($keyword) || !empty($ma_nhom) || !empty($ma_mon) || !empty($toTH)) {
            // Nếu có tìm kiếm, lấy tổng số sinh viên tìm kiếm
            $total_rows = $this->SinhVienModel->getTotalRowsSearchSinhVien($keyword, $ma_nhom, $ma_mon, $toTH);
            $data['sinh_vien'] = $this->SinhVienModel->searchSinhVien($keyword, $ma_nhom, $ma_mon, $toTH, $limit, $offset);
        } else {
            // Nếu không có tìm kiếm, lấy tổng số sinh viên
            $total_rows = $this->SinhVienModel->getTotalRowsSinhVien();
            $data['sinh_vien'] = $this->SinhVienModel->getAllSinhVien($limit, $offset);
        }
    
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);
        $data['keyword'] = $keyword;
        $data['ma_nhom'] = $ma_nhom;
        $data['ma_mon'] = $ma_mon;
        $data['toTH'] = $toTH;
    
        if (empty($data['sinh_vien'])) {
            $data['message'] = 'Không có kết quả tìm kiếm';
        }
    

        $this->load->view('giangvien/header', ['username' => $username]);
        $this->load->view('giangvien/qlsinhvien', $data);
        $this->load->view('giangvien/footer');
    }


    // Sửa thông tin sinh viên
    public function edit($maSV)
    {
        $username = $this->session->userdata('username');
        if ($this->input->post()) {
            $data = array(
                'hoTen' => $this->input->post('hoTen'),
                'lophoc' => $this->input->post('lophoc')
            );

            // Kiểm tra và thêm mã tài khoản nếu cần
            $matk = $this->input->post('matk');
            if (!empty($matk)) {
                $data['matk'] = $matk;
            }

            // Cập nhật thông tin sinh viên
            $this->SinhVienModel->updateSinhVien($maSV, $data);
            $this->session->set_flashdata('success', 'Cập nhật sinh viên thành công');
            redirect(base_url('quanlysinhvien_gv'));
        } else {
            $data['sinh_vien'] = $this->SinhVienModel->getSinhVienById($maSV);
            $this->load->view('giangvien/header', ['username' => $username]);
            $this->load->view('admin/sinhvien/edit', $data);
            $this->load->view('giangvien/footer');
        }
    }

    // Xóa sinh viên
    public function delete($maSV)
    {
        $this->SinhVienModel->deleteSinhVien($maSV);
        $this->session->set_flashdata('success', 'Xóa sinh viên thành công');
        redirect(base_url('quanlysinhvien_gv'));
    }

    // Tìm kiếm sinh viên
    public function search()
    {
         // Lấy danh sách nhóm môn học
         $data['nhommonhoc'] = $this->SinhVienModel->getAllNhomMonHoc();
        $username = $this->session->userdata('username');
        $keyword = $this->input->get('keyword');
        $ma_nhom = $this->input->get('ma_nhom'); // Get the group code
        $ma_mon = $this->input->get('ma_mon'); // Get the group code
        $toTH = $this->input->get('to_th'); // Get the practical group
        $limit = 10;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy tổng số sinh viên tìm kiếm
        $total_rows = $this->SinhVienModel->getTotalRowsSearchSinhVien($keyword, $ma_nhom, $ma_mon, $toTH);
        $data['sinh_vien'] = $this->SinhVienModel->searchSinhVien($keyword, $ma_nhom,  $ma_mon, $toTH, $limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);
        $data['keyword'] = $keyword;
        $data['ma_nhom'] = $ma_nhom; // Pass the group code to the view
        $data['ma_mon'] = $ma_mon; // Pass the group code to the view
        $data['toTH'] = $toTH; // Pass the practical group to the view

        if (empty($data['sinh_vien'])) {
            $data['message'] = 'Không có kết quả tìm kiếm';
        }

        $this->load->view('giangvien/header', ['username' => $username]);
        $this->load->view('giangvien/qlsinhvien', $data);
        $this->load->view('giangvien/footer');
    }



    public function upload_excel()
    {
        $maNhom = $this->input->post('ma_nhom');

        if (!empty($maNhom)) {
            list($maNhom, $maMonHoc) = explode('-', $maNhom);
        }
        $to_th = $this->input->post('to_th');

        if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
            $file = $_FILES['excel_file']['tmp_name'];
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            foreach ($data as $index => $row) {
                if ($index < 7)
                    continue; // Bỏ qua header hoặc không cần thiết

                $maSV = $row[1];       // B - Mã SV
                $holot = $row[2];      // C - Họ lót
                $tenSV = $row[3];      // D - Tên SV
                $maLop = $row[4];      // E - Mã lớp
                $tenLop = $row[5];     // F - Tên lớp
                $soDT = $row[6];       // G - Số điện thoại
                $email = $row[7];      // H - Email
                // Chuẩn hóa số điện thoại
                $soDT = $this->normalize_phone_number($soDT);
                // Kiểm tra xem sinh viên đã tồn tại chưa
                $existingStudent = $this->SinhVienModel->get_student_by_maSV($maSV);
                if ($existingStudent) {
                    // Nếu sinh viên đã tồn tại, sử dụng matk cũ
                    $matk = $existingStudent->matk; // Lấy matk cũ
                } else {
                    // Nếu sinh viên chưa tồn tại, thêm tài khoản mới
                    $matk = $this->SinhVienModel->insert_account($maSV);
                }

                // Dữ liệu cho bảng sinh viên
                $studentData = array(
                    'maSV' => $maSV,
                    'holot' => $holot,
                    'tenSV' => $tenSV,
                    'manhom' => $maNhom,
                    'maMH' => $maMonHoc,
                    'malop' => $maLop,
                    'tenlop' => $tenLop,
                    'sdt' => $soDT,
                    'email' => $email,
                    'toTH' => $to_th,
                    'matk' => $matk // Sử dụng ID tài khoản
                );

                // Insert vào bảng sinh viên
                $this->SinhVienModel->insert_student($studentData);
            }

            // Redirect hoặc thông báo thành công
            $this->session->set_flashdata('success', 'Dữ liệu đã được tải lên thành công.');
            redirect(base_url('quanlysinhvien_gv'));
        } else {
            // Xử lý lỗi
            $this->session->set_flashdata('error', 'Có lỗi xảy ra khi tải lên file.');
            redirect(base_url('quanlysinhvien_gv'));
        }
    }

    private function normalize_phone_number($phone)
    {
        // Xóa tất cả các ký tự không phải số
        $phone = preg_replace('/\D/', '', $phone);

        // Nếu số điện thoại bắt đầu bằng 0, giữ nguyên
        if (strlen($phone) == 10 && $phone[0] == '0') {
            return $phone;
        }

        // Nếu số điện thoại có 9 chữ số, thêm 0 ở đầu
        if (strlen($phone) == 9) {
            return '0' . $phone;
        }

        // Trả về số điện thoại đã chuẩn hóa
        return $phone;
    }
}




