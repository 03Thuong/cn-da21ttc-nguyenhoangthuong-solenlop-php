<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'scr/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;
class ctsllController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ctsllModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function exportPDF($maPC)
    {
        // Load model
        $this->load->model('ctsllModel');

        // Get data
        $data['chi_tiet_so_len_lop'] = $this->ctsllModel->get_all_solenlop($maPC);
        $info = $this->ctsllModel->getPhanCongById($maPC);



        // Initialize mPDF
        $mpdf = new Mpdf(['orientation' => 'L']);

        // Title
        $html = '<h1 style="text-align: center; font-family: Times New Roman;">BẢNG GHI TÓM TẮT NỘI DUNG GIẢNG DẠY</h1>';
        $html .= '<h3 style="text-align: center;font-weight: bold; font-family: Times New Roman;">HỌC KỲ: ' . $info['maHK'] . ' - NĂM HỌC: ' . $info['namhoc'] . '</h3>';

        $html .= '<br>';

        // Thong tin giang vien va mon hoc
        $html .= '<table style="width: 85%; font-family: Times New Roman; border-collapse: collapse; margin-bottom: 20px; table-layout: fixed;">';
        $html .= '<tr>
       <td style="width: 20%;"><b>Mã GV:</b> ' . $info['maGV'] . '</td>
       <td style="width: 30%;"><b>Tên GV:</b> ' . $info['tenGV'] . '</td>
       <td style="width: 20%;"><b>Mã lớp:</b> ' . $info['tenlopmonhoc'] . '</td>
       <td style="width: 20%;"><b>Mã nhóm:</b> ' . $info['manhom'] . '</td>
     </tr>';
        $html .= '<tr>
       <td style="width: 20%;"><b>Mã môn:</b> ' . $info['maMH'] . '</td>
        <td style="width: 45%;"><b>Tên đơn vị:</b> ' . $info['tendonvi'] . '</td>
        <td style="width: 20%;"><b>Tổng số tiết:</b> ' . $info['tongsotiet'] . '</td>
       <td  style="width: 50%;"><b>Tên môn:</b> ' . $info['tenMH'] . '</td>
       
     </tr>';
        $html .= '</table>';


        // Data table header
        $html .= '<table border="1" style="width: 80%; border-collapse: collapse; font-family: Times New Roman; text-align: center; table-layout: fixed;">';
        $html .= '<thead>
            <tr>
                <th style="width: 15%;">Ngày</th>
                <th style="width: 10%;">Phòng</th>
                <th style="width: 6%;">Buổi</th>
                <th style="width: 10%;">Số tiết LT</th>
                <th style="width: 10%;">Số tiết TH</th>
                <th style="width: 25%;">Tóm tắt nội dung</th>
                <th style="width: 30%;">Tên SV vắng</th>
                <th style="width: 15%;">Xác nhận GV</th>
                <th style="width: 30%;">Ký xác nhận SV</th>
            </tr>
          </thead>';

        $html .= '<tbody>';

        // Data table body
        foreach ($data['chi_tiet_so_len_lop'] as $item) {
            $html .= '<tr>';
            $html .= '<td>' . date('d/m/Y', strtotime($item->ngaylenlop)) . '</td>';
            $html .= '<td>' . $item->phonghoc . '</td>';
            $html .= '<td>' . $item->buoi . '</td>';
            $html .= '<td>' . $item->sotietlt . '</td>';
            $html .= '<td>' . $item->sotietth . '</td>';
            $html .= '<td>' . $item->tomtatnoidung . '</td>';
            $html .= '<td>' . nl2br(htmlspecialchars($item->tenSV_vang)) . '</td>';
            // Get the maCT for the current item
            $maCT = $item->maCT;


            $image_paths = $this->ctsllModel->get_image_paths($maCT);
            $imagesHtml = '';

            if (!empty($image_paths)) {
                foreach ($image_paths as $image_path) {
                    $full_image_path = 'uploads/' . $image_path; // Đường dẫn đầy đủ
                    // Kiểm tra xem đường dẫn có phải là URL ảnh hợp lệ không
                    if (file_exists($full_image_path) && !preg_match('/Đã xác nhận/', $image_path)) {
                        $imagesHtml .= '<img src="' . $full_image_path . '" style="width: 50px; height: 50px;"/><br>'; // Thêm ảnh
                    }
                }
            }

            // Nếu không có ảnh hợp lệ nào, hiển thị thông điệp "Chưa xác nhận"
            if (empty($imagesHtml)) {
                $imagesHtml = 'Chưa xác nhận';
            }

            $html .= '<td>' . $imagesHtml . '</td>'; // Add images or message in the last column
            $html .= '<td>' . $item->xacnhansv . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<br>';


        // Write HTML to PDF
        $mpdf->WriteHTML($html);

        // Output PDF
        $filename = 'attendance_' . $info['maHK'] . '_' . $info['namhoc'] . '.pdf';
        $mpdf->Output($filename, 'D');
    }


    public function export($maPC)
    {
        // Tải model
        $this->load->model('ctsllModel');

        // Lấy dữ liệu
        $data['chi_tiet_so_len_lop'] = $this->ctsllModel->get_all_solenlop($maPC);
        $info = $this->ctsllModel->getPhanCongById($maPC);

        // Tạo Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Đặt font cho toàn bộ file
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        // Thêm tiêu đề cho bảng
        $sheet->setCellValue('A1', 'BẢNG TÓM TÁT NỘI DUNG GIẢNG DẠY HỌC KỲ: ' . $info['maHK'] . ' - NĂM HỌC: ' . $info['namhoc']);
        $sheet->mergeCells('A1:I1'); // Gộp ô cho tiêu đề
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A:I')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A:I')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Đặt chiều cao cho hàng tiêu đề
        $sheet->getRowDimension(1)->setRowHeight(20);

        // Đặt tiêu đề cho thông tin giảng viên và môn học
        $sheet->setCellValue('A2', 'Mã giảng viên: ' . $info['maGV'])
            ->setCellValue('B2', 'Tên giảng viên: ' . $info['tenGV'])
            ->setCellValue('C2', 'Mã môn: ' . $info['maMH'])
            ->setCellValue('D2', 'Tên môn: ' . $info['tenMH'])
            ->setCellValue('E2', 'Mã lớp: ' . $info['tenlopmonhoc']);
        // Định dạng in đậm cho các ô chứa thông tin giảng viên và môn học
        $sheet->getStyle('A2:E2')->getFont()->setBold(true);
        // Đặt tiêu đề cho bảng
        $sheet->setCellValue('A3', 'Ngày')
            ->setCellValue('B3', 'Phòng')
            ->setCellValue('C3', 'Buổi')
            ->setCellValue('D3', 'Số tiết LT')
            ->setCellValue('E3', 'Số tiết TH')
            ->setCellValue('F3', 'Tóm tắt nội dung')
            ->setCellValue('G3', 'Tên SV vắng')
            ->setCellValue('H3', 'Xác nhận GV')
            ->setCellValue('I3', 'Xác nhận SV');

        // Định dạng tiêu đề cột
        $sheet->getStyle('A3:I3')->getFont()->setBold(true);
        $sheet->getStyle('A3:I3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:I3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Điền dữ liệu vào bảng
        $row = 4; // Bắt đầu từ hàng thứ 4
        foreach ($data['chi_tiet_so_len_lop'] as $item) {
            $sheet->setCellValue('A' . $row, date('d/m/Y', strtotime($item->ngaylenlop)))
                ->setCellValue('B' . $row, $item->phonghoc)
                ->setCellValue('C' . $row, $item->buoi)
                ->setCellValue('D' . $row, $item->sotietlt)
                ->setCellValue('E' . $row, $item->sotietth)
                ->setCellValue('F' . $row, $item->tomtatnoidung)
                ->setCellValue('G' . $row, $item->tenSV_vang)
                ->setCellValue('H' . $row, $item->xacnhangv)
                ->setCellValue('I' . $row, $item->xacnhansv);
            $row++;
        }

        // Tự động điều chỉnh độ rộng của các cột
        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        // Đặt tiêu đề file
        $filename = 'attendance_' . $info['maHK'] . '_' . $info['namhoc'] . '.xlsx';

        // Xuất file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
    public function index($maPC)
    {
        $username = $this->session->userdata('username');
        $data['info'] = $this->ctsllModel->getPhanCongById($maPC);

        $data['chi_tiet_so_len_lop'] = $this->ctsllModel->get_all_solenlop($maPC);

        // Tính tổng số tiết và buổi
        $totals = $this->ctsllModel->calculate_totals($maPC);
        $data['totals'] = $totals; // Thêm tổng vào dữ liệu truyền vào view

        // Load the view and pass the data
        $this->load->view('giangvien/header', ['username' => $username]);
        $this->load->view('giangvien/chitietsll', $data);
        $this->load->view('giangvien/footer');
    }

    public function add($maPC)
    {
        // Lưu mã phân công vào biến để truyền qua view
        $data['maPC'] = $maPC;
        $username = $this->session->userdata('username');
    
        if ($this->input->post()) {
            // Lấy dữ liệu từ form
            $ngaylenlop = $this->input->post('date');
            $buoi = $this->input->post('buoi');
            $phonghoc = $this->input->post('phonghoc');
            $sotietlt = $this->input->post('sotietlt');
            $sotietth = $this->input->post('sotietth');
            $tomtatnoidung = $this->input->post('tomtatnoidung');
    
            // Xử lý upload file
            $config['upload_path'] = './uploads/'; // Đường dẫn thư mục lưu trữ
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Các loại file được phép
            $config['max_size'] = 2048; // Kích thước tối đa (2MB)
    
            $this->load->library('upload', $config);
    
            // Kiểm tra xem có file nào được upload không
            if (!empty($_FILES['xacnhangv']['name'])) {
                if ($this->upload->do_upload('xacnhangv')) {
                    // Nếu upload thành công
                    $upload_data = $this->upload->data();
                    $xacnhangv = base_url('uploads/' . $upload_data['file_name']);
                } else {
                    // Nếu upload không thành công, hiển thị thông báo lỗi
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    $data['error'] = $this->session->flashdata('error');
                    $this->load->view('giangvien/header_add', ['username' => $username]);
                    $this->load->view('giangvien/create', $data);
                    $this->load->view('giangvien/footer');
                    return; // Dừng thực hiện hàm
                }
            } else {
                // Nếu không upload file, gán giá trị mặc định cho $xacnhangv
                $xacnhangv = null; // Hoặc có thể gán một giá trị mặc định khác nếu cần
            }
    
            // Kiểm tra xem bản ghi đã tồn tại hay chưa
            $chiTiet = $this->ctsllModel->getChiTietByMaPCNgayBuoi($maPC, $ngaylenlop, $buoi);
            if ($chiTiet) {
                // Nếu đã tồn tại, hiển thị thông báo lỗi
                $this->session->set_flashdata('error', 'Đã tồn tại bản ghi với mã phân công, ngày lên lớp và buổi này');
                $data['error'] = $this->session->flashdata('error');
                $this->load->view('giangvien/header_add', ['username' => $username]);
                $this->load->view('giangvien/create', $data);
                $this->load->view('giangvien/footer');
            } else {
                // Nếu chưa tồn tại, thêm mới bản ghi
                $data = array(
                    'maPC' => $maPC, // Sử dụng $maPC từ tham số
                    'ngaylenlop' => $ngaylenlop,
                    'buoi' => $buoi,
                    'phonghoc' => $phonghoc,
                    'sotietlt' => $sotietlt,
                    'sotietth' => $sotietth,
                    'tomtatnoidung' => $tomtatnoidung,
                    'xacnhangv' => $xacnhangv, // Lưu URL hình ảnh hoặc null nếu không có
                );
                $this->ctsllModel->addChiTietSoLenLop($data);
                $this->session->set_flashdata('success', 'Thêm chi tiết sổ lên lớp thành công');
                redirect(base_url('ctsll' . $maPC));
            }
        } else {
            // Nếu không có dữ liệu POST, tải view form
            $this->load->view('giangvien/header_add', ['username' => $username]);
            $this->load->view('giangvien/create', $data);
            $this->load->view('giangvien/footer');
        }
    }




    public function xoa_ctsll($maCT, $maPC)
    {
        // Gọi phương thức xóa trong model
        if ($this->ctsllModel->deleteChiTietSoLenLop($maCT)) {
            // Nếu xóa thành công, chuyển hướng về trang danh sách
            $this->session->set_flashdata('success', 'Xóa thành công!');
        } else {
            // Nếu có lỗi xảy ra, có thể thông báo lỗi
            $this->session->set_flashdata('error', 'Có lỗi xảy ra khi xóa!');
        }

        // Chuyển hướng về trang danh sách với tham số maPC
        redirect(base_url('ctsll' . $maPC));
    }

    public function edit($maCT)
    {
        $username = $this->session->userdata('username');
        $data['chi_tiet_so_len_lop'] = $this->ctsllModel->getChiTietById($maCT);

        if ($this->input->post()) {
            // Collect data from the form
            $updateData = array(
                'ngaylenlop' => $this->input->post('date'),
                'buoi' => $this->input->post('buoi'),
                'phonghoc' => $this->input->post('phonghoc'),
                'sotietlt' => $this->input->post('sotietlt'),
                'sotietth' => $this->input->post('sotietth'),
                'tomtatnoidung' => $this->input->post('tomtatnoidung'),
                'tenSV_vang' => $this->input->post('tenSV_vang'),
            );

            $maPC = $this->input->post('maPC'); // Lấy giá trị từ POST

            // Lấy URL ảnh cũ từ cơ sở dữ liệu
            $old_image = $data['chi_tiet_so_len_lop']['xacnhangv'];

            // Xử lý upload ảnh xác nhận giáo viên
            if (!empty($_FILES['xacnhangv']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048;
                $config['file_name'] = uniqid() . '_' . $_FILES['xacnhangv']['name'];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('xacnhangv')) {
                    // Xóa ảnh cũ nếu có
                    if (!empty($old_image) && file_exists('./uploads/' . $old_image)) {
                        unlink('./uploads/' . $old_image);
                    }
                    // Lưu URL ảnh mới vào cơ sở dữ liệu
                    $upload_data = $this->upload->data();
                    $updateData['xacnhangv'] = $upload_data['file_name'];
                } else {
                    // Thông báo lỗi upload ảnh
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url('ctsll/edit' . $maCT));
                    return;
                }
            } else {
                // Giữ nguyên URL ảnh cũ nếu không có ảnh mới được upload
                $updateData['xacnhangv'] = $old_image;
            }

            // Update the record
            $this->ctsllModel->updateChiTietSoLenLop($maCT, $updateData);
            $this->session->set_flashdata('success', 'Cập nhật chi tiết sổ lên lớp thành công');
            redirect(base_url('ctsll' . $maPC));
        } else {
            // Load the edit form view with existing data
            $this->load->view('giangvien/header_add', ['username' => $username]);
            $this->load->view('giangvien/edit', $data);
            $this->load->view('giangvien/footer');
        }
    }


    public function index_sv($maCT)
    {
        $data['maCT'] = $maCT;
        $data['maPC'] = $this->ctsllModel->getMaPCByMaCT($maCT);
        $username = $this->session->userdata('username');
        $limit = 8;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;


        // Fetch group of subjects
        $data['nhommonhoc'] = $this->ctsllModel->getAllNhomMonHoc();

        // Get total rows of students based on maCT
        $total_rows = $this->ctsllModel->getTotalRowsSinhVien($maCT);

        // Get student list based on maCT
        $data['sinh_vien'] = $this->ctsllModel->getAllSinhVien($limit, $offset, $maCT);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);

        $this->load->view('giangvien/header', ['username' => $username]);
        $this->load->view('giangvien/diemdanh', $data);
        $this->load->view('giangvien/footer');
    }

    public function search_dd($maCT)
    {
        $data['maPC'] = $this->ctsllModel->getMaPCByMaCT($maCT);
        $data['maCT'] = $maCT;
        $username = $this->session->userdata('username');
        $keyword = $this->input->get('keyword');
        $toTH = $this->input->get('to_th'); // Get the practical group
        $limit = 8;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy tổng số sinh viên tìm kiếm
        $total_rows = $this->ctsllModel->getTotalRowsSearchSinhVien($keyword, $toTH);
        $data['sinh_vien'] = $this->ctsllModel->searchSinhVien($keyword, $toTH, $limit, $offset);
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($total_rows / $limit);
        $data['keyword'] = $keyword;
        $data['toTH'] = $toTH; // Pass the practical group to the view

        if (empty($data['sinh_vien'])) {
            $data['message'] = 'Không có kết quả tìm kiếm';
        }

        $this->load->view('giangvien/header', ['username' => $username]);
        $this->load->view('giangvien/diemdanh', $data);
        $this->load->view('giangvien/footer');
    }

    public function save()
    {
        if ($this->input->post()) {
            $maCT = $this->input->post('maCT');
            $maPC = $this->ctsllModel->getMaPCByMaCT($maCT);
            $absentStudents = $this->input->post('vang');

            if ($absentStudents) {
                // No need to implode here since the format is already correct
                $absentList = implode("\r\n", $absentStudents);
                $data = [
                    'maCT' => $maCT,
                    'tenSV_vang' => $absentList
                ];

                $this->ctsllModel->saveAbsentees($maCT, $data);
                redirect(base_url('ctsll' . $maPC));
            } else {
                // Handle the case where no students were selected
                $this->session->set_flashdata('error', 'No students were marked as absent.');
                redirect(base_url('diemdanh' . $maCT));
            }
        }
    }




    public function index_tttk()
    {
        $username = $this->session->userdata('username');


        // Lấy tổng số giảng viên từ model
        $data['giang_vien'] = $this->ctsllModel->getAllGiangVien();

        $this->load->view('giangvien/header', ['username' => $username]);
        $this->load->view('giangvien/thongtingv', $data);
        $this->load->view('giangvien/footer');
    }



   


}