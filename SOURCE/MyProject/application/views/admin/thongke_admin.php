<div class="main-content">
    <div class="content">
        <h2 style=" text-align: center;">THỐNG KÊ SỐ TIẾT DẠY </h2>
        <form id="filterForm" action="<?= base_url('thongkeadmin'); ?>" method="post" style="margin-left:10px;"
            class="form-import">
           

            <div class="form-group-hk">
                <label for="search_term">Chọn năm học:</label>
                <select name="n" id="year_select" required class="select-import">
                    <option value="">-- Chọn năm học --</option>
                    <?php foreach ($namhoc as $nh): ?>
                        <option value="<?= $nh['namhoc']; ?>"><?= $nh['namhoc'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group-hk">
                <label for="search_term">Chọn Học Kỳ:</label>
                <select name="search_term" id="search_term" required class="select-import">
                    <option value="">-- Chọn Học Kỳ --</option>
                    <?php foreach ($hocKyResult as $hk): ?>
                        <option value="<?= $hk['maHK']; ?>"><?= $hk['tenHK'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group-dv">
                <label for="donvi">Chọn Đơn Vị:</label>
                <select name="donvi" id="donvi" required class="select-import">
                    <option value="">-- Chọn Đơn Vị --</option>
                    <?php foreach ($donvi as $dv): ?>
                        <option value="<?= $dv['madv']; ?>"><?= $dv['tendonvi'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form></br>


        <table border="1">
    <thead>
        <tr>
            <th>Mã GV</th>
            <th>Tên giảng viên</th>
            <th>Mã môn học</th>
            <th>Tên môn học</th>
            <th>Tên lớp</th>
            <th>Số tiết LT</th>
            <th>Số tiết TH</th>
            <th>Tổng số tiết (LT+TH)</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($thongke)): ?>
            <?php
            $currentGV = null; // Giữ mã giảng viên hiện tại
            $totalTietGV = 0;  // Tổng số tiết của giảng viên hiện tại

            foreach ($thongke as $row):
                // Nếu gặp giảng viên mới, hiển thị hàng tổng kết của giảng viên trước đó
                if ($currentGV !== null && $currentGV !== $row->maGV): ?>
                    <tr>
                        <td colspan="8" style="text-align: right; color: red; font-weight: bold; font-size: 20px;">
                            Tổng kết: <?= $totalTietGV ?> tiết
                        </td>
                    </tr>
                    <?php
                    $totalTietGV = 0; // Reset tổng số tiết cho giảng viên mới
                endif;

                // Cập nhật mã giảng viên hiện tại
                $currentGV = $row->maGV;

                // Cộng dồn tổng số tiết của giảng viên hiện tại
                $totalTietGV += $row->tong_sotiet;
                ?>

                <!-- Hiển thị thông tin môn học -->
                <tr>
                    <td><?= $row->maGV ?></td>
                    <td><?= $row->tenGV ?></td>
                    <td><?= $row->maMH ?></td>
                    <td><?= $row->tenMH ?></td>
                    <td><?= $row->tenlopmonhoc ?></td>
                    <td><?= $row->tong_sotietlt ?></td>
                    <td><?= $row->tong_sotietth ?></td>
                    <td><?= $row->tong_sotiet ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Hiển thị hàng tổng kết cho giảng viên cuối cùng -->
            <?php if ($currentGV !== null): ?>
                <tr>
                    <td colspan="8" style="text-align: right; color: red; font-weight: bold; font-size: 20px;">
                        Tổng kết: <?= $totalTietGV ?> tiết
                    </td>
                </tr>
            <?php endif; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" style="text-align: center;">Không có dữ liệu để hiển thị</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Trang kế qua -->
                <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo base_url('pt_thongke?page=' . ($current_page - 1)); ?>">
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
                        <a class="page-link" href="<?php echo base_url('pt_thongke?page=' . $i); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>



                <!-- Trang tiếp -->
                <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo base_url('pt_thongke?page=' . ($current_page + 1)); ?>">>></a>
                </li>
            </ul>
        </nav>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterForm = document.getElementById('filterForm');
        const searchTerm = document.getElementById('search_term');
        const yearSelect = document.getElementById('year_select');
        const donviSelect = document.getElementById('donvi');

        // Function to submit the form
        function submitForm() {
            filterForm.submit();
        }

        // Add event listeners for Enter key
        searchTerm.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent default form submission
                submitForm();
            }
        });

        yearSelect.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent default form submission
                submitForm();
            }
        });
        donviSelect.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent default form submission
                submitForm();
            }
        });
    });
</script>