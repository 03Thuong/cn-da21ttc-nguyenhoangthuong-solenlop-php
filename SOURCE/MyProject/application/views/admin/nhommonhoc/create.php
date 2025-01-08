<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Thêm mới nhóm môn học</h2>
            <form action="<?php echo base_url('save_nhommonhoc'); ?>" method="POST" class="add-form">
                <label for="manhom">Mã nhóm:</label>
                <input type="text" id="manhom" name="manhom" placeholder="Nhập mã nhóm" required>

                <label for="maMH">Mã môn học:</label>
                <select id="maMH" name="maMH" required>
                    <option value="">Chọn mã môn học</option>
                    <?php if (!empty($mon_hoc)): ?>
                        <?php foreach ($mon_hoc as $mh): ?>
                            <option value="<?php echo $mh['maMH']; ?>">
                                <?php echo $mh['maMH'] . ' - ' . $mh['tenMH']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Không có môn học nào</option>
                    <?php endif; ?>
                </select>

                <label for="tenlopmonhoc">Tên lớp môn học:</label>
                <input type="text" id="tenlopmonhoc" name="tenlopmonhoc" placeholder="Nhập tên lớp môn học" required>

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