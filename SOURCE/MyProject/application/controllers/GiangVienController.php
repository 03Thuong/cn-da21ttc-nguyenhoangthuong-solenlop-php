<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GiangVienController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('GiangVienModel');
        $this->load->helper('url');
        $this->load->library('session');

    }

    public function index_giangvien()
    {
        $username = $this->session->userdata('username');
        $limit = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

       
        // Lấy tổng số giảng viên từ model
        $total_rows = $this->GiangVienModel->getTotalRows();
        $data['giang_vien'] = $this->GiangVienModel->getAllGiangVien($limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);


        $this->load->view('admin/header', ['username' => $username]);
        $this->load->view('admin/giangvien/giang_vien_view', $data);
        $this->load->view('admin/footer');
    }

    // Thêm mới giảng viên
    public function add()
    {
        $data['don_vi'] = $this->GiangVienModel->getAllDonVi();
        $username = $this->session->userdata('username');
        if ($this->input->post()) {
            $maGV = $this->input->post('maGV');
            $tenGV = $this->input->post('tenGV');
            
            $madv = $this->input->post('madv');
            $matk = $this->input->post('matk');

            // Kiểm tra xem mã giảng viên đã tồn tại hay chưa
            $giangVien = $this->GiangVienModel->getGiangVienById($maGV);
            if ($giangVien) {
                // Mã giảng viên đã tồn tại, hiển thị thông báo lỗi
                $this->session->set_flashdata('error', 'Mã giảng viên đã tồn tại');
                $data['error'] = $this->session->flashdata('error');
                $this->load->view('admin/header');
                $this->load->view('admin/giangvien/create', $data);
                $this->load->view('admin/footer');
            } else {
                // Mã giảng viên chưa tồn tại, thêm mới
                $data = array(
                    'maGV' => $maGV,
                    'tenGV' => $tenGV,
                    'madv' => $madv,
                    'matk' => $matk ? $matk : null
                );
                // Thêm tài khoản sinh viên
                
                $this->GiangVienModel->addGiangVien($data);
                $this->session->set_flashdata('success', 'Thêm giảng viên thành công');
                redirect(base_url('quanlygiangvien'));
            }
        } else {
            $this->load->view('admin/header', ['username' => $username]);
            $this->load->view('admin/giangvien/create', $data);
            $this->load->view('admin/footer');
        }
    }

    // Sửa thông tin giảng viên
    public function edit($maGV)
    {
        $data['don_vi'] = $this->GiangVienModel->getAllDonVi();
        $username = $this->session->userdata('username');
        if ($this->input->post()) {
            // Lấy dữ liệu từ POST
            $data = array(
                'tenGV' => $this->input->post('tenGV'),
                'madv' => $this->input->post('madv')
            );
    
            // Kiểm tra giá trị matk trước khi thêm vào mảng $data
            $matk = $this->input->post('matk');
            if (!empty($matk)) {
                $data['matk'] = $matk;
            }
    
            // Cập nhật giảng viên
            $this->GiangVienModel->updateGiangVien($maGV, $data);
            redirect(base_url('quanlygiangvien'));
        } else {
            // Lấy thông tin giảng viên và tải view
            $data['giang_vien'] = $this->GiangVienModel->getGiangVienById($maGV);
            $this->load->view('admin/header', ['username' => $username]);
            $this->load->view('admin/giangvien/edit', $data);
            $this->load->view('admin/footer');
        }
    }
    

    // Xóa giảng viên
    public function delete($maGV)
    {
        // Xóa dữ liệu liên quan trong bảng phân công trước
        $this->db->delete('phan_cong', array('maGV' => $maGV));
        
        // Xóa dữ liệu từ bảng giảng viên
        $this->GiangVienModel->deleteGiangVien($maGV);
        
        // Chuyển hướng về trang quản lý giảng viên
        redirect(base_url('quanlygiangvien'));
    }
    


    // Tìm kiếm giảng viên
    public function search()
    {
        $username = $this->session->userdata('username');
        $keyword = $this->input->GET('keyword');
        $limit = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy tổng số giảng viên từ model
        $total_rows = $this->GiangVienModel->getTotalRowsSearch($keyword);
        $data['giang_vien'] = $this->GiangVienModel->searchGiangVien($keyword, $limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);
        $data['keyword'] = $keyword;

        if (empty($data['giang_vien'])) {
            $data['message'] = 'Không có kết quả tìm kiếm';
        }

        $this->load->view('admin/header', ['username' => $username]);
        $this->load->view('admin/giangvien/giang_vien_view', $data);
        $this->load->view('admin/footer');
    }
}