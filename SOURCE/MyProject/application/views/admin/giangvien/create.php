<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Thêm mới giảng viên</h2>
            <form action="<?php echo base_url('save_gv'); ?>" method="POST" class="add-form">
                <label for="maGV">Mã giảng viên:</label>
                <input type="text" id="maGV" name="maGV" placeholder="Nhập mã giảng viên">

                <label for="tenGV">Tên giảng viên:</label>
                <input type="text" id="tenGV" name="tenGV" placeholder="Nhập tên giảng viên">

                <label for="madv">Tên đơn vị:</label>
                <select id="madv" name="madv">
                    <option value="">Chọn đơn vị</option>
                    <?php foreach ($don_vi as $dv): ?>
                        <option value="<?php echo $dv['madv']; ?>"><?php echo $dv['tendonvi']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="matk">Mã tài khoản:</label>
                <input type="text" id="matk" name="matk" placeholder="Nhập mã tài khoản">


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