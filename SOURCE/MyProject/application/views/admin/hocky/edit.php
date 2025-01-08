<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Sửa thông tin học kỳ</h2>
            <form action="<?php echo base_url('save_update_hk/' . $hoc_ky['maHK']); ?>" method="POST" class="add-form">
                <label for="maHK">Mã học kỳ:</label>
                <input type="text" id="maHK" name="maHK" value="<?php echo $hoc_ky['maHK']; ?>" readonly>

                <label for="tenHK">Tên học kỳ:</label>
                <input type="text" id="tenHK" name="tenHK" value="<?php echo $hoc_ky['tenHK']; ?>" placeholder="Nhập tên học kỳ">

                <label for="namhoc">Năm học:</label>
                <input type="text" id="namhoc" name="namhoc" value="<?php echo $hoc_ky['namhoc']; ?>" placeholder="Nhập năm học">

                <div class="form-actions">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>