<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TaiKhoanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TaiKhoanModel');
        $this->load->helper('url'); // Hỗ trợ base_url
        $this->load->library('session');
    }

    // Trang danh sách tài khoản
    public function index()
    {
        $username_ss = $this->session->userdata('username');
        $limit = 10; // Số tài khoản hiển thị mỗi trang
        $offset = $this->input->get('page') ? ($this->input->get('page') - 1) * $limit : 0;
        $keyword = $this->input->get('keyword'); // Tìm kiếm nếu có

        if ($keyword) {
            // Lấy dữ liệu tìm kiếm
            $data['tai_khoan'] = $this->TaiKhoanModel->searchTaiKhoan($keyword, $limit, $offset);
            $total_rows = $this->TaiKhoanModel->getTotalRowsSearch($keyword);
        } else {
            // Lấy toàn bộ danh sách
            $data['tai_khoan'] = $this->TaiKhoanModel->getAllTaiKhoan($limit, $offset);
            $total_rows = $this->TaiKhoanModel->getTotalRows();
        }

        $data['current_page'] = $this->input->get('page') ? $this->input->get('page') : 1;
        $data['total_pages'] = ceil($total_rows / $limit);

        $this->load->view('admin/header', ['username' => $username_ss]);
        $this->load->view('admin/taikhoan/qltaikhoan', $data);
        $this->load->view('admin/footer');
    }

    // Xóa tài khoản
    public function xoa_taikhoan($matk)
    {
        // Xóa bản ghi liên quan từ bảng sinh_vien
        if (!$this->TaiKhoanModel->xoa_sinh_vien($matk)) {
            show_error('Không thể xóa dữ liệu liên quan từ bảng sinh_vien.');
            return;
        }
    
        // Xóa bản ghi liên quan từ bảng giang_vien
        if (!$this->TaiKhoanModel->xoa_giang_vien($matk)) {
            show_error('Không thể xóa dữ liệu liên quan từ bảng giang_vien.');
            return;
        }
    
        // Xóa tài khoản từ bảng tai_khoan
        if ($this->TaiKhoanModel->deleteTaiKhoan($matk)) {
            redirect(base_url('quanlytaikhoan'));
        } else {
            show_error('Không thể xóa tài khoản.');
        }
    }
    

    // Sửa tài khoản
    public function sua_taikhoan($matk)
    {
        $username_ss = $this->session->userdata('username');
        $data['tai_khoan'] = $this->TaiKhoanModel->getTaiKhoanById($matk);

        if ($this->input->post()) {
            $update_data = array(
                'username' => $this->input->post('username'),
                'quyen' => $this->input->post('quyen'),
                'matkhau' => $this->input->post('matkhau'),
            );
            if ($this->TaiKhoanModel->updateTaiKhoan($matk, $update_data)) {
                redirect(base_url('quanlytaikhoan'));
            } else {
                $data['error'] = 'Cập nhật không thành công.';
            }
        }

        $this->load->view('admin/header', ['username' => $username_ss]);
        $this->load->view('admin/taikhoan/edit', $data);
        $this->load->view('admin/footer');
    }

    // Thêm tài khoản
    public function them_taikhoan()
    {
        $username_ss = $this->session->userdata('username');
        if ($this->input->post()) {
            $new_data = array(
                'username' => $this->input->post('username'),
                'matkhau' => $this->input->post('matkhau'),
                'quyen' => $this->input->post('quyen'),
            );

            if ($this->TaiKhoanModel->addTaiKhoan($new_data)) {
                redirect(base_url('quanlytaikhoan'));
            } else {
                $this->session->set_flashdata('error', 'Tên tài khoản đã tồn tại.');
            }
        }

        $this->load->view('admin/header', ['username' => $username_ss]);
        $this->load->view('admin/taikhoan/create');
        $this->load->view('admin/footer');
    }

    public function search()
    {
        $username_ss = $this->session->userdata('username');
        $keyword = $this->input->get('keyword');
        $limit = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy tổng số tài khoản từ model
        $total_rows = $this->TaiKhoanModel->getTotalRowsSearch($keyword);
        $data['tai_khoan'] = $this->TaiKhoanModel->searchTaiKhoan($keyword, $limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);
        $data['keyword'] = $keyword;

        if (empty($data['tai_khoan'])) {
            $data['message'] = 'Không có kết quả tìm kiếm';
        }

        $this->load->view('admin/header', ['username' => $username_ss]);
        $this->load->view('admin/taikhoan/qltaikhoan', $data);
        $this->load->view('admin/footer');
    }
}
