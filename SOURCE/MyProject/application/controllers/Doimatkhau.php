<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doimatkhau extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DoimatkhauModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        // Load view
        $username = $this->session->userdata('username');
        $this->load->view('login/header');
        $this->load->view('login/doimatkhau', ['username' => $username]);
        $this->load->view('login/footer');
        // Lưu URL hiện tại vào session

    }

    public function change_password()
{
    $username = $this->session->userdata('username');
   
    
    // Check if user is logged in
    if (!$this->session->userdata('user_id')) {
        redirect(base_url('dangnhap')); // Redirect to login page if not logged in
    }

    // Check if there is POST data
    if ($this->input->post()) {
        // Get user ID based on username
        $user_id = $this->DoimatkhauModel->get_account_id_by_username($username);
        
        if ($user_id) {
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');

            // Validate new password and confirm password
            if ($new_password === $confirm_password) {
                // Update the new password in the database
                if ($this->DoimatkhauModel->update_password($user_id, $new_password)) {
                    // Success message
                    $this->session->set_flashdata('success', 'Đổi mật khẩu thành công.');
                } else {
                    // Database error
                    $this->session->set_flashdata('error', 'Có lỗi xảy ra khi cập nhật mật khẩu.');
                }
                // Lấy URL trước đó từ session
                $role = $this->session->userdata('role'); // Lấy role từ session
                if ($role === 'Giảng viên') {
                    redirect(base_url('lichdaygv')); // Chuyển hướng đến lichdaygv nếu người dùng là Giảng viên
                } elseif ($role === 'Sinh viên') {
                    redirect(base_url('xacnhansv')); // Chuyển hướng đến xacnhansv nếu người dùng là Sinh viên
                } else {
                    redirect(base_url('quanlygiangvien')); // Mặc định chuyển hướng đến trang quản lý giảng viên
                }
                
            } else {
                // Passwords do not match
                $this->session->set_flashdata('error', 'Mật khẩu mới và xác nhận không khớp.');
                redirect(base_url('doimatkhau'));
            }
        } else {
            // User not found
            $this->session->set_flashdata('error', 'Người dùng không tồn tại.');
            redirect(base_url('doimatkhau'));
        }
    }

    // Display the change password page
    $this->load->view('login/header');
    $this->load->view('login/doimatkhau', ['username' => $username]);
    $this->load->view('login/footer');
}

    

}