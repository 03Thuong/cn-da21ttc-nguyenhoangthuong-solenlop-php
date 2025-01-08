<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Thêm mới tài khoản</h2>
            <form action="<?php echo base_url('save_taikhoan'); ?>" method="POST" class="add-form">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>

                <label for="matkhau">Mật khẩu:</label>
                <input type="password" id="matkhau" name="matkhau" placeholder="Nhập mật khẩu" required>

                <label for="quyen">Quyền:</label>
                <select id="quyen" name="quyen" required>
                    <option value="" disabled selected>Chọn quyền</option>
                    <option value="Giảng viên">Giảng viên</option>
                    <option value="Sinh viên">Sinh viên</option>
                    <option value="Admin">Admin</option>
                </select>

                <div class="form-actions">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>




        </div>
    </div>

</div>
<?php if ($this->session->flashdata('error')): ?>
                <script>
                    alert('<?= $this->session->flashdata('error') ?>');
                </script>
            <?php endif; ?>