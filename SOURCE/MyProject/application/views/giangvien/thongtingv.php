

        <div class="account-info">
            <h2>Thông Tin Tài Khoản Giảng Viên</h2>
            <table>
            <thead>
                <tr>
                    <th>Mã giảng viên</th>
                    <th>Tên giảng viên</th>
                    <th>Tên đơn vị</th>
                    <th>Mã tài khoản</th>
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
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            </table>
        </div>

