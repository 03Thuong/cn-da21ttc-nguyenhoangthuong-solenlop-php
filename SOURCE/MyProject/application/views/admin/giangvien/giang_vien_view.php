<div class="main-content">
    <div class="content">
        <h2>Quản lý giảng viên</h2>
        <button class="btn-add" onclick="location.href='<?php echo base_url('them_gv'); ?>'"><i class="fas fa-plus"></i>
            Thêm mới</button>
        <div class="search">
            <form action="<?php echo base_url('search_giangvien'); ?>" method="GET" class="search">
                <input type="text" name="keyword" placeholder="Tìm kiếm...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Mã giảng viên</th>
                    <th>Tên giảng viên</th>
                    <th>Tên đơn vị</th>
                    <th>Mã tài khoản</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($giang_vien)): ?>
                    <?php foreach ($giang_vien as $gv): ?>
                        <tr>
                            <td><?php echo $gv['maGV']; ?></td>
                            <td><?php echo $gv['tenGV']; ?></td>
                            <td><?php echo $gv['tendonvi']; ?></td>
                            <td><?php echo $gv['matk']; ?></td>
                            <td>
                                <button class="btn-edit"
                                    onclick="location.href='<?php echo base_url('sua_giangvien' . $gv['maGV']); ?>'">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-delete"
                                    onclick="if (confirm('Xóa giảng viên này: <?php echo $gv['maGV'] . ' - ' . $gv['tenGV']; ?> ??')) { window.location.href = '<?php echo base_url('xoa_giangvien/' . $gv['maGV']); ?>'; }">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Trang kế qua -->
                <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo base_url('phantrang_gv?page=' . ($current_page - 1)); ?>">
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
                        <a class="page-link" href="<?php echo base_url('phantrang_gv?page=' . $i); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>



                <!-- Trang tiếp -->
                <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link"
                        href="<?php echo base_url('phantrang_gv?page=' . ($current_page + 1)); ?>">>></a>
                </li>
            </ul>
        </nav>
    </div>
</div>