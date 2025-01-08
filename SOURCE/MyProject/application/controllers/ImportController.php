<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImportController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ImportModel');
    }

    public function import_excel() {
        if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            die("Lỗi tải tệp lên.");
        }

        $maHK = $this->input->post('hoc_ky');
        $file = $_FILES['excel_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        foreach ($data as $index => $row) {
            if ($index < 8) continue; // Bỏ qua các dòng header hoặc header không cần thiết

            $cbgd = implode(' ', array_slice($row, 0, 7));
            if ($cbgd) {
                if (preg_match('/CBGD:\s*(.*?)\s*-\s*(\S+)\s*-\s*(.+)/', $cbgd, $matches)) {
                    $tenGV = $matches[1];
                    $maGV = $matches[2];
                    $tendonvi = $matches[3];

                    $this->ImportModel->insert_giang_vien($maGV, $tenGV, $tendonvi);
                }
            }

            if ($index < 12) continue; // Bỏ qua các dòng trước 12

            $maMH = $row[2];
            $tenMH = implode(' ', array_slice($row, 3, 5));
            $tongsotiet = $row[8];
            $soTC = $row[9];
            $manhom = $row[10];
            $tenlopmonhoc = $row[12];

            if ($manhom == 0 || $maMH == 0 || empty($maMH) || empty($tenMH) || empty($tongsotiet) || empty($soTC) || empty($manhom) || empty($tenlopmonhoc)) {
                continue;
            }

            $this->ImportModel->insert_mon_hoc($maMH, $tenMH, $tongsotiet, $soTC);
            $this->ImportModel->insert_nhom_mon_hoc($manhom, $maMH, $tenlopmonhoc);

            if (!empty($maGV) && !empty($manhom) && !empty($tenlopmonhoc)) {
                $this->ImportModel->insert_phan_cong($manhom, $maMH, $maGV, $maHK);
            }
        }

        echo "Import và phân công thành công!";
    }
}
