<div class="main-content">
    <di class="content">
        <h2>Quản lý sinh viên</h2>

        <form method="get" action="<?= base_url('search_sinhvien'); ?>" id="filterForm">
            <div class="form-container-sv">
                <?php
                // Lấy danh sách nhóm môn học từ cơ sở dữ liệu (đã được truy vấn và gán vào biến $nhommonhoc)
                $uniqueGroups = []; // Mảng lưu giữ mã nhóm không trùng
                foreach ($nhommonhoc as $nhom) {
                    if (!in_array($nhom['manhom'], $uniqueGroups)) {
                        $uniqueGroups[] = $nhom['manhom'];
                    }
                }
                ?>

                <div class="form-group-sv">
                    <label for="ma_nhom">Nhóm:</label>
                    <select name="ma_nhom" id="ma_nhom" required class="select-import" style="width:120px;">
                        <option value="">-- Chọn nhóm --</option>
                        <?php foreach ($uniqueGroups as $manhom): ?>
                            <option value="<?= htmlspecialchars($manhom); ?>">
                                <?= htmlspecialchars($manhom); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group-sv">
                    <label for="ma_mon">Môn học:</label>
                    <select name="ma_mon" id="ma_mon" required class="select-import" style="width:100px;">
                        <option value="">-- Chọn môn học --</option>
                        <?php foreach ($nhommonhoc as $nhom): ?>
                            <option value="<?= htmlspecialchars($nhom['maMH']); ?>">
                                <?= htmlspecialchars($nhom['maMH'] . ' - ' . $nhom['TenMH']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group-sv">
                    <label for="to_th">Tổ TH:</label>
                    <select name="to_th" id="to_th" required class="select-import" style="width:140px;">
                        <option value="">-- Chọn tổ thực hành --</option>
                        <option value="01">Tổ thực hành 01</option>
                        <option value="02">Tổ thực hành 02</option>
                        <option value="03">Tổ thực hành 03</option>
                    </select>
                </div>

                <div class="search-kh" style="margin-bottom:-20px; margin-left: 50px;">

                    <input type="text" name="keyword" placeholder="Tìm kiếm..."
                        value="<?= isset($keyword) ? htmlspecialchars($keyword) : '' ?>">
                    <i class="fas fa-search"></i>

                </div>
        </form>




</div>

<table>
    <thead>
        <tr>
            <th>Mã sinh viên</th>
            <th>Họ lót</th>
            <th>Tên sinh viên</th>
            <th>Mã nhóm</th>
            <th>Mã môn học</th>
            <th>Tổ học</th>
            <th>Mã lớp</th>
            <th>Tên lớp</th>
            <th>Số điện thoại</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($sinh_vien)): ?>
            <?php foreach ($sinh_vien as $sv): ?>
                <tr>
                    <td><?php echo $sv['maSV']; ?></td>
                    <td><?php echo $sv['holot']; ?></td>
                    <td><?php echo $sv['tenSV']; ?></td>
                    <td><?php echo $sv['manhom']; ?></td>
                    <td><?php echo $sv['maMH']; ?></td>
                    <td><?php echo $sv['toTH']; ?></td>
                    <td><?php echo $sv['malop']; ?></td>
                    <td><?php echo $sv['tenlop']; ?></td>
                    <td><?php echo $sv['sdt']; ?></td>
                    <!-- <td>
                                <button class="btn-edit"
                                    onclick="location.href='<?php echo base_url('sua_sinhvien/' . $sv['maSV']); ?>'">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-delete"
                                    onclick="if (confirm('Xóa sinh viên này: <?php echo $sv['maSV'] . ' - ' . $sv['tenSV']; ?> ??')) { window.location.href = '<?php echo base_url('xoa_sinhvien/' . $sv['maSV']); ?>'; }">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>//
                        </tr> -->
                <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="10">Không có dữ liệu</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $to_th = isset($_GET['to_th']) ? $_GET['to_th'] : '';?>
<nav aria-label="Page navigation">
    <ul class="pagination">
        <!-- Trang kế qua -->
        <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="<?php echo base_url('phantrang_sv?page=' . ($current_page - 1) . (isset($keyword) ? '&keyword=' . urlencode($keyword) : '') . (isset($ma_nhom) ? '&ma_nhom=' . urlencode($ma_nhom) : '') . (isset($ma_mon) ? '&ma_mon=' . urlencode($ma_mon) : '') . (isset($to_th) ? '&to_th=' . urlencode($to_th) : '')); ?>">
                <<</a>
        </li>

        <?php
        $start = 1;
        $end = $total_pages;

        // Xác định số trang liền kề trước và sau trang hiện tại
        if ($current_page > 2) {
            $start = $current_page - 1;
        }
        if ($current_page < $total_pages - 1) {
            $end = $current_page + 1;
        }

        for ($i = $start; $i <= $end; $i++): ?>
            <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo base_url('phantrang_sv?page=' . $i . (isset($keyword) ? '&keyword=' . urlencode($keyword) : '') . (isset($ma_nhom) ? '&ma_nhom=' . urlencode($ma_nhom) : '') . (isset($ma_mon) ? '&ma_mon=' . urlencode($ma_mon) : '') . (isset($to_th) ? '&to_th=' . urlencode($to_th) : '')); ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Trang tiếp -->
        <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="<?php echo base_url('phantrang_sv?page=' . ($current_page + 1) . (isset($keyword) ? '&keyword=' . urlencode($keyword) : '') . (isset($ma_nhom) ? '&ma_nhom=' . urlencode($ma_nhom) : '') . (isset($ma_mon) ? '&ma_mon=' . urlencode($ma_mon) : '') . (isset($to_th) ? '&to_th=' . urlencode($to_th) : '')); ?>">>></a>
        </li>
    </ul>
</nav>


<script>
        document.getElementById('to_th').addEventListener('change', function () {
        const selectedValue = this.value;
        const url = new URL(window.location.href);

        // Cập nhật giá trị `to_th`
        if (selectedValue) {
            url.searchParams.set('to_th', selectedValue);
        } else {
            url.searchParams.delete('to_th'); // Xóa nếu không chọn gì
        }

        // Điều hướng đến URL mới
        window.location.href = url.toString();
    });
</script>
</div>
</div>

<script>
    document.getElementById('filterForm').addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Ngăn chặn hành động mặc định
            this.submit(); // Gửi form
        }
    });


</script>