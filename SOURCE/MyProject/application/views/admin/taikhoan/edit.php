<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Sửa thông tin tài khoản</h2>
            <form action="<?php echo base_url('save_update_tk/' . $tai_khoan['matk']); ?>" method="POST" class="add-form">
                <label for="matk">Mã tài khoản:</label>
                <input type="text" id="matk" name="matk" value="<?php echo $tai_khoan['matk']; ?>" readonly>

                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" value="<?php echo $tai_khoan['username']; ?>" placeholder="Nhập tên đăng nhập" required>

                <label for="matkhau">Mật khẩu:</label>
                <input type="password" id="matkhau" name="matkhau" value="<?php echo $tai_khoan['matkhau']; ?>" placeholder="Nhập mật khẩu" required>

                <label for="quyen">Quyền:</label>
                <select id="quyen" name="quyen" required>
                    <option value="Giảng viên" <?php echo ($tai_khoan['quyen'] == 'Giảng viên') ? 'selected' : ''; ?>>Giảng viên</option>
                    <option value="Sinh viên" <?php echo ($tai_khoan['quyen'] == 'Sinh viên') ? 'selected' : ''; ?>>Sinh viên</option>
                    <option value="Admin" <?php echo ($tai_khoan['quyen'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                </select>

                <div class="form-actions">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>