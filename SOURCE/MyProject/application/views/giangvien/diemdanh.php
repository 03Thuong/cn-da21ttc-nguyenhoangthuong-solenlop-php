<div class="main-content">
    <di class="content">
        <h2>Danh sách sinh viên</h2>

        <form method="get" action="<?= base_url('search_dd' . $maCT); ?>" id="filterForm">
            <div class="form-container-sv">

                <div class="form-group-sv">

                    <label for="to_th">Chọn tổ thực hành:</label>
                    <select name="to_th" id="to_th" required class="select-import" style="width:170px;">
                        <option value="">-- Chọn tổ thực hành --</option>
                        <option value="01">Tổ thực hành 01</option>
                        <option value="02">Tổ thực hành 02</option>
                        <option value="03">Tổ thực hành 03</option>
                    </select>
                </div>

                <div class="search-kh" style="margin-bottom:-180px; margin-left: 700px;">

                    <input type="text" name="keyword" placeholder="Tìm kiếm..."
                        value="<?= isset($keyword) ? htmlspecialchars($keyword) : '' ?>">
                    <i class="fas fa-search"></i>

                </div>
        </form>





</div>
<form method="post" action="<?php echo site_url('ctsllController/save'); ?>">
    <button class="btn-add" onclick="location.href=''" style="margin-top:20px;">
        <i class="fas fa-file"></i> Lưu </button>

        <button type="button" class="btn-add" onclick="redirectTosolenlop(<?php echo htmlspecialchars($maPC); ?>);" style="background-color: red;">
                <i class="fa fa-times"></i> Thoát
            </button>
    <input type="hidden" name="maCT" value="<?php echo $maCT; ?>">
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
                <th>Vắng mặt</th>
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

                        <td>
                            <input type="checkbox" name="vang[]"
                                value="<?php echo $sv['maSV'] . '-' . $sv['holot'] . ' ' . $sv['tenSV']; ?>">
                            <label for="diemdanh" id=""></label>
                        </td>

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
</form>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <!-- Trang trước -->
        <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="<?php echo base_url('diemdanh' . $maCT . '?page=' . ($current_page - 1)); ?>">
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
                <a class="page-link" href="<?php echo base_url('diemdanh' . $maCT . '?page=' . $i); ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Trang tiếp -->
        <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
            <a class="page-link"
                href="<?php echo base_url('diemdanh' . $maCT . '?page=' . ($current_page + 1)); ?>">>></a>
        </li>
    </ul>
</nav>




</div>
</div>

<script>
    document.getElementById('filterForm').addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Ngăn chặn hành động mặc định
            this.submit(); // Gửi form
        }
    });

    function redirectTosolenlop($maPC) {
    window.location.href = 'ctsll' + $maPC; // Redirects to the URL with the maPC parameter
}


</script>