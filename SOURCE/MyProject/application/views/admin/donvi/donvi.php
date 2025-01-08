<div class="main-content">
    <div class="content">
        <h2>Quản lý đơn vị</h2>
        <button class="btn-add" onclick="location.href='<?php echo base_url('them_donvi'); ?>'">
            <i class="fas fa-plus"></i> Thêm mới
        </button>
        <div class="search">
            <form action="<?php echo base_url('search_dv'); ?>" method="GET" class="search">
                <input type="text" name="keyword" placeholder="Tìm kiếm...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn vị</th>
                    <th>Tên đơn vị</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($don_vi)): ?>
                    <?php foreach ($don_vi as $dv): ?>
                        <tr>
                            <td><?php echo $dv['madv']; ?></td>
                            <td><?php echo $dv['tendonvi']; ?></td>
                            <td>
                                <button class="btn-edit"
                                    onclick="location.href='<?php echo base_url('sua_donvi' . $dv['madv']); ?>'">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-delete"
                                    onclick="if (confirm('Xóa đơn vị này: <?php echo $dv['tendonvi']; ?> ??')) { window.location.href = '<?php echo base_url('xoa_donvi/' . $dv['madv']); ?>'; }">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Trang kế qua -->
                <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo base_url('phantrang_dv?page=' . ($current_page - 1)); ?>">
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
                        <a class="page-link" href="<?php echo base_url('phantrang_dv?page=' . $i); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- Trang tiếp -->
                <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link"
                        href="<?php echo base_url('phantrang_dv?page=' . ($current_page + 1)); ?>">>></a>
                </li>
            </ul>
        </nav>
    </div>
</div>