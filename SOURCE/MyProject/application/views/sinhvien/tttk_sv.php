

<div class="account-info" style="width:1200px;">
            <h2>Thông Tin Tài Khoản Sinh Viên</h2>
            <table>
            <thead>
                <tr>
                    <th>Mã sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Mã lớp</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Tên tài khoản</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinh_vien)): ?>
                    <?php foreach ($sinh_vien as $sv): ?>
                        <tr>
                            <td><?php echo $sv['maSV']; ?></td>
                            <td><?php echo $sv['holot'] . ' ' . $sv['tenSV']; ?></td>
                            <td><?php echo $sv['malop']; ?></td>
                            <td><?php echo $sv['sdt']; ?></td>
                            <td><?php echo $sv['email']; ?></td>
                            <td><?php echo $sv['username']; ?></td>
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

