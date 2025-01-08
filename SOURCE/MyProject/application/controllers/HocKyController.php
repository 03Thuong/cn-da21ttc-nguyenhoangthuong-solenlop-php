<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HocKyController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('HocKyModel'); // Load the semester model
        $this->load->helper('url');
        $this->load->library('session');
        
    }

    public function index_hocky()
    {
        $username = $this->session->userdata('username');
        $limit = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Get total number of semesters from model
        $total_rows = $this->HocKyModel->getTotalRows();
        $data['hoc_ky'] = $this->HocKyModel->getAllHocKy($limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);

        $this->load->view('admin/header', ['username' => $username]);
        $this->load->view('admin/hocky/hocky', $data);
        $this->load->view('admin/footer');
    }

    // Add new semester
    public function add()
    {
        $username = $this->session->userdata('username');
        if ($this->input->post()) {
            $maHK = $this->input->post('maHK');
            $tenHK = $this->input->post('tenHK');
            $namhoc = $this->input->post('namhoc');

            // Check if semester ID already exists
            $hocKy = $this->HocKyModel->getHocKyById($maHK);
            if ($hocKy) {
                // Semester ID already exists, show error message
                $this->session->set_flashdata('error', 'Mã học kỳ đã tồn tại');
                $data['error'] = $this->session->flashdata('error');
                $this->load->view('admin/header');
                $this->load->view('admin/hocky/create', $data);
                $this->load->view('admin/footer');
            } else {
                // Semester ID does not exist, add new semester
                $data = array(
                    'maHK' => $maHK,
                    'tenHK' => $tenHK,
                    'namhoc' => $namhoc
                );
                $this->HocKyModel->addHocKy($data);
                $this->session->set_flashdata('success', 'Thêm học kỳ thành công');
                redirect(base_url('quanlyhocky'));
            }
        } else {
            $this->load->view('admin/header', ['username' => $username]);
            $this->load->view('admin/hocky/create');
            $this->load->view('admin/footer');
        }
    }

    // Edit semester information
    public function edit($maHK)
    {
        $username = $this->session->userdata('username');
        if ($this->input->post()) {
            // Get data from POST
            $data = array(
                'tenHK' => $this->input->post('tenHK'),
                'namhoc' => $this->input->post('namhoc')
            );

            // Update semester
            $this->HocKyModel->updateHocKy($maHK, $data);
            redirect(base_url('quanlyhocky'));
        } else {
            // Get semester information and load view
            $data['hoc_ky'] = $this->HocKyModel->getHocKyById($maHK);
            $this->load->view('admin/header', ['username' => $username]);
            $this->load->view('admin/hocky/edit', $data);
            $this->load->view('admin/footer');
        }
    }

    // Delete semester
    public function delete($maHK)
    {
        // Bắt đầu transaction
        $this->db->trans_begin();
    
        try {
            // Xóa dữ liệu liên quan trong bảng phan_cong trước
            $this->db->where('maHK', $maHK);
            $this->db->delete('phan_cong');
    
            // Xóa dữ liệu trong bảng hocky
            $this->HocKyModel->deleteHocKy($maHK);
    
            // Kiểm tra trạng thái transaction
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Không thể xóa học kỳ.');
            }
    
            // Commit transaction nếu thành công
            $this->db->trans_commit();
        } catch (Exception $e) {
            // Rollback nếu có lỗi
            $this->db->trans_rollback();
        }
    
        // Chuyển hướng về danh sách học kỳ
        redirect(base_url('quanlyhocky'));
    }

    // Search semesters
    public function search()
    {
        $username = $this->session->userdata('username');
        $keyword = $this->input->get('keyword');
        $limit = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Get total number of semesters from model
        $total_rows = $this->HocKyModel->getTotalRowsSearch($keyword);
        $data['hoc_ky'] = $this->HocKyModel->searchHocKy($keyword, $limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);
        $data['keyword'] = $keyword;

        if (empty($data['hoc_ky'])) {
            $data['message'] = 'Không có kết quả tìm kiếm';
        }

        $this->load->view('admin/header', ['username' => $username]);
        $this->load->view('admin/hocky/hocky', $data);
        $this->load->view('admin/footer');
    }
}