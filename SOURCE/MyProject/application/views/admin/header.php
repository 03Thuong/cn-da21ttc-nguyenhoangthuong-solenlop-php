<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Sổ Lên Lớp Điện Tử</title>
    <link rel="stylesheet" href="frontend/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="frontend/image/logo.png" alt="Logo">
                <h2>Hệ thống quản lý sổ lên lớp</h2>
            </div>
            <div class="actions">
                <a href="<?= base_url('doimatkhau') ?>"><i class="fa fa-key"></i> Đổi mật khẩu</a>
                <a href="<?= base_url('dangxuat') ?>"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </div>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-info">
                    <div class="user-icon">
                        <img src="frontend/image/user.png" alt="Logo">
                    </div>
                    <!-- Trong view giang_vien_view.php -->
                    <p><?php echo htmlspecialchars($username); ?></p>
                </div>
                <ul class="menu">
                    <li id="menu-giangvien">
                        <a href="<?= base_url('quanlygiangvien') ?>">
                            <i class="fas fa-chalkboard-teacher"></i> QUẢN LÝ GIẢNG VIÊN
                        </a>
                    </li>
                    <li id="menu-monhoc">
                        <a href="<?= base_url('quanlymonhoc') ?>">
                            <i class="fas fa-book-open"></i> QUẢN LÝ MÔN HỌC
                        </a>
                    </li>

                    <li id="menu-nhom">
                        <a href="<?= base_url('quanlynhommonhoc') ?>">
                            <i class="fas fa-users"></i> QUẢN LÝ NHÓM MÔN HỌC
                        </a>
                    </li>

                    <li id="menu-sll">
                        <a href="<?= base_url('quanlyphancong') ?>">
                            <i class="fas fa-calendar-check"></i> QUẢN LÝ KẾ HOẠCH DẠY
                        </a>
                    </li>
                    <li id="menu-hocky">
                        <a href="<?= base_url('quanlyhocky') ?>">
                            <i class="fas fa-calendar-alt"></i> QUẢN LÝ HỌC KỲ
                        </a>
                    </li>
                    <li id="menu-sinhvien">
                        <a href="<?= base_url('quanlysinhvien') ?>">
                            <i class="fas fa-graduation-cap"></i> QUẢN LÝ SINH VIÊN
                        </a>
                    </li>
                    <li id="menu-taikhoan">
                        <a href="<?= base_url('quanlytaikhoan') ?>">
                            <i class="fas fa-user"></i>
                            QUẢN LÝ TÀI KHOẢN

                        </a>
                    </li>
                    <li id="menu-donvi">
                        <a href="<?= base_url('quanlydonvi') ?>">
                            <i class="fas fa-building"></i> <!-- Icon cho đơn vị -->
                            QUẢN LÝ ĐƠN VỊ
                        </a>
                    </li>

                    <li id="menu-donvi">
                        <a href="<?= base_url('thongkeadmin') ?>">
                            <i class="fa fa-chart-bar"></i> <!-- Icon cho đơn vị -->
                            THỐNG KẾ SỐ TIẾT DẠY
                        </a>
                    </li>

                </ul>
            </div>