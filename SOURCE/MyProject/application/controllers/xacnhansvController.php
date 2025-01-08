<?php
defined('BASEPATH') or exit('No direct script access allowed');

class xacnhansvController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('xacnhansv_model'); // Khởi tạo model
        $this->load->helper('url'); // Load URL helper
        $this->load->library('session');
    }

    public function index()
    {
        $username = $this->session->userdata('username');
        $limit = 10; // Số lượng môn học/rows mỗi trang
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy tổng số dòng cho dữ liệu phân công
        $total_rows = $this->xacnhansv_model->getTotalRows();

        // Lấy dữ liệu phân công
        $data['phan_cong'] = $this->xacnhansv_model->getAllPhanCong($limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);

        // Lấy dữ liệu học kỳ cho giao diện (có thể dùng cho filter hoặc dropdown, v.v.)
        $data['hoc_ky'] = $this->xacnhansv_model->get_hoc_ky();
        $data['ma_mon'] = $this->xacnhansv_model->get_all_monhoc();
        // Load view
        $this->load->view('sinhvien/header', ['username' => $username]);
        $this->load->view('sinhvien/sinhvien_view', $data);
        $this->load->view('giangvien/footer');
    }

    public function search()
    {
        $username = $this->session->userdata('username');
        $keyword = $this->input->get('keyword');
        $maHK = $this->input->get('ma_hk'); // Get semester code
        $ma_mon = $this->input->get('ma_mon'); // Get subject code
        $limit = 8;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $data['phan_cong'] = $this->xacnhansv_model->searchPhanCong($keyword, $limit, $offset, $maHK, $ma_mon);

        // Calculate total pages and pass additional data to the view
        $data['total_rows'] = count($data['phan_cong']); // Replace with actual total rows query if available
        $data['total_pages'] = ceil($data['total_rows'] / $limit);
        $data['current_page'] = $page;
        $data['keyword'] = $keyword;
        $data['hoc_ky'] = $this->xacnhansv_model->get_hoc_ky();
        $data['ma_mon'] = $this->xacnhansv_model->get_all_monhoc();

        if (empty($data['phan_cong'])) {
            $data['message'] = 'Không có kết quả tìm kiếm';
        }

        $this->load->view('sinhvien/header', ['username' => $username]);
        $this->load->view('sinhvien/sinhvien_view', $data);
        $this->load->view('giangvien/footer');
    }

    public function tttk_sv()
    {
        $username = $this->session->userdata('username');


        // Lấy tổng số giảng viên từ model
        $data['sinh_vien'] = $this->xacnhansv_model->getAllSV();

        $this->load->view('sinhvien/header', ['username' => $username]);
        $this->load->view('sinhvien/tttk_sv', $data);
        $this->load->view('giangvien/footer');
    }

    public function ctsll($maPC)
    {
    
        $username = $this->session->userdata('username');
        $data['info'] = $this->xacnhansv_model->getPhanCongById($maPC);

        $data['chi_tiet_so_len_lop'] = $this->xacnhansv_model->get_all_solenlop($maPC);

        // Tính tổng số tiết và buổi
        $totals = $this->xacnhansv_model->calculate_totals($maPC);
        $data['totals'] = $totals; // Thêm tổng vào dữ liệu truyền vào view

        // Load the view and pass the data
        $this->load->view('sinhvien/header', ['username' => $username]);
        $this->load->view('giangvien/chitietsll', $data);
        $this->load->view('giangvien/footer');
    }
    
    public function update($maPC) {
        // Lấy dữ liệu từ POST
        $maCT = $this->input->post('maCT'); // Giả sử bạn gửi maCT từ form
        $sinhVienInfo = $this->xacnhansv_model->getSinhVienInfo(); // Lấy thông tin sinh viên
        $maSV = $sinhVienInfo[0]['maSV']; // Lấy mã sinh viên từ mảng dữ liệu
    
        // Kiểm tra xem mã sinh viên đã tồn tại trong cột tenSV_vang hay chưa
        $isExist = $this->xacnhansv_model->checkSinhVienExist($maSV, $maCT);
    
        if ($isExist) {
            // Mã sinh viên đã tồn tại
            $this->session->set_flashdata('message', 'Sinh viên vắng mặt không có quyền xác nhận!');
            redirect(base_url('xacnhan_ctsll' . $maPC));
        } else {
            // Tạo dữ liệu cho cập nhật
            $data = array(
                'xacnhansv' => $maSV . '-' . $sinhVienInfo[0]['holot'] . ' ' . $sinhVienInfo[0]['tenSV'] // Gắn chuỗi xác nhận sinh viên
            );
    
            // Cập nhật xác nhận sinh viên
            if ($this->xacnhansv_model->updateXacNhanSV($maCT, $data)) {
                // Cập nhật thành công
                $this->session->set_flashdata('message', 'Cập nhật thành công!');
                redirect(base_url('xacnhan_ctsll' . $maPC));
            } else {
                // Cập nhật thất bại
                $this->session->set_flashdata('message', 'Cập nhật thất bại!');
                redirect(base_url('xacnhan_ctsll' . $maPC));
            }
        }
    }
    
    

}
