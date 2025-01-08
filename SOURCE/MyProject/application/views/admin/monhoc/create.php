<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Thêm mới môn học</h2>
            <form action="<?php echo base_url('save_monhoc'); ?>" method="POST" class="add-form">
                <label for="maMH">Mã môn học:</label>
                <input type="text" id="maMH" name="maMH" placeholder="Nhập mã môn học">

                <label for="tenMH">Tên môn học:</label>
                <input type="text" id="tenMH" name="tenMH" placeholder="Nhập tên môn học">

                <label for="tongsotiet">Tổng số tiết:</label>
                <input type="text" id="tongsotiet" name="tongsotiet" placeholder="Nhập tổng số tiết lý thuyết">

                <label for="SoTC">Số tín chỉ:</label>
                <input type="text" id="SoTC" name="SoTC" placeholder="Nhập số tín chỉ">


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