<?php
defined('BASEPATH') or exit('No direct script access allowed');

class thongkeController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('thongkeModel');
        $this->load->helper('url'); // Hỗ trợ base_url
        $this->load->library('session');
    }

    public function thongke_so_tiet()
{
    $username = $this->session->userdata('username');
    $data['maGV'] = $this->session->userdata('username');

    // Get selected semester and academic year from POST data
    $selectedSemester = $this->input->post('search_term');
    $selectedYear = $this->input->post('n');

    // Fetch statistics based on selected semester and year
    $data['thongke'] = $this->thongkeModel->get_tong_so_tiet_by_gv($selectedSemester, $selectedYear);
    $data['tenGV'] = $this->thongkeModel->get_teacher_name($data['maGV']);
    $data['hocKyResult'] = $this->thongkeModel->get_hoc_ky();
    $data['namhoc'] = $this->thongkeModel->get_hoc_ky_unique_namhoc();
    $this->load->view('giangvien/header', ['username' => $username]);
    $this->load->view('giangvien/thongke', $data);
    $this->load->view('giangvien/footer');
}

public function thongke_admin()
{
    $username = $this->session->userdata('username');

    // Get selected semester and academic year from POST data
    $selectedSemester = $this->input->post('search_term');
    $selectedYear = $this->input->post('n');
    $selecteddonvi = $this->input->post('donvi'); // Lấy mã đơn vị từ form

    // Pagination settings
    $current_page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
    $limit = 10; // Number of records per page
    $offset = ($current_page - 1) * $limit;

    // Fetch statistics for all teachers based on selected semester and year
    
    $data['thongke'] = $this->thongkeModel->get_tong_so_tiet_all_gv($selectedSemester, $selectedYear, $selecteddonvi, $limit, $offset);
    $data['total_records'] = $this->thongkeModel->count_tong_so_tiet_all_gv($selectedSemester, $selectedYear, $selecteddonvi);
    
    $data['total_pages'] = ceil($data['total_records'] / $limit);
    $data['current_page'] = $current_page;

    $data['hocKyResult'] = $this->thongkeModel->get_hoc_ky();
    $data['namhoc'] = $this->thongkeModel->get_hoc_ky_unique_namhoc();
    $data['donvi'] = $this->thongkeModel->get_don_vi();
    $this->load->view('admin/header', ['username' => $username]);
    $this->load->view('admin/thongke_admin', $data);
    $this->load->view('admin/footer');
}


}