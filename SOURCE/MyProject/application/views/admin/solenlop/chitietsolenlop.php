<!-- Main Content -->
<div class="main-content">
    <div class="content">
        <h3 style="text-align: center;">BẢNG TÓM TÁT NỘI DUNG GIẢNG DẠY HỌC KỲ: <?php echo $info['maHK']; ?> - NĂM HỌC: <?php echo $info['namhoc']; ?></h3><br>
        <form action="#" method="POST" class="form-sll">
                        <!-- Cột bên trái -->
                        <div class="column">
                            <div>
                                <label for="ma-gv">Mã giảng viên:</label>
                                <input type="text" id="ma-gv" name="ma-gv" class="width-small" value="<?php echo $info['maGV']; ?>" >
                            </div>
                            <div>
                                <label for="ma-mon">Mã môn:</label>
                                <input type="text" id="ma-mon" name="ma-mon" class="width-small" value="<?php echo $info['maMH']; ?>">
                            </div>
                            <div>
                                <label for="ma-nhom">Mã nhóm:</label>
                                <input type="text" id="ma-nhom" name="ma-nhom" class="width-small" value="<?php echo $info['manhom']; ?>">
                            </div>
                        </div>
                    
                        <!-- Cột bên phải -->
                        <div class="column">
                            <div>
                                <label for="ten-gv">Tên giảng viên:</label>
                                <input type="text" id="ten-gv" name="ten-gv" class="width-large" value="<?php echo $info['tenGV']; ?>">
                            </div>
                            <div>
                                <label for="ten-mon">Tên môn:</label>
                                <input type="text" id="ten-mon" name="ten-mon" class="width-large" value="<?php echo $info['tenMH']; ?>">
                            </div>
                            <div>
                                <label for="ma-lop">Mã lớp:</label>
                                <input type="text" id="ma-lop" name="ma-lop" class="width-large" value="<?php echo $info['tenlopmonhoc']; ?>">
                            </div>
                        </div>
                    </form>

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
                        <th>Chức năng</th>
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
                                <td><?php echo $row->tenGV; ?></td>
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

                                <td>
                                    <button class="btn-delete"
                                        onclick="location.href='<?php echo base_url('update_chitietsll/' . $row->maCT); ?>'">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
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

                <button type="button" class="btn-exit" onclick="redirectToQuanLyPhanCong();">
                    <i class="fa fa-times"></i> Thoát
                </button>

                <script>
                    function redirectToQuanLyPhanCong() {
                        window.location.href = 'quanlyphancong'; // Adjust the URL if needed
                    }
                </script>
            </div>
    </div>
</div>