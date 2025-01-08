<div class="main">
    <h2>Thêm Sổ Lên Lớp</h2>
    <form class="add-attendance-form" action="<?php echo base_url('save_ctsll' . $maPC); ?>" method="POST" enctype="multipart/form-data">
        <div class="form-section">
            <div class="form-group">
                <label for="date">Ngày:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="session">Buổi:</label>
                <select id="session" name="buoi" required>
                    <option value="Sáng">Sáng</option>
                    <option value="Chiều">Chiều</option>
                    <option value="Tối">Tối</option>
                </select>
            </div>
            <div class="form-group">
                <label for="room">Phòng:</label>
                <input type="text" id="room" name="phonghoc" placeholder="Nhập số phòng" required>
            </div>

        </div>

        <div class="form-section">


            <div class="form-group">
                <label for="theory-periods">Số tiết lý thuyết:</label>
                <input type="number" id="theory-periods" name="sotietlt" min="0" required>
            </div>
            <div class="form-group">
                <label for="practical-periods">Số tiết thực hành:</label>
                <input type="number" id="practical-periods" name="sotietth" min="0" required>
            </div>
            <div class="form-group">
                <label for="content-summary">Tóm tắt nội dung:</label>
                <textarea id="content-summary" name="tomtatnoidung" rows="4" placeholder="Nhập tóm tắt nội dung"
                    required></textarea>
            </div>
            <div class="form-group-check">
                <label for="xacnhangv" class="form-label">CBGD(Ký tên):</label>
                <div class="input-container">
                    <input type="file" id="xacnhangv" name="xacnhangv" accept="image/*">
                </div>
            </div>


        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Lưu</button>
            <button type="button" class="btn-reset"
                onclick="redirectTosolenlop(<?php echo htmlspecialchars($maPC); ?>);">
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

    $(function() {
        $("#date").datepicker({
            dateFormat: "dd/mm/yy" // Định dạng ngày tháng năm
        });
    });

</script>