<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sổ Lên Lớp</title>
    <link rel="stylesheet" href="frontend/css/add_ct_sll.css">
    <link rel="stylesheet" href="frontend/css/home_gv.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="frontend/image/logo.png" alt="Logo">
                <h2>HỆ THỐNG QUẢN LÝ SỔ LÊN LỚP</h2>
            </div>
            <div class="user-info">
                <!-- Thanh tìm kiếm -->

                <i class="fa fa-user"></i>
                    <p><?php echo htmlspecialchars($username); ?></p>
                <a href="<?= base_url('dangxuat'); ?>" class="logout">
                    <span><i class="fa fa-sign-out-alt"></i> Đăng xuất</span>
                </a>

            </div>
        </div>

        <div class="menu">
            <a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> TRANG CHỦ</a>
            <a href="<?= base_url('lichdaygv') ?>"><i class="fas fa-file-alt"></i> DANH SÁCH LỊCH DẠY</a>
            <a href="<?= base_url('thongtintk') ?>"><i class="fa fa-user"></i> THÔNG TIN TÀI KHOẢN</a>
            <a href="<?= base_url('doimatkhau') ?>"><i class="fa fa-key"></i> ĐỔI MẬT KHẨU</a>
            <a href="<?= base_url('quanlysinhvien_gv') ?>"><i class="fa fa-user"></i> QUẢN LÝ SINH VIÊN</a>
            <a href="<?= base_url('thongke') ?>"><i class="fa fa-chart-bar"></i> THỐNG KÊ</a>
        </div>

        <div class="main"></div>