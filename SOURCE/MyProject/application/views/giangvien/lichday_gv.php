<div class="main-content">
    <div class="content">
        <h1 style="text-align: center;">Quản lý kế hoạch giảng dạy</h1>

    <form method="post" action="<?= base_url('timkiem_ld'); ?>" id="filterForm">
    <div class="form-group-hk">
        <label for="search_term">Chọn Học Kỳ:</label>
        <select name="search_term" id="search_term" required class="select-import" onchange="document.getElementById('filterForm').submit();">
            <option value="">-- Chọn Học Kỳ --</option>
            <?php foreach ($hocKyResult as $hk): ?>
                <option value="<?= $hk['maHK']; ?>"><?= $hk['tenHK'] . ' (' . $hk['namhoc'] . ')' ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</form>
 <div class="search-kh">
            <form action="<?= base_url('timkiem_ld'); ?>" method="post" class="search-kh">
                <input type="text" name="search_term" placeholder="Tìm kiếm theo tên môn hoặc tên giảng viên...">
                <i class="fas fa-search"></i>
            </form>
           
        </div>

    </div>



    <table>
        <thead>
            <tr>
                <th>Mã phân công</th>
                <th>Học Kỳ</th>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Tổng số tiết</th>
                <th>Số tín chỉ</th>
                <th>Tên lớp</th>
                <th>Tên giảng viên</th>

            </tr>
        </thead>
        <tbody>
            <?php if (!empty($phan_cong)): ?>
                <?php foreach ($phan_cong as $row): ?>
                    <tr onclick="location.href='<?php echo base_url('ctsll'.$row->maPC);?>'">
                        <td><?= htmlspecialchars($row->maPC) ?></td>
                        <td><?= htmlspecialchars($row->tenHK . ' - ' . $row->namhoc) ?></td>
                        <td><?= htmlspecialchars($row->maMH) ?></td>
                        <td><?= htmlspecialchars($row->tenMH) ?></td>
                        <td><?= htmlspecialchars($row->tongsotiet) ?></td>
                        <td><?= htmlspecialchars($row->SoTC) ?></td>
                        <td><?= htmlspecialchars($row->tenlopmonhoc) ?></td>
                        <td><?= htmlspecialchars($row->tenGV) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Không có dữ liệu để hiển thị</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>


    <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Trang kế qua -->
                <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo base_url('phantrang_ld?page=' . ($current_page - 1)); ?>">
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
                        <a class="page-link" href="<?php echo base_url('phantrang_ld?page=' . $i); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>



                <!-- Trang tiếp -->
                <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link"
                        href="<?php echo base_url('phantrang_ld?page=' . ($current_page + 1)); ?>">>></a>
                </li>
            </ul>
        </nav>


</div>
</div>

<script>
    document.getElementById('filterForm').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Ngăn chặn hành động mặc định
            this.submit(); // Gửi form
        }
    });
</script>