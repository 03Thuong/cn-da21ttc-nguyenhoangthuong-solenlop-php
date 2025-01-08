<div class="main">
    <h2>Chỉnh sửa sổ Lên Lớp</h2>
    <form class="add-attendance-form"
        action="<?php echo base_url('save_update_ctsll' . $chi_tiet_so_len_lop['maCT']); ?>" method="POST"
        enctype="multipart/form-data">
        <input type="hidden" name="maPC" value="<?php echo $chi_tiet_so_len_lop['maPC']; ?>">
        <input type="hidden" name="maCT" value="<?php echo $chi_tiet_so_len_lop['maCT']; ?>">
        <div class="form-section">
            <div class="form-group">
                <label for="date">Ngày:</label>
                <input type="date" id="date" name="date"
                    value="<?php echo date('Y-m-d', strtotime($chi_tiet_so_len_lop['ngaylenlop'])); ?>" required>
            </div>
            <div class="form-group">
                <label for="session">Buổi:</label>
                <select id="session" name="buoi" required>
                    <option value="Sáng" <?php echo ($chi_tiet_so_len_lop['buoi'] == 'Sáng') ? 'selected' : ''; ?>>Sáng
                    </option>
                    <option value="Chiều" <?php echo ($chi_tiet_so_len_lop['buoi'] == 'Chiều') ? 'selected' : ''; ?>>Chiều
                    </option>
                    <option value="Tối" <?php echo ($chi_tiet_so_len_lop['buoi'] == 'Tối') ? 'selected' : ''; ?>>Tối
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="room">Phòng:</label>
                <input type="text" id="room" name="phonghoc"
                    value="<?php echo htmlspecialchars($chi_tiet_so_len_lop['phonghoc']); ?>"
                    placeholder="Nhập số phòng" required>
            </div>
            <div class="form-group">
                <label for="tenSV_vang">Sinh viên vắng:</label>
                <textarea id="tenSV_vang" name="tenSV_vang" rows="4"
                    placeholder=""><?php echo htmlspecialchars($chi_tiet_so_len_lop['tenSV_vang']); ?></textarea>
            </div>
        </div>

        <div class="form-section">
            <div class="form-group">
                <label for="theory-periods">Số tiết lý thuyết:</label>
                <input type="number" id="theory-periods" name="sotietlt"
                    value="<?php echo $chi_tiet_so_len_lop['sotietlt']; ?>" min="0" required>
            </div>
            <div class="form-group">
                <label for="practical-periods">Số tiết thực hành:</label>
                <input type="number" id="practical-periods" name="sotietth"
                    value="<?php echo $chi_tiet_so_len_lop['sotietth']; ?>" min="0" required>
            </div>
            <div class="form-group">
                <label for="content-summary">Tóm tắt nội dung:</label>
                <textarea id="content-summary" name="tomtatnoidung" rows="4" placeholder="Nhập tóm tắt nội dung"
                    required><?php echo htmlspecialchars($chi_tiet_so_len_lop['tomtatnoidung']); ?></textarea>
            </div>

            <div class="form-group-check">
                <label for="xacnhangv" class="form-label">CBGD (Ký tên):</label>
                <div class="input-container">
                    <input type="file" id="xacnhangv" name="xacnhangv" accept="image/*">
                </div>

                <div id="image-preview">
        <?php if (!empty($chi_tiet_so_len_lop['xacnhangv']) && file_exists('./uploads/' . $chi_tiet_so_len_lop['xacnhangv'])): ?>
            <img src="<?php echo base_url('uploads/' . $chi_tiet_so_len_lop['xacnhangv']); ?>" alt="Đã xác nhận" width="50" height="50" style="margin-left:-60px;">
        <?php else: ?>
            <p class="no-confirmation">Chưa xác nhận</p> 
        <?php endif; ?>
    </div>
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Lưu</button>
            <button type="button" class="btn-reset"
                onclick="redirectTosolenlop(<?php echo $chi_tiet_so_len_lop['maPC']; ?>);">
                <i class="fas fa-times"></i> Hủy
            </button>
        </div>
    </form>

    <!-- thông báo lỗi -->
    <?php if ($this->session->flashdata('error')): ?>
        <script>
            alert('<?= addslashes($this->session->flashdata('error')) ?>');
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <script>
            alert('<?= addslashes($this->session->flashdata('success')) ?>');
        </script>
    <?php endif; ?>
</div>

<script>
    function updateCheckboxStatus(checkbox) {
        const label = document.getElementById('xacnhangv-label');
        if (checkbox.checked) {
            checkbox.value = "Đã xác nhận";
            label.textContent = "Đã xác nhận";
        } else {
            checkbox.value = "Chưa xác nhận";
            label.textContent = "Chưa xác nhận";
        }
    }

    function redirectTosolenlop(maPC) {
        window.location.href = 'ctsll' + maPC; // Redirects to the URL with the maPC parameter
    }
</script>

<style>
    .no-confirmation {
        font-weight: bold; /* In đậm */
        width: 20px; /* Độ rộng */
        white-space: nowrap; /* Không xuống dòng */
        margin-left:-50px;
    }
</style>