<div class="main-content">
    <div class="content">
        <h2>Quản lý nhóm môn học</h2>
        <button class="btn-add" onclick="location.href='<?php echo base_url('them_nhommonhoc'); ?>'"><i
                class="fas fa-plus"></i>
            Thêm mới</button>
        <div class="search">
            <form action="<?php echo base_url('phantrang_nhommonhoc'); ?>" method="GET" class="search">
                <input type="text" name="keyword" placeholder="Tìm kiếm...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Mã nhóm</th>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Tên lớp môn học</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($nhom_mon_hoc)): ?>
                    <?php foreach ($nhom_mon_hoc as $nhom): ?>
                        <tr>
                            <td><?php echo $nhom['manhom']; ?></td>
                            <td><?php echo $nhom['maMH']; ?></td>
                            <td><?php echo $nhom['TenMH']; ?></td>
                            <td><?php echo $nhom['tenlopmonhoc']; ?></td>
                            <td>
                            <button class="btn-edit"
    onclick="location.href='<?php echo base_url('sua_nhommonhoc' . $nhom['manhom'] . '/' . $nhom['maMH']); ?>'">
    <i class="fas fa-pencil-alt"></i>
</button>


                                <button class="btn-delete"
                                    onclick="if (confirm('Xóa nhóm môn học này: <?php echo $nhom['manhom'] . ' - ' . $nhom['tenlopmonhoc']; ?> ??')) { 
            window.location.href = '<?php echo base_url('xoa_nhommonhoc/' . $nhom['manhom'] . '/' . $nhom['maMH']); ?>'; }">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Trang kế qua -->
                <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link"
                        href="<?php echo base_url('phantrang_nhommonhoc?page=' . ($current_page - 1). (isset($keyword) ? '&keyword=' . urlencode($keyword) : '')); ?>">
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
                        <a class="page-link" href="<?php echo base_url('phantrang_nhommonhoc?page=' . $i. (isset($keyword) ? '&keyword=' . urlencode($keyword) : '')); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>



                <!-- Trang tiếp -->
                <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link"
                        href="<?php echo base_url('phantrang_nhommonhoc?page=' . ($current_page + 1). (isset($keyword) ? '&keyword=' . urlencode($keyword) : '')); ?>">>></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php if (isset($message) && isset($message_type)): ?>
    <div style="color: <?php echo $message_type === 'success' ? 'green' : 'red'; ?>; font-weight: bold;">
        <?php echo $message; ?>
    </div>
<?php endif; ?>