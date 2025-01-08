<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DonViController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DonViModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    // Hiển thị danh sách đơn vị
    public function index_donvi()
    {
        $username = $this->session->userdata('username');
        $limit = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy tổng số đơn vị từ model
        $total_rows = $this->DonViModel->getTotalRows();
        $data['don_vi'] = $this->DonViModel->getAllDonVi($limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);

        $this->load->view('admin/header', ['username' => $username]);
        $this->load->view('admin/donvi/donvi', $data);
        $this->load->view('admin/footer');
    }

    // Thêm mới đơn vị
    public function add()
    {
        $username = $this->session->userdata('username');
        if ($this->input->post()) {
            $madv = $this->input->post('madv');
            $tendonvi = $this->input->post('tendonvi');

            // Kiểm tra xem mã đơn vị đã tồn tại hay chưa
            $donVi = $this->DonViModel->getDonViById($madv);
            if ($donVi) {
                // Mã đơn vị đã tồn tại, hiển thị thông báo lỗi
                $this->session->set_flashdata('error', 'Mã đơn vị đã tồn tại');
                redirect(base_url('donvi/add'));
            } else {
                // Mã đơn vị chưa tồn tại, thêm mới
                $data = array(
                    'madv' => $madv,
                    'tendonvi' => $tendonvi
                );

                $this->DonViModel->addDonVi($data);
                $this->session->set_flashdata('success', 'Thêm đơn vị thành công');
                redirect(base_url('quanlydonvi'));
            }
        } else {
            $this->load->view('admin/header', ['username' => $username]);
            $this->load->view('admin/donvi/create');
            $this->load->view('admin/footer');
        }
    }

    // Sửa thông tin đơn vị
    public function edit($madv)
    {
        $username = $this->session->userdata('username');
        if ($this->input->post()) {
            // Lấy dữ liệu từ POST
            $data = array(
                'tendonvi' => $this->input->post('tendonvi')
            );

            // Cập nhật đơn vị
            $this->DonViModel->updateDonVi($madv, $data);
            $this->session->set_flashdata('success', 'Cập nhật đơn vị thành công');
            redirect(base_url('quanlydonvi'));
        } else {
            // Lấy thông tin đơn vị và tải view
            $data['don_vi'] = $this->DonViModel->getDonViById($madv);
            $this->load->view('admin/header', ['username' => $username]);
            $this->load->view('admin/donvi/edit', $data);
            $this->load->view('admin/footer');
        }
    }

    // Xóa đơn vị
    public function delete($madv)
    {
        // Tạm thời tắt kiểm tra khóa ngoại
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        
        // Xóa dữ liệu từ bảng đơn vị
        $this->DonViModel->deleteDonVi($madv);
        
        // Bật lại kiểm tra khóa ngoại
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
        
        $this->session->set_flashdata('success', 'Xóa đơn vị thành công');
        redirect(base_url('quanlydonvi'));
    }
    

    // Tìm kiếm đơn vị
    public function search()
    {
        $username = $this->session->userdata('username');
        $keyword = $this->input->get('keyword');
        $limit = 5;
        $page = isset($_GET[' page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy tổng số đơn vị từ model
        $total_rows = $this->DonViModel->getTotalRowsSearch($keyword);
        $data['don_vi'] = $this->DonViModel->searchDonVi($keyword, $limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);
        $data['keyword'] = $keyword;

        if (empty($data['don_vi'])) {
            $data['message'] = 'Không có kết quả tìm kiếm';
        }

        $this->load->view('admin/header', ['username' => $username]);
        $this->load->view('admin/donvi/donvi', $data);
        $this->load->view('admin/footer');
    }
}