<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Sửa thông tin giảng viên</h2>
            <form action="<?php echo base_url('save_update_gv' . $giang_vien['maGV']); ?>" method="POST"
                class="add-form">
                <label for="maGV">Mã giảng viên:</label>
                <input type="text" id="maGV" name="maGV" value="<?php echo $giang_vien['maGV']; ?>" readonly>

                <label for="tenGV">Tên giảng viên:</label>
                <input type="text" id="tenGV" name="tenGV" value="<?php echo $giang_vien['tenGV']; ?>"
                    placeholder="Nhập tên giảng viên">

                <label for="madv">Tên đơn vị:</label>
                <select id="madv" name="madv">
                    <option value="">Chọn đơn vị</option>
                    <?php foreach ($don_vi as $dv): ?>
                        <option value="<?php echo $dv['madv']; ?>" <?php echo (isset($giang_vien['madv']) && $giang_vien['madv'] == $dv['madv']) ? 'selected' : ''; ?>>
                            <?php echo $dv['tendonvi']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="matk">Mã tài khoản:</label>
                <input type="text" id="matk" name="matk" value="<?php echo $giang_vien['matk']; ?>"
                    placeholder="Nhập mã tài khoản">

                <div class="form-actions">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>