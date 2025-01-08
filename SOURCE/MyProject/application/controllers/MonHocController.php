<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MonHocController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MonHocModel');
        $this->load->helper('url');
        $this->load->library('session');

    }

    public function index_monhoc()
    {
        $username = $this->session->userdata('username');
        $limit = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy tổng số môn học từ model
        $total_rows = $this->MonHocModel->getTotalRows();
        $data['mon_hoc'] = $this->MonHocModel->getAllMonHoc($limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);

        $this->load->view('admin/header', ['username' => $username]);
        $this->load->view('admin/monhoc/monhoc_view', $data);
        $this->load->view('admin/footer');
    }


    public function search()
    {
        $username = $this->session->userdata('username');
        $keyword = $this->input->GET('keyword');
        $limit = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy tổng số môn học từ model
        $total_rows = $this->MonHocModel->getTotalRowsSearch($keyword);
        $data['mon_hoc'] = $this->MonHocModel->searchMonHoc($keyword, $limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);
        $data['keyword'] = $keyword;

        if (empty($data['mon_hoc'])) {
            $data['message'] = 'Không có kết quả tìm kiếm';
        }

        $this->load->view('admin/header', ['username' => $username]);
        $this->load->view('admin/monhoc/monhoc_view', $data);
        $this->load->view('admin/footer');
    }

    // Thêm mới môn học
    public function add()
    {
        $username = $this->session->userdata('username');
        if ($this->input->post()) {
            $maMH = $this->input->post('maMH');
            $tenMH = $this->input->post('tenMH');
            $tongsotiet = $this->input->post('tongsotiet');
            $SoTC = $this->input->post('SoTC');

            // Kiểm tra xem mã môn học đã tồn tại hay chưa
            $monHoc = $this->MonHocModel->getMonHocById($maMH);
            if ($monHoc) {
                // Mã môn học đã tồn tại, hiển thị thông báo lỗi
                $this->session->set_flashdata('error', 'Mã môn học đã tồn tại');
                $data['error'] = $this->session->flashdata('error');
                $this->load->view('admin/header');
                $this->load->view('admin/monhoc/create', $data);
                $this->load->view('admin/footer');
            } else {
                // Mã môn học chưa tồn tại, thêm mới
                $data = array(
                    'maMH' => $maMH,
                    'tenMH' => $tenMH,
                    'tongsotiet' => $tongsotiet,
                    'SoTC' => $SoTC
                );
                $this->MonHocModel->addMonHoc($data);
                $this->session->set_flashdata('success', 'Thêm môn học thành công');
                redirect(base_url('quanlymonhoc'));
            }
        } else {
            $this->load->view('admin/header', ['username' => $username]);
            $this->load->view('admin/monhoc/create');
            $this->load->view('admin/footer');
        }
    }


    // Sửa thông tin môn học
    public function edit($maMH)
    {
        $username = $this->session->userdata('username');
        if ($this->input->post()) {
            $data = array(
                'tenMH' => $this->input->post('tenMH'),
                'tongsotiet' => $this->input->post('tongsotiet'),
                'SoTC' => $this->input->post('SoTC')
            );
            $this->MonHocModel->updateMonHoc($maMH, $data);
            redirect(base_url('quanlymonhoc'));
        } else {
            $data['mon_hoc'] = $this->MonHocModel->getMonHocById($maMH);
            $this->load->view('admin/header', ['username' => $username]);
            $this->load->view('admin/monhoc/edit', $data);
            $this->load->view('admin/footer');
        }
    }

    // Xóa môn học
    public function delete($maMH)
    {
        // Tạm thời tắt kiểm tra khóa ngoại
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        
        // Xóa dữ liệu liên quan trong bảng nhóm môn học trước
        $this->db->delete('nhommonhoc', array('maMH' => $maMH));
        
        // Xóa dữ liệu liên quan trong bảng phân công trước
        $this->db->delete('phan_cong', array('maMH' => $maMH));
        
        // Xóa dữ liệu từ bảng môn học
        $result = $this->MonHocModel->deleteMonHoc($maMH);
        
        // Bật lại kiểm tra khóa ngoại
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
        
        if ($result) {
            $this->session->set_flashdata('success', 'Xóa môn học thành công.');
        } else {
            $this->session->set_flashdata('error', 'Không thể xóa môn học.');
        }
    
        redirect(base_url('quanlymonhoc'));
    }
    

    


    
    // Tìm kiếm môn học
    
}
