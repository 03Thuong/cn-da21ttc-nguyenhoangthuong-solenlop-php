<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Khởi tạo kết nối cơ sở dữ liệu
    }

    public function login($username, $password) {
        // Lấy thông tin tài khoản từ cơ sở dữ liệu
        $this->db->where('username', $username);
        $query = $this->db->get('tai_khoan');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Kiểm tra mật khẩu (nên mã hóa mật khẩu trong thực tế)
            if ($user->matkhau === $password) {
                return $user; // Trả về thông tin người dùng
            }
        }
        return false; // Đăng nhập không thành công
    }

    

}