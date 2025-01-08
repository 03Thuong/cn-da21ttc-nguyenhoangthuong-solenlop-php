<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SolenlopController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SolenlopModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index($maPC)
    {
        $username = $this->session->userdata('username');
         // Lấy dữ liệu từ model
         $data['info'] = $this->SolenlopModel->getPhanCongById($maPC);
        // Get the data from the model
        $data['chi_tiet_so_len_lop'] = $this->SolenlopModel->get_all_solenlop($maPC);

        // Tính tổng số tiết và buổi
        $totals = $this->SolenlopModel->calculate_totals($maPC);
        $data['totals'] = $totals; // Thêm tổng vào dữ liệu truyền vào view

        // Load the view and pass the data
        $this->load->view('admin/header', ['username' => $username]);
        $this->load->view('admin/solenlop/chitietsolenlop', $data);
        $this->load->view('admin/footer');
    }
}