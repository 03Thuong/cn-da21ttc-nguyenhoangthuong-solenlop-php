<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Thêm mới học kỳ</h2>
            <form action="<?php echo base_url('save_hk'); ?>" method="POST" class="add-form">
                <label for="maHK">Mã học kỳ:</label>
                <input type="text" id="maHK" name="maHK" placeholder="Nhập mã học kỳ" required>

                <label for="tenHK">Tên học kỳ:</label>
                <input type="text" id="tenHK" name="tenHK" placeholder="Nhập tên học kỳ" required>

                <label for="namhoc">Năm học:</label>
                <input type="text" id="namhoc" name="namhoc" placeholder="Nhập năm học" required>

                <div class="form-actions">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
            <?php
            $message = '';
            if (isset($error) && $error != '') {
                $message = $error;
            } elseif (isset($success) && $success != '') {
                $message = $success;
            }
            ?>

            <?php if ($message != ''): ?>
                <script>
                    alert('<?= $message ?>');
                    window.history.back();
                </script>
            <?php endif; ?>
        </div>
    </div>
</div>