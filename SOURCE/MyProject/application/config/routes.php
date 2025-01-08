<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'IndexController';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['lichdaygv'] = 'LichDayController/index';

$route['home'] = 'IndexController/index';
$route['dangxuat'] = 'LoginController/logout';
$route['login'] = 'LoginController/index';
$route['dangnhap'] = 'LoginController/login';

//doi mat khẩu
$router['doimatkhau'] = 'Doimatkhau/index';

$router['Doi_pass'] = 'Doimatkhau/change_password';






$route['Phancong/import_excel'] = 'Phancong/import_excel';

$route['timkiem'] = 'PhanCong/search';  // Ensure search route exists
$route['PhanCong'] = 'PhanCong/index';  // Ensure default controller


$route['quanlyphancong'] = 'PhanCong/index';  // Route cho Quản lý môn học
$route['phantrangkh'] = 'PhanCong/index/$1'; // Phân trang kế hoạch giảng dạy
$route['loc_hk'] = 'PhanCong/filterByHocKy'; // Phân trang kế hoạch giảng dạy


$route['them_monhoc'] = 'MonHocController/add'; // Route cho giao diện Thêm sản phẩm
$route['save_monhoc'] = 'MonHocController/add';
$route['quanlymonhoc'] = 'MonHocController/index_monhoc';  // Route cho Quản lý môn học
$route['phantrang'] = 'MonHocController/index_monhoc/$1'; // Phân trang
$route['sua_monhoc(:num)'] = 'MonHocController/edit/$1';// Route cho giao diện sua sản phẩm
$route['save_update(:num)'] = 'MonHocController/edit/$1';

$route['search_monhoc'] = 'MonHocController/search';
$route['phantrang'] = 'MonHocController/search/$1';
$route['xoa_monhoc/(:num)'] = 'MonHocController/delete/$1';

$route['quanlygiangvien'] = 'GiangVienController/index_giangvien';  // Route cho Quản lý môn học
$route['phantrang_gv'] = 'GiangVienController/index_giangvien/$1'; // Phân trang
$route['them_gv'] = 'GiangVienController/add'; // Route cho giao diện Thêm gv
$route['save_gv'] = 'GiangVienController/add';

$route['sua_giangvien(:any)'] = 'GiangVienController/edit/$1';  // any: lấy tất cả giá trị; num:số
$route['save_update_gv(:any)'] = 'GiangVienController/edit/$1';

$route['xoa_giangvien/(:any)'] = 'GiangVienController/delete/$1'; // xóa giảng viên
$route['search_giangvien'] = 'GiangVienController/search'; //search tên giảng viên


$route['quanlynhommonhoc'] = 'NhomMonHocController/index_nhommonhoc';  // Route for managing subject groups
$route['phantrang_nhommonhoc'] = 'NhomMonHocController/index_nhommonhoc/$1'; // Pagination for subject groups
$route['them_nhommonhoc'] = 'NhomMonHocController/add'; // Route for adding a new subject group
$route['save_nhommonhoc'] = 'NhomMonHocController/add'; // Route for saving a new subject group


$route['xoa_nhommonhoc/(:any)/(:any)'] = 'NhomMonHocController/delete/$1/$2'; // Delete subject group
$route['search_nhommonhoc'] = 'NhomMonHocController/search'; // Search subject groups


$route['quanlyhocky'] = 'HocKyController/index_hocky';  // Route for managing semesters
$route['phantrang_hk'] = 'HocKyController/index_hocky/$1'; // Pagination
$route['them_hk'] = 'HocKyController/add'; // Route for adding a new semester
$route['save_hk'] = 'HocKyController/add'; // Route for saving a new semester

$route['sua_hocky(:any)'] = 'HocKyController/edit/$1';  // Edit semester
$route['save_update_hk/(:any)'] = 'HocKyController/edit/$1'; // Save updated semester

$route['xoa_hocky/(:any)'] = 'HocKyController/delete/$1'; // Delete semester
$route['search_hocky'] = 'HocKyController/search'; // Search semesters


$route['quanlysinhvien'] = 'qlsvController/index_sv';  // Route for managing semesters
$route['sinhvien/import_excel'] = 'qlsvController/upload_excel';
$route['search_sinhvien'] = 'qlsvController/search'; // Search subject groups
$route['phantrang_sv'] = 'qlsvController/index_sv/$1'; // Phân trang






$route['Solenlop(:num)'] = 'SolenlopController/index/$1';

$route['sua_nhommonhoc(:any)/(:any)'] = 'NhomMonHocController/edit/$1/$2';// Route cho giao diện sửa nhóm môn học
$route['save_nmh/(:num)/(:num)'] = 'NhomMonHocController/edit/$1/$2'; // Route cho lưu cập nhật nhóm môn học

$route['quanlytaikhoan'] = 'TaiKhoanController/index';  // Route for managing semesters
$route['phantrang_tk'] = 'TaiKhoanController/index/$1'; // Pagination
$route['search_tk'] = 'TaiKhoanController/search'; 
$route['them_taikhoan'] = 'TaiKhoanController/them_taikhoan'; // Route for adding a new semester
$route['save_taikhoan'] = 'TaiKhoanController/them_taikhoan'; 

$route['sua_taikhoan(:any)'] = 'TaiKhoanController/sua_taikhoan/$1';
$route['save_update_tk/(:any)'] = 'TaiKhoanController/sua_taikhoan/$1';
$route['xoa_taikhoan/(:any)'] = 'TaiKhoanController/xoa_taikhoan/$1';




// đơn vi
$route['quanlydonvi'] = 'DonViController/index_donvi';  // Route cho Quản lý đơn vị
$route['phantrang_dv'] = 'DonViController/index_donvi/$1'; // Phân trang
$route['them_donvi'] = 'DonViController/add'; // Route cho giao diện Thêm đơn vị
$route['save_dv'] = 'DonViController/add';

$route['sua_donvi(:any)'] = 'DonViController/edit/$1';  // any: lấy tất cả giá trị; num:số
$route['save_update_dv(:any)'] = 'DonViController/edit/$1';

$route['xoa_donvi/(:any)'] = 'DonViController/delete/$1'; // Xóa đơn vị
$route['search_dv'] = 'DonViController/search'; // Tìm kiếm đơn vị

///////////////////Giảng viên//////////////////////////////
$route['lichdaygv'] = 'LichDayController/index';
$route['timkiem_ld'] = 'LichDayController/search';
$route['phantrang_ld'] = 'LichDayController/index/$1'; // Phân trang kế hoạch giảng dạy
$route['ctsll(:num)'] = 'ctsllController/index/$1';
$route['them_ctsll(:num)'] = 'ctsllController/add/$1'; // Route for adding a new semester
$route['save_ctsll(:num)'] = 'ctsllController/add/$1'; 
$route['xoa_ctsll(:any)/(:any)'] = 'ctsllController/xoa_ctsll/$1/$2';

$route['sua_ctsll(:num)'] = 'ctsllController/edit/$1'; // Route for adding a new semester
$route['save_update_ctsll(:num)'] = 'ctsllController/edit/$1'; 
$route['diemdanh(:num)'] = 'ctsllController/index_sv/$1'; 
$route['search_dd(:num)'] = 'ctsllController/search_dd/$1'; // Search subject groups

$route['export_excel/(:num)'] = 'ctsllController/export/$1';

//Thông tin tài khoản
$route['thongtintk'] = 'ctsllController/index_tttk';

$route['quanlysinhvien_gv'] = 'SinhVienController/index_sv';  // Route for managing semesters
$route['search_sv_gv'] = 'SinhVienController/search'; // Search subject groups
$route['phantrang_sv_gv'] = 'SinhVienController/index_sv/$1'; // Phân trang
$route['phantrang_sv_gv/search_sv'] = 'SinhVienController/search/$1';
$route['sinhvien/import_excel'] = 'SinhVienController/upload_excel';



///////SINH VIÊN//////////////////////////////////
$route['xacnhansv'] = 'xacnhansvController/index';
$route['pt_sv'] = 'xacnhansvController/index/$1'; // Phân trang kế hoạch giảng dạy
$route['tttk_sv'] = 'xacnhansvController/tttk_sv';
$route['search_xnsv'] = 'xacnhansvController/search'; // Search subject groups
$route['xacnhan_ctsll(:num)'] = 'xacnhansvController/ctsll/$1';
$route['updatexacnhan(:num)'] = 'xacnhansvController/update/$1';

///THỐNG KÊ///
$route['thongke'] = 'thongkeController/thongke_so_tiet';
$route['thongkeadmin'] = 'thongkeController/thongke_admin';
$route['pt_thongke'] = 'thongkeController/thongke_admin';