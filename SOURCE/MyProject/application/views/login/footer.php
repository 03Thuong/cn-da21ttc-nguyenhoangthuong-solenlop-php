<div id="toast" class="toast toast-error" style="display: none;">
  <div class="toast-content">
    <?= $this->session->flashdata('error') ?>
    <button id="toast-close" class="toast-close">OK</button>
  </div>
</div>

<div id="toast" class="toast toast-success" style="display: none;">
  <div class="toast-content">
    <?= $this->session->flashdata('success') ?>
    <button id="toast-close" class="toast-close">OK</button>
  </div>
</div>


</body>
<script>
  const togglePassword = document.getElementById("togglePassword");
  const password = document.getElementById("password");

  togglePassword.addEventListener("click", function () {
    // Toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // Toggle the eye icon
    this.classList.toggle("fa-eye-slash");
  });

  // THÔNG BÁO LỖI
  document.addEventListener("DOMContentLoaded", function () {
    // Kiểm tra xem có thông báo lỗi không
    <?php if ($this->session->flashdata('error')): ?>
      var toast = document.getElementById('toast');
      toast.style.display = 'block'; // Hiển thị toast

      // Thêm sự kiện cho nút đóng
      document.getElementById('toast-close').addEventListener('click', function () {
        toast.style.display = 'none'; // Ẩn toast khi nhấn OK
      });
    <?php endif; ?>

    // Hiển thị thông báo thành công
    <?php if ($this->session->flashdata('success')): ?>
      var successToast = document.getElementById('toast-success');
      successToast.style.display = 'block'; // Hiển thị thông báo thành công

      // Thêm sự kiện đóng
      document.getElementById('toast-success-close').addEventListener('click', function () {
        successToast.style.display = 'none'; // Ẩn toast khi nhấn OK
      });

      // Tự động ẩn sau 3 giây
      setTimeout(function () {
        successToast.style.display = 'none';
      }, 3000); // 3000ms = 3 giây
    <?php endif; ?>
  });
</script>

</script>

</html>