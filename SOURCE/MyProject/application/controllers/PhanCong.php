<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'scr/vendor/autoload.php'; // Autoloader của Composer
use PhpOffice\PhpSpreadsheet\IOFactory;
class PhanCong extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PhancongModel'); // Khởi tạo model
        $this->load->helper('url'); // Load URL helper
        $this->load->library('session');
    }

    private function getPaginationData($searchTerm = null)
{
    $limit = 10; // Số dòng mỗi trang
    $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $limit;

    // Nếu có từ khóa tìm kiếm, áp dụng tìm kiếm
    if ($searchTerm) {
        $data['phan_cong'] = $this->PhancongModel->searchPhanCong($searchTerm, $limit, $offset);
        $data['total_rows'] = $this->PhancongModel->getTotalRowsSearch($searchTerm);
    } else {
        $data['phan_cong'] = $this->PhancongModel->getAllPhanCong($limit, $offset);
        $data['total_rows'] = $this->PhancongModel->getTotalRows();
    }

    $data['total_pages'] = ceil($data['total_rows'] / $limit);
    $data['current_page'] = $currentPage;
    $data['hocKyResult'] = $this->PhancongModel->get_hoc_ky(); // Dữ liệu học kỳ

    return $data;
}

public function index()
{
    $username = $this->session->userdata('username');
    $data = $this->getPaginationData(); // Gọi hàm chung, không truyền từ khóa tìm kiếm

    $this->load->view('admin/header', ['username' => $username]);
    $this->load->view('admin/kehoachday', $data);
    $this->load->view('admin/footer');
}


public function search()
{
    $username = $this->session->userdata('username');
    $searchTerm = $this->input->post('search_term');
    $data = $this->getPaginationData($searchTerm); // Gọi hàm chung với từ khóa tìm kiếm

    $this->load->view('admin/header', ['username' => $username]);
    $this->load->view('admin/kehoachday', $data);
    $this->load->view('admin/footer');
}



    public function import_excel()
    {
        if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            die("Lỗi tải tệp lên.");
        }

        $maHK = $this->input->post('hoc_ky');
        $file = $_FILES['excel_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        foreach ($data as $index => $row) {
            if ($index < 8)
                continue; // Bỏ qua các dòng header hoặc header không cần thiết

            $cbgd = implode(' ', array_slice($row, 0, 7));
            if ($cbgd) {
                if (preg_match('/CBGD:\s*(.*?)\s*-\s*(\S+)\s*-\s*(.+)/', $cbgd, $matches)) {
                    $tenGV = $matches[1];
                    $maGV = $matches[2];
                    $tendonvi = $matches[3];


                    // Kiểm tra và thêm tên đơn vị vào bảng đơn vị
                    if ($tendonvi) {
                        $madv = $this->PhancongModel->checkAndInsertDonVi($tendonvi);
                    }

                    // Call the method from the model
                    $this->PhancongModel->insert_account($maGV);


                    // Dữ liệu cho bảng sinh viên
                    $GVData = array(
                        'maGV' => $maGV,
                        'tenGV' => $tenGV,
                        'madv' => $madv,
                        'matk' => $this->db->insert_id() // Lấy ID của tài khoản vừa thêm
                    );

                    // Insert vào bảng sinh viên
                    $this->PhancongModel->insert_giang_vien($GVData);
                }
            }

            if ($index < 12)
                continue; // Bỏ qua các dòng trước 12

            $maMH = $row[2];
            $tenMH = implode(' ', array_slice($row, 3, 5));
            $tongsotiet = $row[8];
            $soTC = $row[9];
            $manhom = $row[10];
            $tenlopmonhoc = $row[12];


            if ($manhom == 0 || $maMH == 0 || empty($maMH) || empty($tenMH) || empty($tongsotiet) || empty($soTC) || empty($manhom) || empty($tenlopmonhoc)) {
                continue; // Bỏ qua dữ liệu không hợp lệ
            }

            $this->PhancongModel->insert_mon_hoc($maMH, $tenMH, $tongsotiet, $soTC);
            $this->PhancongModel->insert_nhom_mon_hoc($manhom, $maMH, $tenlopmonhoc);

            if (!empty($maGV) && !empty($manhom) && !empty($tenlopmonhoc)) {
                $this->PhancongModel->insert_phan_cong($manhom, $maMH, $maGV, $maHK);
            }
        }

        echo "Import và phân công thành công!";
        // Điều hướng đến trang kế hoạch dạy
        redirect(base_url('PhanCong'));
    }
   


}
