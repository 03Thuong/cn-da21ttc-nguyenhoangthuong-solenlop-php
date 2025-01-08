<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NhomMonHocController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('NhomMonHocModel'); // Load the model for subject groups
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index_nhommonhoc()
    {
        $username = $this->session->userdata('username');
    $limit = 5; // Số lượng nhóm môn học trên mỗi trang
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Lấy từ khóa tìm kiếm
    $keyword = $this->input->get('keyword');

    // Kiểm tra xem có từ khóa tìm kiếm hay không
    if (!empty($keyword)) {
        // Nếu có tìm kiếm, lấy tổng số nhóm môn học tìm kiếm
        $total_rows = $this->NhomMonHocModel->getTotalRowsSearch($keyword);
        $data['nhom_mon_hoc'] = $this->NhomMonHocModel->searchNhomMonHoc($keyword, $limit, $offset);
    } else {
        // Nếu không có tìm kiếm, lấy tổng số nhóm môn học
        $total_rows = $this->NhomMonHocModel->getTotalRows();
        $data['nhom_mon_hoc'] = $this->NhomMonHocModel->getAllNhomMonHoc($limit, $offset);
    }

    $data['total_rows'] = $total_rows;
    $data['current_page'] = $page;
    $data['total_pages'] = ceil($total_rows / $limit);
    $data['keyword'] = $keyword;

    if (empty($data['nhom_mon_hoc'])) {
        $data['message'] = 'Không có kết quả tìm kiếm';
    }

    $this->load->view('admin/header', ['username' => $username]);
    $this->load->view('admin/nhommonhoc/nhommonhoc', $data);
    $this->load->view('admin/footer');
    }

    // Add new subject group
    public function add()
    {
        $username = $this->session->userdata('username');
        $data['mon_hoc'] = $this->NhomMonHocModel->getAllMonHoc(); // Fetch the list of subjects

        if ($this->input->post()) {
            $manhom = $this->input->post('manhom');
            $maMH = $this->input->post('maMH');
            $tenlopmonhoc = $this->input->post('tenlopmonhoc');

            // Check if the combination of manhom and maMH already exists
            $nhomMonHoc = $this->NhomMonHocModel->getNhomMonHocById($manhom, $maMH);
            if ($nhomMonHoc) {
                // The combination already exists, show an error message
                $this->session->set_flashdata('error', 'Mã nhóm môn học và mã môn học đã tồn tại');
                $data['error'] = $this->session->flashdata('error');
                $this->load->view('admin/header', ['username' => $username]);
                $this->load->view('admin/nhommonhoc/create', $data);
                $this->load->view('admin/footer');
            } else {
                // Add new subject group
                $data = array(
                    'manhom' => $manhom,
                    'maMH' => $maMH,
                    'tenlopmonhoc' => $tenlopmonhoc
                );
                $this->NhomMonHocModel->addNhomMonHoc($data); // Call the method to add data
                $this->session->set_flashdata('success', 'Thêm nhóm môn học thành công');
                redirect(base_url('quanlynhommonhoc')); // Redirect to the management page
            }
        } else {
            $this->load->view('admin/header', ['username' => $username]);
            $this->load->view('admin/nhommonhoc/create', $data); // Pass $data to the view
            $this->load->view('admin/footer');
        }
    }

    // Edit subject group
    public function edit($manhom, $maMH)
    {
        $data['username'] = $this->session->userdata('username');
        if ($this->input->post()) {
            $data = array(
                'tenlopmonhoc' => $this->input->post('tenlopmonhoc')
                // Bạn có thể thêm các trường khác nếu cần
            );
            $this->NhomMonHocModel->updateNhomMonHoc($manhom, $maMH, $data);
            redirect(base_url('quanlynhommonhoc'));
        } else {
            $data['nhom_mon_hoc'] = $this->NhomMonHocModel->getNhomMonHocById($manhom, $maMH);
            $this->load->view('admin/nhommonhoc/edit', $data);
            $this->load->view('admin/footer');
        }
    }

    // Delete subject group
    public function delete($manhom, $maMH)
    {
        $message = '';
        $message_type = '';

        // Bắt đầu transaction
        $this->db->trans_begin();

        try {
            // Xóa dữ liệu liên quan trong bảng phan_cong trước
            $this->db->where('manhom', $manhom);
            $this->db->where('maMH', $maMH);
            $this->db->delete('phan_cong');

            // Xóa dữ liệu trong bảng nhommonhoc
            $this->NhomMonHocModel->deleteNhomMonHoc($manhom, $maMH);

            // Kiểm tra trạng thái transaction
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Không thể xóa nhóm môn học.');
            }

            // Commit transaction nếu thành công
            $this->db->trans_commit();
            $message = 'Xóa nhóm môn học thành công!';
            $message_type = 'success';
        } catch (Exception $e) {
            // Rollback nếu có lỗi
            $this->db->trans_rollback();
            $message = $e->getMessage();
            $message_type = 'error';
        }

        // Chuyển hướng với thông báo
        $data = [
            'message' => $message,
            'message_type' => $message_type
        ];
        redirect(base_url('quanlynhommonhoc'));
    }



    // Search subject groups
    

}