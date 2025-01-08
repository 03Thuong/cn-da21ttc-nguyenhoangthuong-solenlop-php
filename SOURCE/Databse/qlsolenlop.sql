-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 08, 2025 lúc 02:38 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlsolenlop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_so_len_lop`
--

CREATE TABLE `chi_tiet_so_len_lop` (
  `maCT` int(11) NOT NULL,
  `maPC` int(11) NOT NULL,
  `ngaylenlop` date NOT NULL,
  `buoi` enum('Sáng','Chiều','Tối') NOT NULL,
  `phonghoc` varchar(10) NOT NULL,
  `sotietlt` int(11) NOT NULL,
  `sotietth` int(11) NOT NULL,
  `tomtatnoidung` varchar(100) NOT NULL,
  `xacnhangv` varchar(255) DEFAULT NULL,
  `xacnhansv` varchar(255) DEFAULT NULL,
  `tenSV_vang` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_so_len_lop`
--

INSERT INTO `chi_tiet_so_len_lop` (`maCT`, `maPC`, `ngaylenlop`, `buoi`, `phonghoc`, `sotietlt`, `sotietth`, `tomtatnoidung`, `xacnhangv`, `xacnhansv`, `tenSV_vang`) VALUES
(2, 537, '2024-12-20', 'Sáng', 'D7', 4, 0, 'Giới thiệu', 'Đã xác nhận', '110421194-Dương Hoàng Mai Anh', '110421004-Nguyễn Khắc Tiểu Bình\r\n110421005-Trương Bảo Châu\r\n110421015-Nguyễn Thị Thảo Duy\r\n110421017-Nguyễn Thị Mỹ Duyên'),
(4, 537, '2024-12-05', 'Chiều', 'D7', 4, 0, '123', '676ac1624f3e9_giangvien_drawio.png', '110421004-Nguyễn Khắc Tiểu Bình', ''),
(8, 530, '2024-12-04', 'Chiều', 'D7', 4, 1, 'Chương 1111', '676b7ba01ebb2_giangvien_drawio.png', '110421194-Dương Hoàng Mai Anh', '110421015-Nguyễn Thị Thảo Duy\r\n110421017-Nguyễn Thị Mỹ Duyên\r\n110421018-Trần Thị Huỳnh Giao'),
(9, 537, '2024-12-24', 'Sáng', 'D31.302', 0, 4, 'Ngôn ngữ HTML(tt)', '676ac29a6d27d_CHUKY-removebg-preview.png', 'Chưa xác nhận', ''),
(11, 537, '2024-12-25', 'Sáng', 'D31.302', 0, 4, 'Ngôn ngữ HTML', '6771655b94fe7_CHUKY-removebg-preview.png', '', '110421004-Nguyễn Khắc Tiểu Bình\r\n110421005-Trương Bảo Châu\r\n110421015-Nguyễn Thị Thảo Duy\r\n110421017-Nguyễn Thị Mỹ Duyên'),
(12, 538, '2024-12-30', 'Sáng', 'D31.302', 2, 2, 'Giới thiệu HTML', '6772a0d63e44f_CHUKY-removebg-preview.png', NULL, '110421004-Nguyễn Khắc Tiểu Bình'),
(15, 539, '2024-12-31', 'Sáng', 'D7', 12, 12, '123', NULL, NULL, NULL),
(16, 533, '2024-12-31', 'Sáng', 'D7', 12, 12, '123', NULL, NULL, NULL),
(17, 568, '2024-09-04', 'Sáng', 'D71.111', 2, 2, 'Tổng quan về thiết kế web và phân loại website', 'http://localhost:8088/uploads/CHUKY-removebg-preview2.png', '110123163-Nguyễn Kiến Quốc', '110120006-Đặng Kim Bắc'),
(18, 568, '2024-09-11', 'Sáng', 'D71.111', 0, 4, 'Ngôn ngữ HTML', 'http://localhost:8088/uploads/CHUKY-removebg-preview3.png', '110123163-Nguyễn Kiến Quốc', NULL),
(19, 568, '2024-09-18', 'Sáng', 'D71.111', 2, 2, 'Ngôn ngữ HTML(tt)', NULL, '110123163-Nguyễn Kiến Quốc', NULL),
(20, 568, '2024-09-25', 'Sáng', 'D71.111', 2, 2, 'Bảng định kiểu CSS', NULL, '110123163-Nguyễn Kiến Quốc', NULL),
(21, 568, '2024-10-02', 'Sáng', 'D71.111', 0, 4, 'Bảng định kiểu CSS(tt)', NULL, '110123163-Nguyễn Kiến Quốc', NULL),
(22, 568, '2024-10-09', 'Chiều', 'D71.111', 3, 1, 'Bootstrap framework', NULL, NULL, ''),
(23, 568, '2024-10-16', 'Chiều', 'D71.111', 0, 4, 'Bootstrap framework(tt)', NULL, NULL, NULL),
(24, 568, '2024-10-23', 'Chiều', 'D71.111', 1, 3, 'Giới thiệu website buiders', NULL, NULL, NULL),
(25, 568, '2024-10-30', 'Chiều', 'D71.111', 3, 1, 'Thiết kế website với Google site', NULL, NULL, NULL),
(26, 568, '2024-11-06', 'Chiều', 'D71.111', 1, 3, 'Thiết kế web với Wix', NULL, NULL, NULL),
(27, 568, '2024-11-13', 'Chiều', 'D71.111', 0, 4, 'Thiết kế web với Weebly', NULL, NULL, NULL),
(28, 568, '2024-11-20', 'Chiều', 'D71.111', 1, 0, 'Ôn tập trắc nghiệm', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_vi`
--

CREATE TABLE `don_vi` (
  `madv` int(11) NOT NULL,
  `tendonvi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `don_vi`
--

INSERT INTO `don_vi` (`madv`, `tendonvi`) VALUES
(39, 'Trường Kinh tế, Luật     '),
(111, 'Bộ môn Cơ khí - Động lực     '),
(112, 'Khoa Kỹ thuật và Công nghệ     '),
(113, 'Bộ môn Xây dựng     '),
(114, 'Bộ môn Công nghệ Thông tin     '),
(115, 'Văn phòng khoa KT&CN     '),
(116, 'Bộ môn Điện - Điện tử     '),
(118, 'Lãnh đạo khoa KT&CN     ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giang_vien`
--

CREATE TABLE `giang_vien` (
  `maGV` varchar(10) NOT NULL,
  `tenGV` varchar(100) DEFAULT NULL,
  `matk` int(11) DEFAULT NULL,
  `madv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giang_vien`
--

INSERT INTO `giang_vien` (`maGV`, `tenGV`, `matk`, `madv`) VALUES
('00053', 'Thạch Kọng Saoane', 4661, 114),
('00236', 'Hồ Ngọc Hà', 4662, 115),
('00237', 'Dương Thị Chiểu', 4663, 115),
('00238', 'Nguyễn Đức Hiệu', 4664, 116),
('00241', 'Nguyễn Hoàng Duy Thiện', 4665, 114),
('00242', 'Dương Ngọc Vân Khanh', 4667, 114),
('00243', 'Huỳnh Văn Thanh', 4669, 114),
('00244', 'Nguyễn Nhứt Lam', 4670, 114),
('00245', 'Nguyễn Bảo Ân', 4672, 114),
('00246', 'Nguyễn Ngọc Đan Thanh', 4673, 114),
('00248', 'Phạm Minh Đương', 4675, 114),
('00249', 'Hà Thị Thúy Vi', 4676, 114),
('00250', 'Võ Thành C', 4677, 114),
('00251', 'Trịnh Quốc Việt', 4678, 114),
('00252', 'Trầm Hoàng Nam', 4679, 114),
('00253', 'Đoàn Phước Miền', 4680, 114),
('00254', 'Ngô Thanh Huy', 4682, 114),
('00255', 'Phạm Thị Trúc Mai', 4683, 114),
('00257', 'Nguyễn Mộng Hiền', 4684, 114),
('00259', 'Trịnh Thị Anh Duyên', 4686, 115),
('00260', 'Đặng Hữu Phúc', 4687, 116),
('00261', 'Trần Song Toàn', 4688, 116),
('00262', 'Phạm Minh Triết', 4689, 116),
('00267', 'Phan Văn Tuân', 4690, 111),
('00268', 'Trương Văn Mến', 4691, 111),
('00269', 'Dương Minh Hùng', 4692, 111),
('00270', 'Huỳnh Thanh Bảnh', 4694, 111),
('00275', 'Nguyễn Thanh Tâm', 4696, 113),
('00277', 'Trần Thanh Vũ', 4697, 113),
('00278', 'Đoàn Công Chánh', 4698, 113),
('00279', 'Huỳnh Hữu Trí', 4699, 113),
('00280', 'Kỷ Minh Hưng', 4700, 113),
('00281', 'Trần Văn Khánh', 4702, 113),
('00283', 'Nguyễn Thành Công', 4703, 113),
('00284', 'Bùi Phước Hảo', 4704, 113),
('00285', 'Huỳnh Thị Mỹ Dung', 4705, 113),
('00346', 'Huỳnh Tấn Thành', 4706, 118),
('00574', 'Nguyễn Khắc Bằng', 4707, 111),
('00661', 'Ngô Gia Truyền', 4709, 113),
('00696', 'Lê Minh Hải', 4711, 116),
('00707', 'Nguyễn Phú Nhuận', 4712, 113),
('00823', 'Thạch Vũ Đình Vi', 4713, 113),
('01016', 'Cao Hữu Lợi', 4714, 113),
('02405', 'Nguyễn Thanh Hiền', 4715, 116),
('03539', 'Lê Minh Tự', 4716, 114),
('03546', 'Phan Thị Phương Nam', 4718, 114),
('03562', 'Nguyễn Khắc Quốc', 4720, 114),
('06742', 'Ngô Thanh Hà', 4721, 111),
('12661', 'Võ Phước Hưng', 4723, 118),
('12692', 'Đặng Hoàng Minh', 4725, 116),
('12694', 'Lê Thanh Tùng', 4727, 116),
('12695', 'Nguyễn Ngọc Tiền', 4728, 116),
('12696', 'Thạch Thị Via Sana', 4729, 116),
('12702', 'Nguyễn Thừa Phát Tài', 4730, 114),
('12703', 'Nguyễn Hoàng Vũ', 4731, 116),
('12704', 'Kim Anh Tuấn', 4733, 116),
('12705', 'Nguyễn Trần Diễm Hạnh', 4734, 114),
('12707', 'Lê Thành Nam', 4736, 116),
('12710', 'Phan Tấn Tài', 4737, 111),
('12711', 'Nguyễn Vũ Lực', 4739, 111),
('14189', 'Phan Thế Hiếu', 4740, 116),
('14190', 'Phạm Tấn Hưng', 4741, 116),
('14191', 'Bùi Thị Thu Thủy', 4742, 116),
('14204', 'Nguyễn Bá Nhiệm', 4744, 114),
('14209', 'Triệu Quốc Huy', 4746, 116),
('14219', 'Phạm Quốc Phong', 4747, 118),
('14221', 'Trần Văn Điền', 4748, 118),
('14230', 'Cao Phương Thảo', 4749, 116),
('14238', 'Huỳnh Văn Hiệp', 4751, 113),
('14259', 'Thạch Ngọc Phúc', 4753, 111),
('16350', 'Từ Hồng Nhung', 4755, 113),
('CH247', 'Vương Hải Khoa', 4756, 113),
('CK07', 'Đặng Duy Khiêm', 4656, 111),
('CK14', 'Nguyễn Đức Tuệ', 4657, 111),
('CK16', 'Nguyễn Thành Bắc', 4658, 111),
('QT87', 'Trần Trường Giang', 1406, 39),
('TC10', 'Lê Tấn Phước', 1407, 39),
('TT21', 'Huỳnh Thế Xuân', 4659, 112),
('XD45', 'Chu Việt Cường', 4660, 113);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoc_ky`
--

CREATE TABLE `hoc_ky` (
  `maHK` varchar(10) NOT NULL,
  `tenHK` varchar(10) DEFAULT NULL,
  `namhoc` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoc_ky`
--

INSERT INTO `hoc_ky` (`maHK`, `tenHK`, `namhoc`) VALUES
('HK01', 'Học kỳ 1', '2024-2025'),
('HK02', 'Học Kỳ 2', '2024-2025');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `maMH` int(11) NOT NULL,
  `tenMH` varchar(100) DEFAULT NULL,
  `tongsotiet` int(11) DEFAULT NULL,
  `SoTC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mon_hoc`
--

INSERT INTO `mon_hoc` (`maMH`, `tenMH`, `tongsotiet`, `SoTC`) VALUES
(110003, 'Toán rời rạc    ', 45, 2),
(150003, 'Kỹ năng mềm - Xây dựng Hồ sơ năng lực điện tử    ', 15, 1),
(150004, 'Kỹ năng mềm - Đàm phán    ', 15, 1),
(150008, 'Kỹ năng mềm - Làm việc nhóm    ', 15, 1),
(150013, 'Kỹ năng mềm - Tìm kiếm thông tin và đọc hiểu tài liệu    ', 15, 1),
(150016, 'Kỹ năng mềm - Bảo vệ môi trường    ', 30, 2),
(150018, 'Kỹ năng mềm – Khởi nghiệp    ', 15, 1),
(210005, 'Thực hành nguội    ', 60, 2),
(210023, 'Công nghệ khí nén - Thuỷ lực    ', 60, 3),
(210037, 'Thực hành ô tô    ', 120, 4),
(210038, 'Lý thuyết ô tô    ', 45, 3),
(210046, 'Thực Hành Nguội    ', 60, 2),
(210066, 'Hệ thống điện - điện tử ô tô    ', 60, 4),
(210068, 'Động cơ đốt trong    ', 60, 4),
(210087, 'Vật liệu cơ khí    ', 30, 2),
(210088, 'Dung sai kỹ thuật đo    ', 45, 2),
(210110, 'Công nghệ kim loại    ', 30, 2),
(210143, 'Quy hoạch thực nghiệm    ', 30, 2),
(210146, 'Kỹ thuật lập trình    ', 45, 2),
(210281, 'Anh văn chuyên ngành ô tô    ', 30, 2),
(210302, 'Cơ lý thuyết    ', 45, 2),
(210321, 'Thực hành cắt gọt 2    ', 120, 4),
(210344, 'Tổ chức quản lý sản xuất    ', 30, 2),
(210387, 'Trang bị điện và điện tử trong máy công nghiệp    ', 45, 2),
(210389, 'Thực hành hệ thống điều khiển động cơ    ', 90, 3),
(210392, 'Thực hành hệ thống điện thân xe và điều khiển ô tô    ', 90, 3),
(210398, 'Matlab ứng dụng    ', 75, 3),
(220018, 'Mạng máy tính    ', 60, 3),
(220055, 'Công nghệ phần mềm    ', 60, 3),
(220060, 'Hệ quản trị cơ sở dữ liệu    ', 60, 3),
(220071, 'Lập trình thiết bị di động    ', 60, 3),
(220101, 'Hệ điều hành    ', 60, 3),
(220126, 'An toàn và bảo mật thông tin    ', 60, 3),
(220220, 'Tin học ứng dụng cơ bản    ', 75, 3),
(220232, 'Hệ thống thông tin quản lý    ', 60, 3),
(220234, 'Cấu trúc dữ liệu và giải thuật    ', 90, 4),
(220236, 'Thiết kế Web    ', 60, 3),
(220237, 'Lý thuyết xếp hàng    ', 45, 2),
(220242, 'Cơ sở trí tuệ nhân tạo    ', 60, 3),
(220248, 'Máy học ứng dụng    ', 60, 3),
(220249, 'Thị giác máy tính    ', 90, 4),
(220250, 'Anh văn chuyên ngành công nghệ thông tin    ', 60, 3),
(220269, 'Khai phá dữ liệu    ', 60, 3),
(230014, 'Kỹ thuật số    ', 30, 2),
(230114, 'Thực hành Kỹ thuật số    ', 60, 2),
(230116, 'Anh văn chuyên ngành (TĐH)    ', 45, 2),
(230119, 'Nguyên lý chi tiết máy    ', 45, 2),
(230127, 'Hệ thống điều khiển số    ', 30, 2),
(230140, 'Điều khiển tự động    ', 30, 2),
(230145, 'Thiết kế hệ thống nhúng    ', 60, 2),
(230149, 'Mạng cảm biến không dây    ', 30, 2),
(240057, 'Thí nghiệm máy điện    ', 60, 2),
(240076, 'Quy hoạch phát triển hệ thống điện    ', 30, 2),
(240084, 'Ổn định trong hệ thống điện    ', 30, 2),
(240116, 'Mạch điện 2    ', 30, 2),
(240121, 'Thực hành vi điều khiển    ', 60, 2),
(240161, 'Thực hành trang bị điện - khí nén    ', 90, 3),
(240175, 'Trang bị điện    ', 30, 2),
(240178, 'Máy điện 1    ', 45, 3),
(240182, 'Anh văn chuyên ngành    ', 45, 2),
(240196, 'Thực hành điện dân dụng    ', 60, 2),
(240200, 'Vẽ kỹ thuật điện với CAD    ', 60, 2),
(240203, 'Thực hành quấn dây máy điện    ', 60, 2),
(240205, 'Matlab và ứng dụng    ', 60, 2),
(240207, 'Hệ thống SCADA    ', 30, 2),
(240208, 'Thiết kế chiếu sáng    ', 60, 2),
(240212, 'Thực hành hệ thống SCADA    ', 60, 2),
(240215, 'Kỹ thuật cảm biến    ', 60, 2),
(240216, 'Vi điều khiển    ', 30, 2),
(240217, 'Lập trình PLC cơ bản    ', 90, 3),
(260064, 'Trường điện từ    ', 30, 2),
(260065, 'Ngắn mạch trong hệ thống điện    ', 45, 3),
(280002, 'Vẽ kỹ thuật xây dựng 1    ', 45, 2),
(280011, 'An toàn lao động    ', 45, 2),
(280012, 'Vật liệu xây dựng    ', 30, 2),
(280016, 'Thí nghiệm vật liệu xây dựng    ', 30, 1),
(280017, 'Sức bền vật liệu 1    ', 45, 2),
(280018, 'Cấu tạo kiến trúc    ', 45, 2),
(280019, 'Cơ học đất    ', 45, 2),
(280021, 'Môi trường trong xây dựng    ', 30, 2),
(280023, 'Cấp thoát nước    ', 45, 2),
(280026, 'Nền móng công trình    ', 60, 3),
(280029, 'Đồ án nền móng công trình    ', 45, 1),
(280043, 'Đồ án kết cấu thép    ', 45, 1),
(280044, 'Nguyên lý thiết kế kiến trúc công trình dân dụng    ', 30, 2),
(280046, 'Đánh giá chất lượng và gia cố công trình    ', 30, 2),
(280061, 'Đồ án kiến trúc công trình    ', 45, 1),
(280062, 'Kết cấu bê tông cốt thép 2    ', 45, 2),
(280063, 'Đồ án Kết cấu bê tông CT 2    ', 45, 1),
(280089, 'Cơ học kết cấu 1    ', 45, 2),
(280095, 'Nhập môn kỹ sư xây dựng    ', 45, 2),
(280096, 'Dự toán công trình    ', 45, 2),
(280098, 'Tổ chức thi công    ', 30, 2),
(280104, 'Kiến trúc công trình    ', 45, 2),
(280106, 'Cơ lưu chất    ', 45, 2),
(280108, 'Anh văn chuyên ngành (XD)    ', 45, 2),
(280109, 'Thực hành trắc địa đại cương    ', 30, 1),
(280114, 'Cơ học kết cấu 2    ', 45, 2),
(280135, 'Bê tông dự ứng lực    ', 45, 2),
(280136, 'Thủy văn công trình    ', 45, 2),
(280139, 'Thiết kế đường ôtô    ', 45, 2),
(280141, 'Đồ án thiết kế đường ôtô    ', 45, 1),
(280144, 'Đồ án thiết kế Cầu bê tông cốt thép    ', 45, 1),
(280149, 'Quy hoạch giao thông    ', 45, 2),
(280152, 'Đồ án Thi công Cầu    ', 45, 1),
(280153, 'Đồ án Thi công Đường    ', 45, 1),
(280154, 'Thí nghiệm đường ôtô    ', 30, 1),
(280155, 'Máy xây dựng    ', 45, 2),
(280156, 'Vải địa kỹ thuật    ', 30, 2),
(280160, 'Thiết kế nút giao thông    ', 30, 2),
(280162, 'Khai thác công trình Cầu - Đường    ', 30, 2),
(280172, 'Đồ án tổ chức thi công    ', 45, 1),
(280173, 'Kết cấu thép 2    ', 45, 2),
(280174, 'Kết cấu bê tông cốt thép 3    ', 45, 2),
(280179, 'Mố trụ cầu    ', 45, 2),
(280180, 'Đồ án mố trụ cầu    ', 45, 1),
(280182, 'Quản lý dự án xây dựng    ', 45, 2),
(280183, 'Thi công cầu    ', 45, 2),
(280198, 'Kiểm định chất lượng công trình giao thông    ', 45, 2),
(280203, 'Địa chất công trình    ', 45, 2),
(280204, 'Luật xây dựng    ', 45, 2),
(280208, 'Kết cấu nhà cao tầng    ', 45, 2),
(280213, 'Trắc địa đại cương    ', 45, 2),
(280215, 'Thiết kế Cầu bê tông cốt thép    ', 60, 3),
(280216, 'Thi công đường    ', 45, 2),
(280220, 'Bệnh học công trình    ', 45, 2),
(280221, 'BIM và tin học ứng dụng trong quản lý xây dựng    ', 45, 2),
(280225, 'Khai thác - kiểm định công trình giao thông    ', 45, 2),
(290000, 'Phương pháp NC khoa học    ', 45, 2),
(320335, 'Tính chất lý hóa của vật liệu nano    ', 60, 3),
(340165, 'Cơ khí nông nghiệp    ', 45, 2),
(340208, 'Cảm biến và điều khiển ứng dụng trong nông nghiệp    ', 45, 2),
(410292, 'Anh văn không chuyên 2    ', 90, 4),
(410294, 'Anh văn không chuyên 4    ', 60, 3),
(410335, 'Foreign Language 2 – Basic 1- Korean (Ngoại ngữ 2 - Cơ bản 1 - tiếng Hàn)    ', 75, 3),
(410410, 'Advanced Public Speaking (Hùng biện nâng cao)    ', 45, 2),
(410418, 'Web Design (Thiết kế web cơ bản)    ', 45, 2),
(410439, 'Lí thuyết dịch    ', 45, 2),
(410441, 'Kĩ năng đọc viết 3    ', 60, 3),
(410465, 'Foreign Language 2 – Basic 3- Korean (Ngoại ngữ 2 - Cơ bản 3 - tiếng Hàn)    ', 45, 2),
(420000, 'Kỹ thuật XD & ban hành văn bản    ', 45, 2),
(420222, 'Kỹ thuật nhiếp ảnh và quay video    ', 45, 2),
(420280, 'Quản lý nhà nước về biển, hải đảo    ', 45, 2),
(460200, 'Hóa phân tích    ', 45, 2),
(460201, 'Nhiệt kỹ thuật    ', 45, 2),
(460258, 'Hệ thống tự động hóa    ', 45, 2),
(470004, 'Máy học cơ bản', 60, 3),
(470005, 'Máy học cơ bản', 60, 3),
(470006, 'Máy học cơ bản', 60, 3),
(470007, 'Máy học cơ bản', 60, 3),
(470008, 'Máy học cơ bản', 60, 3),
(470035, 'Hệ thống thông tin quản lý    ', 45, 2),
(470198, 'Marketing quốc tế    ', 45, 2),
(470351, 'Thực hành nghiệp vụ ngoại thương 2    ', 60, 2),
(470352, 'Nghiệp vụ hải quan    ', 45, 2),
(470378, 'Phân tích và thiết kế hệ thống thương mại điện tử    ', 60, 3),
(470400, 'Quản trị kênh phân phối    ', 45, 2),
(470452, 'Ngân hàng điện tử    ', 45, 2),
(470456, 'Kỹ năng excel ứng dụng nâng cao    ', 45, 2),
(620058, 'Ứng dụng CNTT trong GD mầm non    ', 30, 1),
(4700099, 'Máy học cơ bản', 60, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhommonhoc`
--

CREATE TABLE `nhommonhoc` (
  `manhom` int(11) NOT NULL,
  `maMH` int(11) NOT NULL,
  `tenlopmonhoc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhommonhoc`
--

INSERT INTO `nhommonhoc` (`manhom`, `maMH`, `tenlopmonhoc`) VALUES
(1, 110003, 'DA24TTA'),
(1, 210005, 'DA24CNOTA'),
(1, 210023, 'DA22CK'),
(1, 210037, 'DA23CNOTA'),
(1, 210038, 'DA23CNOTA'),
(1, 210046, 'DA24CK'),
(1, 210068, 'DA24CNOTA'),
(1, 210087, 'DA24CK'),
(1, 210088, 'DA24CK'),
(1, 210110, 'DA23CK'),
(1, 210143, 'DA23CK'),
(1, 210281, 'DA22CNOTA'),
(1, 210302, 'DA24CK'),
(1, 210321, 'DA23CK'),
(1, 210344, 'DA23CK'),
(1, 210387, 'DA21CKA'),
(1, 210392, 'DA22CNOTA'),
(1, 210398, 'DA22CNOTA'),
(1, 220018, 'DA23TTA'),
(1, 220055, 'DA22TTA, DA22TTB'),
(1, 220060, 'DA22TTA'),
(1, 220071, 'DA22TTA'),
(1, 220101, 'DA23TTA'),
(1, 220126, 'DA22TTA'),
(1, 220220, 'DA23YHDPA'),
(1, 220234, 'DA24TTA'),
(1, 220236, 'DA23TTA'),
(1, 220237, 'DA23TTA'),
(1, 220242, 'DA22TTA'),
(1, 220248, 'DA21TTA'),
(1, 220249, 'DA21TTA'),
(1, 220250, 'DA23TTA'),
(1, 220269, 'DA22TTA'),
(1, 230014, 'DA23DT'),
(1, 230114, 'DA23DT'),
(1, 230116, 'DA23DT'),
(1, 230119, 'DA23CK'),
(1, 230127, 'DA22DT'),
(1, 230140, 'DA23DT'),
(1, 230145, 'DA22DT'),
(1, 230149, 'DA22DT'),
(1, 240076, 'DA22KDHT'),
(1, 240084, 'DE23KD04'),
(1, 240116, 'DA24DT'),
(1, 240161, 'DA22DT'),
(1, 240175, 'DA22DCNA'),
(1, 240178, 'DA23DT'),
(1, 240182, 'DA23KDA'),
(1, 240196, 'DA24DT'),
(1, 240200, 'DA23DT'),
(1, 240205, 'DA23DT'),
(1, 240207, 'DA22DT'),
(1, 240212, 'DA22DT'),
(1, 240215, 'DA22DT'),
(1, 240216, 'DA22DCNA'),
(1, 260065, 'DA22KDHT'),
(1, 280002, 'DA24XD'),
(1, 280011, 'DA23XDGT'),
(1, 280012, 'DA24XD'),
(1, 280016, 'DA24XD'),
(1, 280017, 'DA24XD'),
(1, 280018, 'DA23XD'),
(1, 280019, 'DA23XDGT'),
(1, 280021, 'DA23XD'),
(1, 280026, 'DA22XD'),
(1, 280029, 'DA22XD'),
(1, 280043, 'DA21XD'),
(1, 280044, 'DA23XD'),
(1, 280046, 'DA22XD'),
(1, 280061, 'DA22XD'),
(1, 280062, 'DA22XD'),
(1, 280063, 'DA22XD'),
(1, 280089, 'DA24XD'),
(1, 280095, 'DA24XD, DA24XDGT'),
(1, 280096, 'DA21XD'),
(1, 280098, 'DA21XDGT'),
(1, 280104, 'DA22XD'),
(1, 280106, 'DA24XD'),
(1, 280108, 'DA23XDGT'),
(1, 280109, 'DA23XD'),
(1, 280114, 'DA23XDGT'),
(1, 280135, 'DA21XD'),
(1, 280136, 'DA23XDGT'),
(1, 280139, 'DA22XDGT'),
(1, 280141, 'DA22XDGT'),
(1, 280144, 'DA22XDGT'),
(1, 280149, 'DA21XDGT'),
(1, 280152, 'DA21XDGT'),
(1, 280153, 'DA21XDGT'),
(1, 280154, 'DA21XDGT'),
(1, 280155, 'DA22XDGT'),
(1, 280156, 'DA22XDGT'),
(1, 280160, 'DA22XDGT'),
(1, 280162, 'DA21XDGT'),
(1, 280172, 'DA21XDGT'),
(1, 280173, 'DA21XD'),
(1, 280174, 'DA21XD'),
(1, 280179, 'DA22XDGT'),
(1, 280180, 'DA22XDGT'),
(1, 280182, 'VB23XD04'),
(1, 280183, 'DA21XDGT'),
(1, 280198, 'DA21XDGT'),
(1, 280203, 'DA23XD'),
(1, 280204, 'DA22XD'),
(1, 280208, 'DA21XD'),
(1, 280213, 'DA23XD'),
(1, 280215, 'DA22XDGT'),
(1, 280216, 'DA21XDGT'),
(1, 280220, 'DA22XD'),
(1, 280221, 'DA21XD'),
(1, 280225, 'DA22XDGT'),
(1, 320335, 'DA22HH'),
(1, 340165, 'DA24NN'),
(1, 340208, 'DA23NN'),
(1, 410418, 'DA24NNAA'),
(1, 420000, 'DA22TTA'),
(1, 420222, 'DA22QDL'),
(1, 420280, 'DA22QLNN'),
(1, 460200, 'DA24XYHA'),
(1, 460201, 'DA24CK'),
(1, 460258, 'DA24QLTN'),
(1, 470351, 'DA22KNT'),
(1, 470352, 'DA22KNT'),
(1, 470378, 'DA23TMDT'),
(1, 470400, 'DA22QTMKT'),
(1, 470452, 'DA22TCNHB'),
(1, 470456, 'DA24LQLC'),
(1, 620058, 'DA23MN'),
(2, 110003, 'DA24TTB'),
(2, 210005, 'DA24CNOTA'),
(2, 210037, 'DA23CNOTA'),
(2, 210038, 'DA23CNOTB'),
(2, 210046, 'DA24CK'),
(2, 210068, 'DA24CNOTB'),
(2, 210087, 'DA24CNOTA'),
(2, 210088, 'DA24CNOTA'),
(2, 210146, 'DA23CNOTB'),
(2, 210281, 'DA22CNOTB'),
(2, 210321, 'DA23CK'),
(2, 210344, 'DA23CNOTA'),
(2, 210387, 'DA21CKB'),
(2, 210392, 'DA22CNOTB'),
(2, 210398, 'DA22CNOTB'),
(2, 220018, 'DA23TTB'),
(2, 220060, 'DA22TTB'),
(2, 220071, 'DA22TTB'),
(2, 220101, 'DA23TTB'),
(2, 220126, 'DA22TTB'),
(2, 220220, 'DA23YHDPB'),
(2, 220234, 'DA24TTB'),
(2, 220236, 'DA23TTB'),
(2, 220237, 'DA23TTB'),
(2, 220242, 'DA22TTB'),
(2, 220248, 'DA21TTB'),
(2, 220249, 'DA21TTB'),
(2, 220250, 'DA23TTB'),
(2, 220269, 'DA22TTB'),
(2, 230014, 'DA23KDA'),
(2, 230114, 'DA23KDA'),
(2, 230119, 'DA23CNOTA'),
(2, 240116, 'DA24KDA'),
(2, 240175, 'DA22DCNB'),
(2, 240182, 'DA23KDB'),
(2, 240196, 'DA24KDC'),
(2, 240200, 'DA23KDA'),
(2, 240207, 'DE23KD04'),
(2, 240212, 'DA22KDHT'),
(2, 240215, 'DE23KD04'),
(2, 260064, 'DA23KDA'),
(2, 280002, 'DA24XDGT'),
(2, 280012, 'DA24XDGT'),
(2, 280016, 'DA24XDGT'),
(2, 280017, 'DA24XDGT'),
(2, 280023, 'DA23XD'),
(2, 280043, 'VB23XD04'),
(2, 280089, 'DA24XDGT'),
(2, 280096, 'VB23XD04'),
(2, 280106, 'DA24XDGT'),
(2, 280109, 'DA23XD'),
(2, 280173, 'VB23XD04'),
(2, 280174, 'VB23XD04'),
(2, 280182, 'DA22XD'),
(2, 280208, 'VB23XD04'),
(2, 410418, 'DA24NNAB'),
(2, 420000, 'DA22TTB'),
(2, 460200, 'DA24XYHB'),
(2, 460201, 'DA24CNOTA'),
(2, 470198, 'DA22QTMKT'),
(2, 470452, 'DA22TCNHC'),
(2, 620058, 'DA23MN'),
(3, 210005, 'DA24CNOTB'),
(3, 210037, 'DA23CNOTB'),
(3, 210066, 'DA22CNOTA'),
(3, 210087, 'DA24CNOTB'),
(3, 210088, 'DA24CNOTB'),
(3, 210344, 'DA23CNOTB'),
(3, 210389, 'DA22CNOTA'),
(3, 210392, 'DA22CNOTA'),
(3, 220018, 'DA23TTC'),
(3, 220055, 'DA22TTC'),
(3, 220060, 'DA22TTC'),
(3, 220071, 'DA22TTC'),
(3, 220101, 'DA23TTC'),
(3, 220126, 'DA22TTC'),
(3, 220236, 'DA23TTC'),
(3, 220237, 'DA23TTC'),
(3, 220242, 'DA22TTC'),
(3, 220248, 'DA21TTC'),
(3, 220249, 'DA21TTC'),
(3, 220250, 'DA23TTC'),
(3, 220269, 'DA22TTC'),
(3, 230014, 'DA23KDB'),
(3, 230114, 'DA23KDB'),
(3, 230119, 'DA23CNOTB'),
(3, 240057, 'DA22KDHT'),
(3, 240116, 'DA24KDB'),
(3, 240121, 'DA22DCNA'),
(3, 240178, 'DA23KDB'),
(3, 240182, 'DA23KDC'),
(3, 240196, 'DA24KDA'),
(3, 240200, 'DA23KDB'),
(3, 240203, 'DA22KDHT'),
(3, 240207, 'DA22KDHT'),
(3, 260064, 'DA23KDB'),
(3, 420000, 'DA22TTC'),
(3, 460201, 'DA24CNOTB'),
(3, 470035, 'DA24TMDT'),
(4, 210005, 'DA24CNOTB'),
(4, 210037, 'DA23CNOTB'),
(4, 210066, 'DA22CNOTB'),
(4, 210389, 'DA22CNOTA'),
(4, 210392, 'DA22CNOTB'),
(4, 220018, 'DA23TTD'),
(4, 220055, 'DA22TTD'),
(4, 220060, 'DA22TTD'),
(4, 220071, 'DA22TTD'),
(4, 220101, 'DA23TTD'),
(4, 220126, 'DA22TTD'),
(4, 220236, 'DA23TTD'),
(4, 220237, 'DA23TTD'),
(4, 220242, 'DA22TTD'),
(4, 220250, 'DA23TTD'),
(4, 220269, 'DA22TTD'),
(4, 230014, 'DA23KDC'),
(4, 230114, 'DA23KDC'),
(4, 240057, 'DA22DCNA'),
(4, 240116, 'DA24KDC'),
(4, 240121, 'DA22DCNA'),
(4, 240161, 'DA22DCNA'),
(4, 240178, 'DA23KDC'),
(4, 240196, 'DA24KDA'),
(4, 240200, 'DA23KDC'),
(4, 240203, 'DA22DCNA'),
(4, 240217, 'DE23KD04'),
(4, 260064, 'DA23KDC'),
(4, 420000, 'DA22TTD'),
(5, 210389, 'DA22CNOTB'),
(5, 220220, 'DA24DC'),
(5, 220232, 'DA21TTA'),
(5, 230114, 'DA23KDA'),
(5, 240057, 'DA22DCNA'),
(5, 240121, 'DA22DCNB'),
(5, 240161, 'DA22DCNA'),
(5, 240196, 'DA24KDB'),
(5, 240203, 'DA22DCNA'),
(5, 290000, 'DA23DT'),
(5, 410418, 'DA24NNAE'),
(6, 210389, 'DA22CNOTB'),
(6, 220232, 'DA21TTB'),
(6, 230114, 'DA23KDC'),
(6, 240057, 'DA22DCNB'),
(6, 240121, 'DA22DCNB'),
(6, 240161, 'DA22DCNB'),
(6, 240196, 'DA24KDB'),
(6, 240203, 'DA22DCNB'),
(6, 290000, 'DA23KDA'),
(7, 220220, 'DA24DDB'),
(7, 220232, 'DA21TTC'),
(7, 230114, 'DA23KDB'),
(7, 240057, 'DA22DCNB'),
(7, 240161, 'DA22DCNB'),
(7, 240196, 'DA24KDC'),
(7, 240203, 'DA22DCNB'),
(7, 240217, 'DA22KDHT'),
(7, 290000, 'DA23KDB'),
(8, 240217, 'DA22DCNA'),
(8, 290000, 'DA23KDC'),
(9, 220220, 'DA24DDD'),
(9, 240217, 'DA22DCNA'),
(10, 220220, 'DA24KTHY, DA24YTC'),
(10, 240208, 'DE23KD04'),
(10, 240217, 'DA22DCNB'),
(11, 150018, 'KNM_1'),
(11, 220220, 'DA24PHCNA'),
(11, 240217, 'DA22DCNB'),
(12, 150018, 'KNM_1'),
(13, 150003, 'KNM_10'),
(13, 150018, 'KNM_10'),
(14, 150013, 'KNM_10'),
(14, 150018, 'KNM_10'),
(15, 150003, 'KNM_2'),
(15, 150004, 'KNM_2'),
(15, 150013, 'KNM_2'),
(16, 150003, 'KNM_2'),
(16, 150008, 'KNM_2'),
(17, 150003, 'KNM_3'),
(17, 290000, 'DA24TTB'),
(18, 150008, 'KNM_3'),
(18, 290000, 'DA24TTC'),
(19, 150013, 'KNM_4'),
(19, 290000, 'DA24TTD'),
(20, 150003, 'KNM_4'),
(20, 150004, 'KNM_4'),
(20, 150013, 'KNM_4'),
(22, 150004, 'KNM_5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_cong`
--

CREATE TABLE `phan_cong` (
  `maPC` int(11) NOT NULL,
  `manhom` int(11) DEFAULT NULL,
  `maMH` int(11) DEFAULT NULL,
  `maGV` varchar(10) DEFAULT NULL,
  `maHK` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phan_cong`
--

INSERT INTO `phan_cong` (`maPC`, `manhom`, `maMH`, `maGV`, `maHK`) VALUES
(530, 1, 420280, 'QT87', 'HK01'),
(531, 1, 470351, 'TC10', 'HK01'),
(532, 1, 470352, 'TC10', 'HK01'),
(533, 1, 470452, 'TC10', 'HK01'),
(536, 1, 420280, 'QT87', 'HK02'),
(537, 1, 470351, 'TC10', 'HK02'),
(538, 1, 470352, 'TC10', 'HK02'),
(539, 1, 470452, 'TC10', 'HK02'),
(542, 1, 210038, 'CK07', 'HK02'),
(543, 2, 210398, 'CK14', 'HK02'),
(544, 1, 210068, 'CK16', 'HK02'),
(545, 5, 220220, 'TT21', 'HK02'),
(546, 2, 280089, 'XD45', 'HK02'),
(547, 1, 220269, '00053', 'HK02'),
(548, 13, 150018, '00236', 'HK02'),
(549, 22, 150004, '00237', 'HK02'),
(550, 3, 420000, '00237', 'HK02'),
(551, 6, 240161, '00238', 'HK02'),
(552, 10, 240217, '00238', 'HK02'),
(553, 1, 220071, '00241', 'HK02'),
(554, 1, 220250, '00241', 'HK02'),
(555, 2, 220018, '00242', 'HK02'),
(556, 6, 220232, '00242', 'HK02'),
(557, 3, 470035, '00242', 'HK02'),
(558, 1, 420222, '00242', 'HK02'),
(559, 1, 220018, '00243', 'HK02'),
(560, 1, 220101, '00243', 'HK02'),
(561, 11, 220220, '00243', 'HK02'),
(562, 2, 210146, '00244', 'HK02'),
(563, 3, 220242, '00244', 'HK02'),
(564, 1, 220248, '00244', 'HK02'),
(565, 1, 220055, '00245', 'HK02'),
(566, 1, 470378, '00245', 'HK02'),
(567, 16, 150003, '00246', 'HK02'),
(568, 2, 220236, '00246', 'HK02'),
(569, 11, 150018, '00248', 'HK02'),
(570, 17, 290000, '00248', 'HK02'),
(571, 3, 220269, '00249', 'HK02'),
(572, 4, 220060, '00250', 'HK02'),
(573, 2, 220071, '00251', 'HK02'),
(574, 1, 110003, '00252', 'HK02'),
(575, 13, 150003, '00253', 'HK02'),
(576, 1, 220249, '00253', 'HK02'),
(577, 2, 410418, '00253', 'HK02'),
(578, 1, 220220, '00254', 'HK02'),
(579, 4, 220237, '00254', 'HK02'),
(580, 1, 220236, '00255', 'HK02'),
(581, 1, 410418, '00255', 'HK02'),
(582, 5, 220232, '00257', 'HK02'),
(583, 1, 220237, '00257', 'HK02'),
(584, 1, 420000, '00259', 'HK02'),
(585, 1, 230127, '00260', 'HK02'),
(586, 5, 240121, '00260', 'HK02'),
(587, 1, 460258, '00260', 'HK02'),
(588, 1, 230149, '00261', 'HK02'),
(589, 5, 290000, '00261', 'HK02'),
(590, 3, 240121, '00262', 'HK02'),
(591, 1, 240200, '00262', 'HK02'),
(592, 1, 240212, '00262', 'HK02'),
(593, 1, 240216, '00262', 'HK02'),
(594, 4, 210389, '00267', 'HK02'),
(595, 1, 340165, '00267', 'HK02'),
(596, 1, 210143, '00268', 'HK02'),
(597, 1, 210398, '00268', 'HK02'),
(598, 2, 210005, '00269', 'HK02'),
(599, 1, 210023, '00269', 'HK02'),
(600, 1, 230119, '00269', 'HK02'),
(601, 1, 210037, '00270', 'HK02'),
(602, 2, 210087, '00270', 'HK02'),
(603, 1, 280149, '00275', 'HK02'),
(604, 1, 280156, '00275', 'HK02'),
(605, 1, 280162, '00275', 'HK02'),
(606, 1, 280198, '00275', 'HK02'),
(607, 1, 280216, '00275', 'HK02'),
(608, 1, 280221, '00275', 'HK02'),
(609, 1, 280225, '00275', 'HK02'),
(610, 1, 280153, '00275', 'HK02'),
(611, 1, 280012, '00277', 'HK02'),
(612, 1, 280016, '00277', 'HK02'),
(613, 1, 280098, '00277', 'HK02'),
(614, 1, 280172, '00277', 'HK02'),
(615, 2, 280096, '00278', 'HK02'),
(616, 1, 280109, '00278', 'HK02'),
(617, 2, 280208, '00278', 'HK02'),
(618, 1, 280011, '00279', 'HK02'),
(619, 1, 280155, '00279', 'HK02'),
(620, 1, 280173, '00280', 'HK02'),
(621, 1, 280174, '00280', 'HK02'),
(622, 2, 280182, '00280', 'HK02'),
(623, 1, 280203, '00280', 'HK02'),
(624, 1, 280154, '00281', 'HK02'),
(625, 2, 280012, '00283', 'HK02'),
(626, 1, 280046, '00283', 'HK02'),
(627, 1, 280135, '00283', 'HK02'),
(628, 1, 280208, '00283', 'HK02'),
(629, 1, 280220, '00283', 'HK02'),
(630, 2, 280023, '00284', 'HK02'),
(631, 1, 280106, '00284', 'HK02'),
(632, 1, 280213, '00284', 'HK02'),
(633, 1, 280043, '00284', 'HK02'),
(634, 2, 280173, '00284', 'HK02'),
(635, 16, 150008, '00285', 'HK02'),
(637, 1, 280021, '00285', 'HK02'),
(638, 1, 280095, '00285', 'HK02'),
(639, 1, 320335, '00346', 'HK02'),
(640, 1, 460200, '00346', 'HK02'),
(641, 1, 210087, '00574', 'HK02'),
(642, 3, 210392, '00574', 'HK02'),
(643, 1, 460201, '00574', 'HK02'),
(644, 1, 280139, '00661', 'HK02'),
(645, 1, 280160, '00661', 'HK02'),
(646, 1, 280179, '00661', 'HK02'),
(647, 1, 280183, '00661', 'HK02'),
(648, 1, 280215, '00661', 'HK02'),
(649, 1, 280141, '00661', 'HK02'),
(650, 1, 280144, '00661', 'HK02'),
(651, 1, 280152, '00661', 'HK02'),
(652, 1, 280180, '00661', 'HK02'),
(653, 1, 230145, '00696', 'HK02'),
(654, 1, 240205, '00696', 'HK02'),
(655, 2, 260064, '00696', 'HK02'),
(656, 1, 280018, '00707', 'HK02'),
(657, 1, 280002, '00823', 'HK02'),
(658, 1, 280044, '00823', 'HK02'),
(659, 1, 280104, '00823', 'HK02'),
(660, 1, 280061, '00823', 'HK02'),
(661, 2, 280017, '01016', 'HK02'),
(662, 1, 280089, '01016', 'HK02'),
(663, 1, 280114, '01016', 'HK02'),
(664, 2, 240200, '02405', 'HK02'),
(665, 1, 260065, '02405', 'HK02'),
(666, 1, 220234, '03539', 'HK02'),
(667, 1, 220060, '03546', 'HK02'),
(668, 2, 220220, '03546', 'HK02'),
(669, 1, 620058, '03562', 'HK02'),
(670, 4, 210037, '06742', 'HK02'),
(671, 1, 210088, '06742', 'HK02'),
(672, 1, 220126, '12661', 'HK02'),
(673, 1, 240161, '12692', 'HK02'),
(674, 1, 240178, '12692', 'HK02'),
(675, 4, 240203, '12692', 'HK02'),
(676, 1, 240084, '12694', 'HK02'),
(677, 3, 240203, '12694', 'HK02'),
(678, 10, 240208, '12694', 'HK02'),
(679, 3, 240057, '12695', 'HK02'),
(680, 3, 240178, '12695', 'HK02'),
(681, 4, 230014, '12696', 'HK02'),
(682, 2, 230114, '12696', 'HK02'),
(683, 9, 220220, '12702', 'HK02'),
(684, 1, 470456, '12702', 'HK02'),
(685, 1, 210387, '12703', 'HK02'),
(686, 6, 230114, '12703', 'HK02'),
(687, 2, 240116, '12703', 'HK02'),
(688, 1, 230014, '12704', 'HK02'),
(689, 1, 240116, '12704', 'HK02'),
(690, 1, 220242, '12705', 'HK02'),
(691, 2, 220250, '12705', 'HK02'),
(692, 1, 230014, '12707', 'HK02'),
(693, 1, 230114, '12707', 'HK02'),
(694, 15, 150004, '12710', 'HK02'),
(696, 14, 150013, '12710', 'HK02'),
(697, 3, 210066, '12710', 'HK02'),
(698, 3, 210389, '12710', 'HK02'),
(699, 1, 210392, '12710', 'HK02'),
(700, 1, 210110, '12711', 'HK02'),
(701, 2, 210321, '12711', 'HK02'),
(702, 1, 240076, '14189', 'HK02'),
(703, 2, 240207, '14189', 'HK02'),
(704, 2, 240212, '14189', 'HK02'),
(705, 7, 240217, '14189', 'HK02'),
(706, 1, 240215, '14190', 'HK02'),
(707, 1, 340208, '14190', 'HK02'),
(708, 1, 240175, '14191', 'HK02'),
(709, 3, 240196, '14191', 'HK02'),
(710, 2, 220101, '14204', 'HK02'),
(711, 1, 240196, '14209', 'HK02'),
(712, 1, 210281, '14219', 'HK02'),
(713, 1, 210302, '14221', 'HK02'),
(714, 1, 210344, '14221', 'HK02'),
(716, 19, 150013, '14230', 'HK02'),
(717, 1, 230116, '14230', 'HK02'),
(718, 1, 230140, '14230', 'HK02'),
(719, 1, 240182, '14230', 'HK02'),
(720, 1, 240207, '14230', 'HK02'),
(721, 1, 280019, '14238', 'HK02'),
(722, 1, 280026, '14238', 'HK02'),
(723, 2, 280106, '14238', 'HK02'),
(724, 1, 280108, '14238', 'HK02'),
(725, 1, 280136, '14238', 'HK02'),
(726, 1, 280182, '14238', 'HK02'),
(727, 1, 280029, '14238', 'HK02'),
(728, 1, 210005, '14259', 'HK02'),
(729, 1, 210046, '14259', 'HK02'),
(730, 1, 210321, '14259', 'HK02'),
(731, 1, 280017, '16350', 'HK02'),
(732, 1, 280062, '16350', 'HK02'),
(733, 1, 280096, '16350', 'HK02'),
(734, 1, 280063, '16350', 'HK02'),
(735, 1, 280204, 'CH247', 'HK02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `maSV` int(11) NOT NULL,
  `holot` varchar(50) DEFAULT NULL,
  `tenSV` varchar(100) DEFAULT NULL,
  `manhom` int(11) NOT NULL,
  `maMH` int(11) NOT NULL,
  `toTH` int(11) NOT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `malop` varchar(10) DEFAULT NULL,
  `tenlop` varchar(100) DEFAULT NULL,
  `matk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sinh_vien`
--

INSERT INTO `sinh_vien` (`maSV`, `holot`, `tenSV`, `manhom`, `maMH`, `toTH`, `sdt`, `email`, `malop`, `tenlop`, `matk`) VALUES
(110120006, 'Đặng Kim', 'Bắc', 2, 220236, 2, '0326972624', '', 'DA20TTA', 'ĐH Công nghệ thông tin A 2020', 4783),
(110120047, 'Trầm Hữu', 'Lợi', 2, 220236, 2, '', '', 'DA20TTA', 'ĐH Công nghệ thông tin A 2020', 4785),
(110123154, 'Nguyễn Đại', 'Phát', 2, 220236, 2, '', 'dfat0612@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4788),
(110123155, 'Võ Tấn', 'Phát', 2, 220236, 2, '', 'Votanphathtt2005@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4790),
(110123157, 'Trần Đình', 'Phú', 2, 220236, 2, '', 'phutrn16@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4791),
(110123159, 'Phan Huỳnh', 'Phúc', 2, 220236, 2, '', 'huynhphuc12122000@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4792),
(110123160, 'Phan Thanh', 'Phúc', 2, 220236, 2, '', 'thanhphucphan54@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4793),
(110123161, 'Lê Vũ Duy', 'Phương', 2, 220236, 1, '', 'levuduyphuong1006@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4759),
(110123162, 'Trần Minh', 'Quang', 2, 220236, 2, '', 'mjnhquang357@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4794),
(110123163, 'Nguyễn Kiến', 'Quốc', 2, 220236, 1, '', 'bestquocnguyen@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4761),
(110123166, 'Lê Thanh', 'Sang', 2, 220236, 2, '', 'thanhsang9613@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4795),
(110123167, 'Lê Thanh', 'Sang', 2, 220236, 2, '', '', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4796),
(110123168, 'Trần Hoàng', 'Sang', 2, 220236, 1, '', 'tranhoangsangtravinh@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4762),
(110123169, 'Lê Ngọc', 'Sơn', 2, 220236, 1, '', 'son93392@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4763),
(110123170, 'Đinh Thái', 'Tài', 2, 220236, 1, '', 'taidinh.527497@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4764),
(110123171, 'Nguyễn Đỗ Minh', 'Tài', 2, 220236, 1, '', 'minhtaimc2022@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4765),
(110123172, 'Thạch Kim', 'Tài', 2, 220236, 1, '', 'thachkimtaitvh@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4766),
(110123173, 'Võ Anh', 'Tài', 2, 220236, 1, '', 'Taidz911@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4767),
(110123174, 'Lê Huỳnh Hiếu', 'Tâm', 2, 220236, 1, '', 'ltam54127@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4768),
(110123177, 'Nguyễn Văn', 'Thân', 2, 220236, 2, '', 'thanchery03@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4797),
(110123178, 'Phạm Tri', 'Thức', 2, 220236, 1, '', 'phamtrithuc393939@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4773),
(110123179, 'Nguyễn Văn Hoàng', 'Thiên', 2, 220236, 2, '', 'hoangthien0343145069@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4798),
(110123180, 'Lê Nhất', 'Thiện', 2, 220236, 1, '', 'thienkoi936@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4771),
(110123181, 'Nguyễn Thanh', 'Thịnh', 2, 220236, 1, '', 'nguyenthanhthinh078@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4772),
(110123183, 'Huỳnh Thị Phương', 'Thùy', 2, 220236, 2, '', 'huynhthiphuongthuy0905@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4799),
(110123184, 'Huỳnh Ngọc Minh', 'Thư', 2, 220236, 2, '', '', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4800),
(110123185, 'Nguyễn Hữu', 'Tiến', 2, 220236, 1, '', 'Tienhuu776@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4774),
(110123186, 'Trần Trung', 'Tín', 2, 220236, 1, '', 'trantrungtintv2021@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4775),
(110123187, 'Đặng Cao', 'Toàn', 2, 220236, 1, '', 'toancao436@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4776),
(110123188, 'Trương Văn', 'Toàn', 2, 220236, 1, '', 'toantruong926@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4777),
(110123189, 'Ngô Thanh', 'Trà', 2, 220236, 2, '', 'ngothanhtratv@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4801),
(110123191, 'Phạm Thị Bảo', 'Trâm', 2, 220236, 1, '', 'tram0816292918@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4778),
(110123192, 'Phạm Quí Ngọc', 'Trân', 2, 220236, 2, '', 'tranpham857341@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4802),
(110123195, 'Nguyễn Đức', 'Trọng', 2, 220236, 1, '', 'trinh0366101955@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4779),
(110123197, 'Kim Thanh', 'Tùng', 2, 220236, 1, '', 'kttmm841@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4780),
(110123198, 'Nguyễn Trần Phương', 'Uyên', 2, 220236, 2, '', 'nguyentranphuonguyen11@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4803),
(110123199, 'Nguyễn Thị Triệu', 'Vi', 2, 220236, 2, '', 'trieuvi180403@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4805),
(110123201, 'Phạm Quốc', 'Vẹn', 2, 220236, 2, '', 'a9phamquocven@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4804),
(110123203, 'Tạ Hằng', 'Vũ', 2, 220236, 1, '', 'hangvuzxjv@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4781),
(110123204, 'Trần Lê Lan', 'Vy', 2, 220236, 1, '', 'tranlelanvytvh11@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4782),
(110123205, 'Phạm Thị Như', 'Ý', 2, 220236, 2, '', 'phamthinhuy788325@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4806),
(110123256, 'Thạch', 'Thiên', 2, 220236, 1, '', 'thienthachhvbn@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4770),
(110123257, 'Thang Kim Hoàng', 'Quí', 2, 220236, 1, '', 'hoangquidavid@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4760),
(110123258, 'Trần Minh', 'Hiếu', 2, 220236, 1, '', 'hieutran789tv@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4757),
(110123259, 'Trương Duy', 'Tân', 2, 220236, 1, '', 'dtan8842@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4769),
(110123260, 'Trương Hoàng', 'Mãi', 2, 220236, 1, '', 'truonghoangmai02012002@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4758),
(110123261, 'Trương Minh', 'Dĩ', 2, 220236, 2, '', '', 'DA23TTD', 'ĐH Công nghệ thông tin D 2023', 4784),
(110123262, 'Trương Tấn', 'Phát', 2, 220236, 2, '', 'tphatss0605@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4789),
(110123263, 'Trương Truyền Phúc', 'Minh', 2, 220236, 2, '', 'ttphucminh2005@gmail.com', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4787),
(110123264, 'Nguyễn Hà Nhật', 'Minh', 2, 220236, 2, '', '', 'DA23TTB', 'ĐH Công nghệ thông tin D 2023', 4786),
(110421004, 'Nguyễn Khắc Tiểu', 'Bình', 1, 420280, 1, '0984644911', '110421004@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4625),
(110421004, 'Nguyễn Khắc Tiểu', 'Bình', 1, 470351, 2, '0984644911', '110421004@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4625),
(110421004, 'Nguyễn Khắc Tiểu', 'Bình', 1, 470352, 3, '0984644911', '110421004@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4625),
(110421005, 'Trương Bảo', 'Châu', 1, 420280, 1, '0772106210', '110421005@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4626),
(110421005, 'Trương Bảo', 'Châu', 1, 470351, 2, '0772106210', '110421005@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4626),
(110421005, 'Trương Bảo', 'Châu', 1, 470352, 3, '0772106210', '110421005@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4626),
(110421015, 'Nguyễn Thị Thảo', 'Duy', 1, 420280, 1, '0338186143', '110421015@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4627),
(110421015, 'Nguyễn Thị Thảo', 'Duy', 1, 470351, 2, '0338186143', '110421015@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4627),
(110421015, 'Nguyễn Thị Thảo', 'Duy', 1, 470352, 3, '0338186143', '110421015@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4627),
(110421017, 'Nguyễn Thị Mỹ', 'Duyên', 1, 420280, 1, '0913464332', '110421017@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4628),
(110421017, 'Nguyễn Thị Mỹ', 'Duyên', 1, 470351, 2, '0913464332', '110421017@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4628),
(110421017, 'Nguyễn Thị Mỹ', 'Duyên', 1, 470352, 3, '0913464332', '110421017@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4628),
(110421018, 'Trần Thị Huỳnh', 'Giao', 1, 420280, 1, '0378422893', '', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4630),
(110421018, 'Trần Thị Huỳnh', 'Giao', 1, 470351, 2, '0378422893', '', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4630),
(110421018, 'Trần Thị Huỳnh', 'Giao', 1, 470352, 3, '0378422893', '', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4630),
(110421019, 'Châu Ngọc', 'Hân', 1, 420280, 1, '0365989818', '110421019@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4632),
(110421019, 'Châu Ngọc', 'Hân', 1, 470351, 2, '0365989818', '110421019@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4632),
(110421019, 'Châu Ngọc', 'Hân', 1, 470352, 3, '0365989818', '110421019@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4632),
(110421021, 'Võ Thị Thúy', 'Hằng', 1, 420280, 1, '0868462254', '110421021@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4631),
(110421021, 'Võ Thị Thúy', 'Hằng', 1, 470351, 2, '0868462254', '110421021@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4631),
(110421021, 'Võ Thị Thúy', 'Hằng', 1, 470352, 3, '0868462254', '110421021@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4631),
(110421029, 'Nguyễn Văn', 'Kỳ', 1, 420280, 1, '0386917948', '110421029@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4635),
(110421029, 'Nguyễn Văn', 'Kỳ', 1, 470351, 2, '0386917948', '110421029@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4635),
(110421029, 'Nguyễn Văn', 'Kỳ', 1, 470352, 3, '0386917948', '110421029@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4635),
(110421033, 'Lê Trang Hà', 'My', 1, 420280, 1, '0389891778', '110421033@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4637),
(110421033, 'Lê Trang Hà', 'My', 1, 470351, 2, '0389891778', '110421033@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4637),
(110421033, 'Lê Trang Hà', 'My', 1, 470352, 3, '0389891778', '110421033@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4637),
(110421052, 'Lý Thị Yến', 'Nhi', 1, 420280, 1, '0963447157', '110421052@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4641),
(110421052, 'Lý Thị Yến', 'Nhi', 1, 470351, 2, '0963447157', '110421052@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4641),
(110421052, 'Lý Thị Yến', 'Nhi', 1, 470352, 3, '0963447157', '110421052@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4641),
(110421066, 'Hồ Thị Như', 'Quỳnh', 1, 420280, 1, '0982579074', '110421066@st.tvu.edu.vn', 'DA21NNAA', 'ĐH Ngôn ngữ Anh A 2021', 4643),
(110421066, 'Hồ Thị Như', 'Quỳnh', 1, 470351, 2, '0982579074', '110421066@st.tvu.edu.vn', 'DA21NNAA', 'ĐH Ngôn ngữ Anh A 2021', 4643),
(110421066, 'Hồ Thị Như', 'Quỳnh', 1, 470352, 3, '0982579074', '110421066@st.tvu.edu.vn', 'DA21NNAA', 'ĐH Ngôn ngữ Anh A 2021', 4643),
(110421072, 'Lê Thị Như', 'Tâm', 1, 420280, 1, '0355433905', '110421072@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4645),
(110421072, 'Lê Thị Như', 'Tâm', 1, 470351, 2, '0355433905', '110421072@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4645),
(110421072, 'Lê Thị Như', 'Tâm', 1, 470352, 3, '0355433905', '110421072@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4645),
(110421078, 'Võ Ngọc Yến', 'Thanh', 1, 420280, 1, '0354923402', '110421078@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4646),
(110421078, 'Võ Ngọc Yến', 'Thanh', 1, 470351, 2, '0354923402', '110421078@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4646),
(110421078, 'Võ Ngọc Yến', 'Thanh', 1, 470352, 3, '0354923402', '110421078@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4646),
(110421080, 'Tiêu Trường', 'Thành', 1, 420280, 1, '0896614247', '110421080@st.tvu.edu.vn', 'DA21NNAA', 'ĐH Ngôn ngữ Anh A 2021', 4647),
(110421080, 'Tiêu Trường', 'Thành', 1, 470351, 2, '0896614247', '110421080@st.tvu.edu.vn', 'DA21NNAA', 'ĐH Ngôn ngữ Anh A 2021', 4647),
(110421080, 'Tiêu Trường', 'Thành', 1, 470352, 3, '0896614247', '110421080@st.tvu.edu.vn', 'DA21NNAA', 'ĐH Ngôn ngữ Anh A 2021', 4647),
(110421081, 'Trương Hoàn', 'Thiện', 1, 420280, 1, '0946853774', '110421081@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4649),
(110421081, 'Trương Hoàn', 'Thiện', 1, 470351, 2, '0946853774', '110421081@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4649),
(110421081, 'Trương Hoàn', 'Thiện', 1, 470352, 3, '0946853774', '110421081@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4649),
(110421092, 'Trương Huỳnh Mộng', 'Thy', 1, 420280, 1, '0918528085', '110421092@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4650),
(110421092, 'Trương Huỳnh Mộng', 'Thy', 1, 470351, 2, '0918528085', '110421092@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4650),
(110421092, 'Trương Huỳnh Mộng', 'Thy', 1, 470352, 3, '0918528085', '110421092@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4650),
(110421102, 'Lê Tiến', 'Triển', 1, 420280, 1, '0869338323', '110421102@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4651),
(110421102, 'Lê Tiến', 'Triển', 1, 470351, 2, '0869338323', '110421102@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4651),
(110421102, 'Lê Tiến', 'Triển', 1, 470352, 3, '0869338323', '110421102@st.tvu.edu.vn', 'DA21NNAC', 'ĐH Ngôn ngữ Anh C 2021', 4651),
(110421106, 'Trần Lê Anh', 'Tuấn', 1, 420280, 1, '0938655385', '110421106@st.tvu.edu.vn', 'DA21NNAA', 'ĐH Ngôn ngữ Anh A 2021', 4653),
(110421106, 'Trần Lê Anh', 'Tuấn', 1, 470351, 2, '0938655385', '110421106@st.tvu.edu.vn', 'DA21NNAA', 'ĐH Ngôn ngữ Anh A 2021', 4653),
(110421106, 'Trần Lê Anh', 'Tuấn', 1, 470352, 3, '0938655385', '110421106@st.tvu.edu.vn', 'DA21NNAA', 'ĐH Ngôn ngữ Anh A 2021', 4653),
(110421153, 'Nguyễn Vân', 'Khánh', 1, 420280, 1, '0869172022', '110421153@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4633),
(110421153, 'Nguyễn Vân', 'Khánh', 1, 470351, 2, '0869172022', '110421153@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4633),
(110421153, 'Nguyễn Vân', 'Khánh', 1, 470352, 3, '0869172022', '110421153@st.tvu.edu.vn', 'DA21NNAB', 'ĐH Ngôn ngữ Anh B 2021', 4633),
(110421159, 'Kiên Thanh', 'Thảo', 1, 420280, 1, '0367959923', '110421159@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4648),
(110421159, 'Kiên Thanh', 'Thảo', 1, 470351, 2, '0367959923', '110421159@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4648),
(110421159, 'Kiên Thanh', 'Thảo', 1, 470352, 3, '0367959923', '110421159@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4648),
(110421162, 'Võ Đức', 'Tài', 1, 420280, 1, '0333927556', '110421162@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4644),
(110421162, 'Võ Đức', 'Tài', 1, 470351, 2, '0333927556', '110421162@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4644),
(110421162, 'Võ Đức', 'Tài', 1, 470352, 3, '0333927556', '110421162@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4644),
(110421171, 'Lâm Thị', 'Linh', 1, 420280, 1, '0372652491', '110421171@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4636),
(110421171, 'Lâm Thị', 'Linh', 1, 470351, 2, '0372652491', '110421171@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4636),
(110421171, 'Lâm Thị', 'Linh', 1, 470352, 3, '0372652491', '110421171@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4636),
(110421172, 'Kim Thị Yến', 'Nhi', 1, 420280, 1, '0866924870', '110421172@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4640),
(110421172, 'Kim Thị Yến', 'Nhi', 1, 470351, 2, '0866924870', '110421172@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4640),
(110421172, 'Kim Thị Yến', 'Nhi', 1, 470352, 3, '0866924870', '110421172@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4640),
(110421175, 'Trần Thị Kim', 'Phụng', 1, 420280, 1, '0827640139', '110421175@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4642),
(110421175, 'Trần Thị Kim', 'Phụng', 1, 470351, 2, '0827640139', '110421175@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4642),
(110421175, 'Trần Thị Kim', 'Phụng', 1, 470352, 3, '0827640139', '110421175@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4642),
(110421194, 'Dương Hoàng Mai', 'Anh', 1, 420280, 1, '0707824879', '110421194@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4623),
(110421194, 'Dương Hoàng Mai', 'Anh', 1, 470351, 2, '0707824879', '110421194@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4623),
(110421194, 'Dương Hoàng Mai', 'Anh', 1, 470352, 3, '0707824879', '110421194@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4623),
(110421198, 'Trịnh Hà Bảo', 'Ngọc', 1, 420280, 1, '0907547508', '110421198@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4639),
(110421198, 'Trịnh Hà Bảo', 'Ngọc', 1, 470351, 2, '0907547508', '110421198@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4639),
(110421198, 'Trịnh Hà Bảo', 'Ngọc', 1, 470352, 3, '0907547508', '110421198@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4639),
(110421204, 'Lương Thị Thu', 'Bình', 1, 420280, 1, '0354052637', '110421204@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4624),
(110421204, 'Lương Thị Thu', 'Bình', 1, 470351, 2, '0354052637', '110421204@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4624),
(110421204, 'Lương Thị Thu', 'Bình', 1, 470352, 3, '0354052637', '110421204@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4624),
(110421209, 'Huỳnh Hoàng', 'Tuấn', 1, 420280, 1, '0393220591', '110421209@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4652),
(110421209, 'Huỳnh Hoàng', 'Tuấn', 1, 470351, 2, '0393220591', '110421209@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4652),
(110421209, 'Huỳnh Hoàng', 'Tuấn', 1, 470352, 3, '0393220591', '110421209@st.tvu.edu.vn', 'DA21NNAD', 'ĐH Ngôn ngữ Anh D 2021', 4652),
(110421229, 'Thạch Thị Minh', 'Tuyết', 1, 420280, 1, '0528487069', '110421229@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4654),
(110421229, 'Thạch Thị Minh', 'Tuyết', 1, 470351, 2, '0528487069', '110421229@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4654),
(110421229, 'Thạch Thị Minh', 'Tuyết', 1, 470352, 3, '0528487069', '110421229@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4654),
(110421244, 'Lưu Thị Hồng', 'Ngọc', 1, 420280, 1, '0962698269', '110421244@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4638),
(110421244, 'Lưu Thị Hồng', 'Ngọc', 1, 470351, 2, '0962698269', '110421244@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4638),
(110421244, 'Lưu Thị Hồng', 'Ngọc', 1, 470352, 3, '0962698269', '110421244@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4638),
(110421260, 'Phan Tuấn', 'Kiệt', 1, 420280, 1, '0916785460', '110421260@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4634),
(110421260, 'Phan Tuấn', 'Kiệt', 1, 470351, 2, '0916785460', '110421260@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4634),
(110421260, 'Phan Tuấn', 'Kiệt', 1, 470352, 3, '0916785460', '110421260@st.tvu.edu.vn', 'DA21NNAE', 'ĐH Ngôn ngữ Anh E 2021', 4634);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `matk` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `matkhau` varchar(20) NOT NULL,
  `quyen` enum('Giảng viên','Sinh viên','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`matk`, `username`, `matkhau`, `quyen`) VALUES
(1406, 'QT87', '123', 'Giảng viên'),
(1407, 'TC10', '123', 'Giảng viên'),
(4621, 'admin', '123', 'Admin'),
(4623, '110421194', '110421194', 'Sinh viên'),
(4624, '110421204', '110421204', 'Sinh viên'),
(4625, '110421004', '110421004', 'Sinh viên'),
(4626, '110421005', '110421005', 'Sinh viên'),
(4627, '110421015', '110421015', 'Sinh viên'),
(4628, '110421017', '110421017', 'Sinh viên'),
(4630, '110421018', '110421018', 'Sinh viên'),
(4631, '110421021', '110421021', 'Sinh viên'),
(4632, '110421019', '110421019', 'Sinh viên'),
(4633, '110421153', '110421153', 'Sinh viên'),
(4634, '110421260', '110421260', 'Sinh viên'),
(4635, '110421029', '110421029', 'Sinh viên'),
(4636, '110421171', '110421171', 'Sinh viên'),
(4637, '110421033', '110421033', 'Sinh viên'),
(4638, '110421244', '110421244', 'Sinh viên'),
(4639, '110421198', '110421198', 'Sinh viên'),
(4640, '110421172', '110421172', 'Sinh viên'),
(4641, '110421052', '110421052', 'Sinh viên'),
(4642, '110421175', '110421175', 'Sinh viên'),
(4643, '110421066', '110421066', 'Sinh viên'),
(4644, '110421162', '110421162', 'Sinh viên'),
(4645, '110421072', '110421072', 'Sinh viên'),
(4646, '110421078', '110421078', 'Sinh viên'),
(4647, '110421080', '110421080', 'Sinh viên'),
(4648, '110421159', '110421159', 'Sinh viên'),
(4649, '110421081', '110421081', 'Sinh viên'),
(4650, '110421092', '110421092', 'Sinh viên'),
(4651, '110421102', '110421102', 'Sinh viên'),
(4652, '110421209', '110421209', 'Sinh viên'),
(4653, '110421106', '110421106', 'Sinh viên'),
(4654, '110421229', '110421229', 'Sinh viên'),
(4655, '110121224', '123', 'Sinh viên'),
(4656, 'CK07', 'CK07', 'Giảng viên'),
(4657, 'CK14', 'CK14', 'Giảng viên'),
(4658, 'CK16', 'CK16', 'Giảng viên'),
(4659, 'TT21', 'TT21', 'Giảng viên'),
(4660, 'XD45', 'XD45', 'Giảng viên'),
(4661, '00053', '00053', 'Giảng viên'),
(4662, '00236', '00236', 'Giảng viên'),
(4663, '00237', '00237', 'Giảng viên'),
(4664, '00238', '00238', 'Giảng viên'),
(4665, '00241', '00241', 'Giảng viên'),
(4667, '00242', '00242', 'Giảng viên'),
(4669, '00243', '00243', 'Giảng viên'),
(4670, '00244', '00244', 'Giảng viên'),
(4672, '00245', '00245', 'Giảng viên'),
(4673, '00246', '00246', 'Giảng viên'),
(4675, '00248', '00248', 'Giảng viên'),
(4676, '00249', '00249', 'Giảng viên'),
(4677, '00250', '00250', 'Giảng viên'),
(4678, '00251', '00251', 'Giảng viên'),
(4679, '00252', '00252', 'Giảng viên'),
(4680, '00253', '00253', 'Giảng viên'),
(4682, '00254', '00254', 'Giảng viên'),
(4683, '00255', '00255', 'Giảng viên'),
(4684, '00257', '00257', 'Giảng viên'),
(4686, '00259', '00259', 'Giảng viên'),
(4687, '00260', '00260', 'Giảng viên'),
(4688, '00261', '00261', 'Giảng viên'),
(4689, '00262', '00262', 'Giảng viên'),
(4690, '00267', '00267', 'Giảng viên'),
(4691, '00268', '00268', 'Giảng viên'),
(4692, '00269', '00269', 'Giảng viên'),
(4694, '00270', '00270', 'Giảng viên'),
(4696, '00275', '00275', 'Giảng viên'),
(4697, '00277', '00277', 'Giảng viên'),
(4698, '00278', '00278', 'Giảng viên'),
(4699, '00279', '00279', 'Giảng viên'),
(4700, '00280', '00280', 'Giảng viên'),
(4702, '00281', '00281', 'Giảng viên'),
(4703, '00283', '00283', 'Giảng viên'),
(4704, '00284', '00284', 'Giảng viên'),
(4705, '00285', '00285', 'Giảng viên'),
(4706, '00346', '00346', 'Giảng viên'),
(4707, '00574', '00574', 'Giảng viên'),
(4709, '00661', '00661', 'Giảng viên'),
(4711, '00696', '00696', 'Giảng viên'),
(4712, '00707', '00707', 'Giảng viên'),
(4713, '00823', '00823', 'Giảng viên'),
(4714, '01016', '01016', 'Giảng viên'),
(4715, '02405', '02405', 'Giảng viên'),
(4716, '03539', '03539', 'Giảng viên'),
(4718, '03546', '03546', 'Giảng viên'),
(4720, '03562', '03562', 'Giảng viên'),
(4721, '06742', '06742', 'Giảng viên'),
(4723, '12661', '12661', 'Giảng viên'),
(4725, '12692', '12692', 'Giảng viên'),
(4727, '12694', '12694', 'Giảng viên'),
(4728, '12695', '12695', 'Giảng viên'),
(4729, '12696', '12696', 'Giảng viên'),
(4730, '12702', '12702', 'Giảng viên'),
(4731, '12703', '12703', 'Giảng viên'),
(4733, '12704', '12704', 'Giảng viên'),
(4734, '12705', '12705', 'Giảng viên'),
(4736, '12707', '12707', 'Giảng viên'),
(4737, '12710', '12710', 'Giảng viên'),
(4739, '12711', '12711', 'Giảng viên'),
(4740, '14189', '14189', 'Giảng viên'),
(4741, '14190', '14190', 'Giảng viên'),
(4742, '14191', '14191', 'Giảng viên'),
(4744, '14204', '14204', 'Giảng viên'),
(4746, '14209', '14209', 'Giảng viên'),
(4747, '14219', '14219', 'Giảng viên'),
(4748, '14221', '14221', 'Giảng viên'),
(4749, '14230', '14230', 'Giảng viên'),
(4751, '14238', '14238', 'Giảng viên'),
(4753, '14259', '14259', 'Giảng viên'),
(4755, '16350', '16350', 'Giảng viên'),
(4756, 'CH247', 'CH247', 'Giảng viên'),
(4757, '110123258', '110123258', 'Sinh viên'),
(4758, '110123260', '110123260', 'Sinh viên'),
(4759, '110123161', '110123161', 'Sinh viên'),
(4760, '110123257', '110123257', 'Sinh viên'),
(4761, '110123163', '110123163', 'Sinh viên'),
(4762, '110123168', '110123168', 'Sinh viên'),
(4763, '110123169', '110123169', 'Sinh viên'),
(4764, '110123170', '110123170', 'Sinh viên'),
(4765, '110123171', '110123171', 'Sinh viên'),
(4766, '110123172', '110123172', 'Sinh viên'),
(4767, '110123173', '110123173', 'Sinh viên'),
(4768, '110123174', '110123174', 'Sinh viên'),
(4769, '110123259', '110123259', 'Sinh viên'),
(4770, '110123256', '110123256', 'Sinh viên'),
(4771, '110123180', '110123180', 'Sinh viên'),
(4772, '110123181', '110123181', 'Sinh viên'),
(4773, '110123178', '110123178', 'Sinh viên'),
(4774, '110123185', '110123185', 'Sinh viên'),
(4775, '110123186', '110123186', 'Sinh viên'),
(4776, '110123187', '110123187', 'Sinh viên'),
(4777, '110123188', '110123188', 'Sinh viên'),
(4778, '110123191', '110123191', 'Sinh viên'),
(4779, '110123195', '110123195', 'Sinh viên'),
(4780, '110123197', '110123197', 'Sinh viên'),
(4781, '110123203', '110123203', 'Sinh viên'),
(4782, '110123204', '110123204', 'Sinh viên'),
(4783, '110120006', '110120006', 'Sinh viên'),
(4784, '110123261', '110123261', 'Sinh viên'),
(4785, '110120047', '110120047', 'Sinh viên'),
(4786, '110123264', '110123264', 'Sinh viên'),
(4787, '110123263', '110123263', 'Sinh viên'),
(4788, '110123154', '110123154', 'Sinh viên'),
(4789, '110123262', '110123262', 'Sinh viên'),
(4790, '110123155', '110123155', 'Sinh viên'),
(4791, '110123157', '110123157', 'Sinh viên'),
(4792, '110123159', '110123159', 'Sinh viên'),
(4793, '110123160', '110123160', 'Sinh viên'),
(4794, '110123162', '110123162', 'Sinh viên'),
(4795, '110123166', '110123166', 'Sinh viên'),
(4796, '110123167', '110123167', 'Sinh viên'),
(4797, '110123177', '110123177', 'Sinh viên'),
(4798, '110123179', '110123179', 'Sinh viên'),
(4799, '110123183', '110123183', 'Sinh viên'),
(4800, '110123184', '110123184', 'Sinh viên'),
(4801, '110123189', '110123189', 'Sinh viên'),
(4802, '110123192', '110123192', 'Sinh viên'),
(4803, '110123198', '110123198', 'Sinh viên'),
(4804, '110123201', '110123201', 'Sinh viên'),
(4805, '110123199', '110123199', 'Sinh viên'),
(4806, '110123205', '110123205', 'Sinh viên');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chi_tiet_so_len_lop`
--
ALTER TABLE `chi_tiet_so_len_lop`
  ADD PRIMARY KEY (`maCT`),
  ADD UNIQUE KEY `maPC` (`maPC`,`ngaylenlop`,`buoi`);

--
-- Chỉ mục cho bảng `don_vi`
--
ALTER TABLE `don_vi`
  ADD PRIMARY KEY (`madv`);

--
-- Chỉ mục cho bảng `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD PRIMARY KEY (`maGV`),
  ADD UNIQUE KEY `matk` (`matk`),
  ADD KEY `madv` (`madv`);

--
-- Chỉ mục cho bảng `hoc_ky`
--
ALTER TABLE `hoc_ky`
  ADD PRIMARY KEY (`maHK`);

--
-- Chỉ mục cho bảng `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`maMH`);

--
-- Chỉ mục cho bảng `nhommonhoc`
--
ALTER TABLE `nhommonhoc`
  ADD PRIMARY KEY (`manhom`,`maMH`),
  ADD KEY `maMH` (`maMH`);

--
-- Chỉ mục cho bảng `phan_cong`
--
ALTER TABLE `phan_cong`
  ADD PRIMARY KEY (`maPC`),
  ADD KEY `manhom` (`manhom`,`maMH`),
  ADD KEY `maGV` (`maGV`),
  ADD KEY `maHK` (`maHK`);

--
-- Chỉ mục cho bảng `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`maSV`,`manhom`,`maMH`,`toTH`),
  ADD KEY `manhom` (`manhom`,`maMH`),
  ADD KEY `matk` (`matk`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`matk`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chi_tiet_so_len_lop`
--
ALTER TABLE `chi_tiet_so_len_lop`
  MODIFY `maCT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `don_vi`
--
ALTER TABLE `don_vi`
  MODIFY `madv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT cho bảng `phan_cong`
--
ALTER TABLE `phan_cong`
  MODIFY `maPC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=736;

--
-- AUTO_INCREMENT cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `matk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4807;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_so_len_lop`
--
ALTER TABLE `chi_tiet_so_len_lop`
  ADD CONSTRAINT `chi_tiet_so_len_lop_ibfk_1` FOREIGN KEY (`maPC`) REFERENCES `phan_cong` (`maPC`);

--
-- Các ràng buộc cho bảng `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD CONSTRAINT `giang_vien_ibfk_1` FOREIGN KEY (`matk`) REFERENCES `tai_khoan` (`matk`),
  ADD CONSTRAINT `giang_vien_ibfk_2` FOREIGN KEY (`madv`) REFERENCES `don_vi` (`madv`);

--
-- Các ràng buộc cho bảng `nhommonhoc`
--
ALTER TABLE `nhommonhoc`
  ADD CONSTRAINT `nhommonhoc_ibfk_1` FOREIGN KEY (`maMH`) REFERENCES `mon_hoc` (`maMH`);

--
-- Các ràng buộc cho bảng `phan_cong`
--
ALTER TABLE `phan_cong`
  ADD CONSTRAINT `phan_cong_ibfk_1` FOREIGN KEY (`manhom`,`maMH`) REFERENCES `nhommonhoc` (`manhom`, `maMH`),
  ADD CONSTRAINT `phan_cong_ibfk_2` FOREIGN KEY (`maGV`) REFERENCES `giang_vien` (`maGV`),
  ADD CONSTRAINT `phan_cong_ibfk_3` FOREIGN KEY (`maHK`) REFERENCES `hoc_ky` (`maHK`);

--
-- Các ràng buộc cho bảng `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD CONSTRAINT `sinh_vien_ibfk_1` FOREIGN KEY (`manhom`,`maMH`) REFERENCES `nhommonhoc` (`manhom`, `maMH`),
  ADD CONSTRAINT `sinh_vien_ibfk_2` FOREIGN KEY (`matk`) REFERENCES `tai_khoan` (`matk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
