<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LichDayController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('LichDayModel'); // Khởi tạo model
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
        $total_rows = $this->LichDayModel->getTotalRows();

        // Lấy dữ liệu phân công
        $data['phan_cong'] = $this->LichDayModel->getAllPhanCong($limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);

        // Lấy dữ liệu học kỳ cho giao diện (có thể dùng cho filter hoặc dropdown, v.v.)
        $data['hocKyResult'] = $this->LichDayModel->get_hoc_ky();

        // Load view
        $this->load->view('giangvien/header', ['username' => $username]);
        $this->load->view('giangvien/lichday_gv', $data);
        $this->load->view('giangvien/footer');
    }



    public function search()
    {
        $username = $this->session->userdata('username');
        $searchTerm = $this->input->post('search_term');
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = 5; // Set limit to 10
        $offset = ($currentPage - 1) * $limit; // Calculate offset

        $data['phan_cong'] = $this->LichDayModel->searchPhanCong($searchTerm, $limit, $offset);
        $data['hocKyResult'] = $this->LichDayModel->get_hoc_ky(); // Nếu cần
        $data['total_rows'] = $this->LichDayModel->getTotalRows(); // Tổng số hàng để phân trang
        $data['total_pages'] = ceil($data['total_rows'] / $limit); // Tính tổng số trang
        $data['current_page'] = $currentPage; // Lưu trang hiện tại

        // Load view
        $this->load->view('giangvien/header', ['username' => $username]);
        $this->load->view('giangvien/lichday_gv', $data);
        $this->load->view('giangvien/footer');

    }



}
