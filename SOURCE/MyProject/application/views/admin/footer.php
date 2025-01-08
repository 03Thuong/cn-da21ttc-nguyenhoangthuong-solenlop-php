</div>
    </div>
</body>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    const menuMapping = {
        "home_admin.html": "menu-giangvien",
        "quanlybomon.html": "menu-bomon",
        "quanlymonhoc.html": "menu-monhoc",
        "quanlynhom.html": "menu-nhom",
        "ql_hocky.html": "menu-hocky",
        "ql_sinhvien.html": "menu-sinhvien",
        "ql_sll.html": "menu-sll"
        
    };

    const currentPage = window.location.pathname.split("/").pop();
    if (menuMapping[currentPage]) {
        document.getElementById(menuMapping[currentPage]).classList.add("active");
    }
});

    function editClick(event) {
    event.stopPropagation(); // Ngừng sự kiện click của dòng, không chuyển hướng đến chitietsolenlop.html
    window.location.href = 'sua_solenlop.html'; // Chuyển đến trang sua_solenlop.html khi nhấn nút sửa
}

</script>


</html>