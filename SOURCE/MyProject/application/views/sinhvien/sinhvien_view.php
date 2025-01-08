<div class="main-content">
    <div class="content">
        <h1 style="text-align: center;">DANH SÁCH MÔN HỌC</h1>




        <form method="get" action="<?= base_url('search_xnsv'); ?>" id="filterForm" style="margin-left:50px;">
    <div class="form-container-sv">
        <div class="form-group-sv">
            <label for="ma_hk">Học kỳ:</label>
            <select name="ma_hk" id="ma_hk" required class="select-import" style="width:140px;">
                <option value="">-- Chọn học kỳ --</option>
                <?php foreach ($hoc_ky as $hk): ?>
                    <option value="<?= htmlspecialchars($hk['maHK']); ?>" <?= isset($ma_hk) && $ma_hk == $hk['maHK'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($hk['tenHK'] . ' - ' . $hk['namhoc']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group-sv" style="margin-left:50px;">
            <label for="ma_mon">Môn học:</label>
            <select name="ma_mon" id="ma_mon" required class="select-import" style="width:200px;">
                <option value="">-- Chọn môn học --</option>
                <?php foreach ($ma_mon as $mh): ?>
                    <option value="<?= htmlspecialchars($mh['maMH']); ?>" <?= isset($ma_mon) && $ma_mon == $mh['maMH'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($mh['maMH'] . ' - ' . $mh['tenMH']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="search-kh" style="margin-bottom:-20px; margin-left: 400px;">
            <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?= isset($keyword) ? htmlspecialchars($keyword) : ''; ?>">
            <i class="fas fa-search"></i>
        </div>
    </div>
</form>
    </div>


    <table>
        <thead>
            <tr>
                <th>Học Kỳ</th>
                <th>Mã nhóm</th>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Tên lớp</th>
                <th>Tên giảng viên</th>

            </tr>
        </thead>
        <tbody>
            <?php if (!empty($phan_cong)): ?>
                <?php foreach ($phan_cong as $row): ?>
                    <tr onclick="location.href='<?php echo base_url('xacnhan_ctsll' . $row->maPC); ?>'">

                        <td><?= htmlspecialchars($row->tenHK . ' - ' . $row->namhoc) ?></td>
                        <td><?= htmlspecialchars($row->manhom) ?></td>
                        <td><?= htmlspecialchars($row->maMH) ?></td>
                        <td><?= htmlspecialchars($row->tenMH) ?></td>
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

    <?php if ($total_pages > 1): ?>
    <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Trang kế qua -->
                <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo base_url('pt_sv?page=' . ($current_page - 1)); ?>">
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
                        <a class="page-link" href="<?php echo base_url('pt_sv?page=' . $i); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>



                <!-- Trang tiếp -->
                <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link"
                        href="<?php echo base_url('pt_sv?page=' . ($current_page + 1)); ?>">>></a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
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