<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Sửa thông tin môn học</h2>
            <form action="<?php echo base_url('save_update' . $mon_hoc['maMH']); ?>" method="POST" class="add-form">
                <label for="maMH">Mã môn học:</label>
                <input type="text" id="maMH" name="maMH" value="<?php echo $mon_hoc['maMH']; ?>" readonly>

                <label for="tenMH">Tên môn học:</label>
                <input type="text" id="tenMH" name="tenMH" value="<?php echo $mon_hoc['tenMH']; ?>" placeholder="Nhập tên môn học">

                <label for="tongsotiet">Tổng số tiết:</label>
                <input type="text" id="tongsotiet" name="tongsotiet" value="<?php echo $mon_hoc['tongsotiet']; ?>" placeholder="Nhập tổng số tiết">

                <label for="SoTC">Số tín chỉ:</label>
                <input type="text" id="SoTC" name="SoTC" value="<?php echo $mon_hoc['SoTC']; ?>" placeholder="Nhập số tín chỉ">

                <div class="form-actions">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
