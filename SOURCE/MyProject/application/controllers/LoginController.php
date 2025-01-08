<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel'); // Load the semester model
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        // Load view
        $this->load->view('login/header');
        $this->load->view('login/login');
        $this->load->view('login/footer');
    }

    public function login()
    {
        // Kiểm tra xem có dữ liệu POST không
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Gọi hàm login từ model
            $user = $this->LoginModel->login($username, $password);

            if ($user) {
                // Lưu thông tin người dùng vào session
                $this->session->set_userdata('user_id', $user->matk);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->quyen);

                // Chuyển hướng đến trang chính hoặc trang khác dựa trên quyền
                switch ($user->quyen) {
                    case 'Admin':
                        redirect(base_url('quanlygiangvien'));
                        break;
                    case 'Giảng viên':
                        redirect(base_url('lichdaygv'));
                        break;
                    case 'Sinh viên':
                        redirect(base_url('xacnhansv'));
                        break;
                    default:
                        // Nếu quyền không hợp lệ, thông báo lỗi và chuyển hướng về home
                        $this->session->set_flashdata('error', 'Bạn không có quyền truy cập.');
                        redirect(base_url('home')); // Thay 'home' bằng đường dẫn trang chính của bạn
                        break;
                }
            } else {
                // Đăng nhập không thành công
                $this->session->set_flashdata('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
                redirect(base_url('dangnhap')); // Redirect back to login page
            }
        } else {
            // Hiển thị trang đăng nhập
            $this->load->view('login/header');
            $this->load->view('login/login');
            $this->load->view('login/footer');
        }
    }

    public function logout()
    {
        // Xóa session và chuyển hướng về trang đăng nhập
        $this->session->sess_destroy();
        redirect(base_url('home'));
    }


}