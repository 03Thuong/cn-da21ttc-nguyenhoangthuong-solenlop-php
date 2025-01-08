<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Sửa thông tin đơn vị</h2>
            <form action="<?php echo base_url('save_update_dv' . $don_vi['madv']); ?>" method="POST" class="add-form">
                <label for="madv">Mã giảng viên:</label>
                <input type="text" id="madv" name="madv" value="<?php echo $don_vi['madv']; ?>" readonly>

                <label for="tendonvi">Tên giảng viên:</label>
                <input type="text" id="tendonvi" name="tendonvi" value="<?php echo $don_vi['tendonvi']; ?>" placeholder="Nhập tên giảng viên">

                <div class="form-actions">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>