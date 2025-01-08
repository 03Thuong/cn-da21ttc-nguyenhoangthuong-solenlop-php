<!-- Main Content -->
<div class="main-content">
    <div class="content">



        <h3 style="text-align: center;">BẢNG TÓM TÁT NỘI DUNG GIẢNG DẠY HỌC KỲ: <?php echo $info['maHK']; ?> - NĂM HỌC:
            <?php echo $info['namhoc']; ?>
        </h3><br>
        <form action="#" method="POST" class="form-sll">
            <!-- Cột bên trái -->
            <div class="column">
                <div>
                    <label for="ma-gv">Mã giảng viên:</label>
                    <input type="text" id="ma-gv" name="ma-gv" class="width-small" value="<?php echo $info['maGV']; ?>" readonly>

                </div>
                <div>
                    <label for="ma-mon">Mã môn:</label>
                    <input type="text" id="ma-mon" name="ma-mon" class="width-small"
                        value="<?php echo $info['maMH']; ?>" readonly>
                </div>
                <div>
                    <label for="ma-nhom">Mã nhóm:</label>
                    <input type="text" id="ma-nhom" name="ma-nhom" class="width-small"
                        value="<?php echo $info['manhom']; ?>" readonly>
                </div>
                <div>
                    <label for="ma-nhom">Tổng số tiết:</label>
                    <input type="text" id="ma-nhom" name="ma-nhom" class="width-small"
                        value="<?php echo $info['tongsotiet']; ?>" readonly>
                </div>
                <input type="hidden" value="<?php echo $info['maPC']; ?>" >
            </div>

            <!-- Cột bên phải -->
            <div class="column">
                <div>
                    <label for="ten-gv">Tên giảng viên:</label>
                    <input type="text" id="ten-gv" name="ten-gv" class="width-large"
                        value="<?php echo $info['tenGV']; ?>"readonly>
                </div>
                <div>
                    <label for="ten-mon">Tên môn:</label>
                    <input type="text" id="ten-mon" name="ten-mon" class="width-large"
                        value="<?php echo $info['tenMH']; ?>"readonly>
                </div>
                
                <div>
                    <label for="ma-lop">Mã lớp:</label>
                    <input type="text" id="ma-lop" name="ma-lop" class="width-large"
                        value="<?php echo $info['tenlopmonhoc']; ?>"readonly>
                </div>
                <div>
                    <label for="ma-lop">Tên đơn vị:</label>
                    <input type="text" id="ma-lop" name="ma-lop" class="width-large"
                        value="<?php echo $info['tendonvi']; ?>"readonly>
                </div>
            </div>
        </form>
        <?php if ($this->session->userdata('role') !== 'Sinh viên'): ?>
            <div class="btn-container">
                <button class="btn-add-ct" onclick="location.href='<?php echo base_url('them_ctsll' . $info['maPC']); ?>'">
                    <i class="fas fa-file"></i> Ghi sổ lên lớp mới</button>

                <form action="<?php echo base_url('ctsllController/exportPDF/' . $info['maPC']); ?>" method="POST">
                    <button type="submit" class="btn-export" style="background-color: orange;">
                        <i class="fas fa-file-excel"></i> Xuất PDF
                    </button>
                </form>
            </div>
        <?php endif; ?>


        <table class="attendance-table">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Phòng</th>
                    <th>Buổi</th>
                    <th>Số tiết LT</th>
                    <th>Số tiết TH</th>
                    <th>Tóm tắt nội dung</th>
                    <th>Tên SV vắng</th>
                    <th>Xác nhận GV</th>
                    <th>Xác nhận SV</th>
                    <?php if ($this->session->userdata('role') !== 'Sinh viên'): ?>
                        <th>Chức năng</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($chi_tiet_so_len_lop)): ?>
                    <?php foreach ($chi_tiet_so_len_lop as $row): ?>
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($row->ngaylenlop)); ?></td>
                            <td><?php echo $row->phonghoc; ?></td>
                            <td><?php echo $row->buoi; ?></td>
                            <td><?php echo $row->sotietlt; ?></td>
                            <td><?php echo $row->sotietth; ?></td>
                            <td><?php echo $row->tomtatnoidung; ?></td>
                            <td>
                                <?php
                                // Replace new line characters with <br> tags for HTML display
                                echo nl2br(htmlspecialchars($row->tenSV_vang));
                                ?>
                            </td>

                            <td>
                                <?php
                                if (!empty($row->xacnhangv)) {
                                    if (filter_var($row->xacnhangv, FILTER_VALIDATE_URL)) {
                                        echo '<img src="' . $row->xacnhangv . '" alt="Đã xác nhận" width="50" height="50">';
                                    } elseif (file_exists('./uploads/' . $row->xacnhangv)) {
                                        echo '<img src="' . base_url('uploads/' . $row->xacnhangv) . '" alt="Đã xác nhận" width="50" height="50">';
                                    } else {
                                        echo '<p class="no-confirmation">Chưa xác nhận</p>';
                                    }
                                } else {
                                    echo '<p class="no-confirmation">Chưa xác nhận</p>';
                                }
                                ?>
                            </td>

                            <td>
            <?php if (!empty($row->xacnhansv)): ?>
                <span><?php echo $row->xacnhansv; ?></span>
            <?php else: ?>
                <form action="<?php echo site_url('updatexacnhan' . $info['maPC']); ?>" method="post" id="myForm">
                    <input type="checkbox" name="maCT" value="<?php echo $row->maCT; ?>" 
                        <?php echo ($this->session->userdata('role') === 'Sinh viên') ? '' : 'disabled'; ?>
                        onkeydown="handleEnter(event)">
                    <span class="text-muted">Chưa xác nhận</span> <!-- Thêm thông báo "Chưa xác nhận" -->
                </form>
            <?php endif; ?>
        </td>
                            <script>
                                function handleEnter(event) {
                                    if (event.key === 'Enter') {
                                        event.preventDefault(); // Ngăn chặn hành vi mặc định của nút Enter
                                        const form = document.getElementById('myForm');
                                        form.submit(); // Submit form
                                        return false; // Tránh các hành vi không mong muốn khác
                                    }
                                    return true;
                                }
                            </script>

                            <?php if ($this->session->userdata('role') !== 'Sinh viên'): ?>
                                <td>
                                    <button class="btn-edit"
                                        onclick="location.href='<?php echo base_url('sua_ctsll' . $row->maCT); ?>'">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn-delete"
                                        onclick="location.href='<?php echo base_url('xoa_ctsll' . $row->maCT . '/' . $row->maPC); ?>'">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="btn-attendance"
                                        onclick="location.href='<?php echo base_url('diemdanh' . $row->maCT); ?>'"><i
                                            class="fa fa-check"></i> Điểm danh</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Không có dữ liệu để hiển thị</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Tổng kết -->
        <h2 class="summary-title">
            <i class="fas fa-clipboard-list"></i> Tổng kết
        </h2>
        <div class="summary">
            <table class="summary-table">
                <thead>
                    <tr>
                        <th>Buổi</th>
                        <th>Lý thuyết</th>
                        <th>Thực hành</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $totals['total_sessions']; ?></td>
                        <td><?php echo $totals['total_theory']; ?></td>
                        <td><?php echo $totals['total_practice']; ?></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn-exit" onclick="redirectTosolenlop();">
                <i class="fa fa-times"></i> Thoát
            </button>

            <script>
                function redirectTosolenlop() {
                    // Lấy URL từ PHP dựa trên role
                    const url = '<?php
                    if ($this->session->userdata("role") === "Admin") {
                        echo "quanlysinhvien";
                    } elseif ($this->session->userdata("role") === "Giảng viên") {
                        echo "lichdaygv";
                    } else {
                        echo "xacnhansv";
                    }
                    ?>';
                window.location.href = url;
                }

                function updateLabel(checkbox) {
                    const label = document.getElementById('label-' + checkbox.id);
                    if (checkbox.checked) {
                        label.textContent = 'Đã xác nhận';
                    } else {
                        label.textContent = 'Chưa xác nhận';
                    }
                }



            </script>
                        <?php if ($this->session->flashdata('message')): ?>
                <script>
                    alert('<?php echo $this->session->flashdata('message'); ?>');
                </script>
            <?php endif; ?>

        </div>
    </div>
</div>