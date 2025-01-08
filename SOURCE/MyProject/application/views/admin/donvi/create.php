<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Thêm mới đơn vị mới</h2>
            <form action="<?php echo base_url('save_dv'); ?>" method="POST" class="add-form">
                <label for="madv">Mã đơn vị:</label>
                <input type="text" id="madv" name="madv" placeholder="Nhập mã đơn vị" required>

                <label for="tendonvi">Tên đơn vị:</label>
                <input type="text" id="tendonvi" name="tendonvi" placeholder="Nhập tên đơn vị" required>


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