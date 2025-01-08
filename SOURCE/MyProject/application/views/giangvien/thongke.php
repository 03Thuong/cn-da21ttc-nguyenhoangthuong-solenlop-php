<div class="account-info">
<h2>THỐNG KÊ SỐ TIẾT DẠY : <?php echo $maGV . ' - ' . ($tenGV ? $tenGV : 'Tên giáo viên không tìm thấy'); ?></h2>
<form id="filterForm" action="<?= base_url('thongke'); ?>" method="post" enctype="multipart/form-data" class="form-import">
    <div class="form-group-hk">
        <label for="search_term">Chọn Học Kỳ:</label>
        <select name="search_term" id="search_term" required class="select-import">
            <option value="">-- Chọn Học Kỳ --</option>
            <?php foreach ($hocKyResult as $hk): ?>
                <option value="<?= $hk['maHK']; ?>"><?= $hk['tenHK']?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group-hk">
        <label for="search_term">Chọn năm học:</label>
        <select name="n" id="year_select" required class="select-import">
            <option value="">-- Chọn năm học --</option>
            <?php foreach ($namhoc as $nh): ?>
                <option value="<?= $nh['namhoc']; ?>"><?= $nh['namhoc'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</form></br>

        
    <table border="1">
        <thead>
            <tr>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Tên lớp</th>
                <th>Tổng số tiết lý thuyết</th>
                <th>Tổng số tiết thực hành</th>
                <th>Tổng số tiết (LT+TH)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tong_tiet = 0;
            foreach ($thongke as $row) {
                $tong_tiet += $row->tong_sotiet;
                echo "<tr>
                    <td>{$row->maMH}</td>
                    <td>{$row->tenMH}</td>
                    <td>{$row->tenlopmonhoc}</td>
                    <td>{$row->tong_sotietlt}</td>
                    <td>{$row->tong_sotietth}</td>
                    <td>{$row->tong_sotiet}</td>
                </tr>";
            }
            ?>
            <tr>
                <td colspan="6" style="text-align: right; color: red; font-weight: bold; font-size:20px;">
                    Tổng kết: <?php echo $tong_tiet; ?> tiết
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <h2>BIỂU ĐỒ THỐNG KÊ SỐ TIẾT DẠY </h2>
<canvas id="myChart" width="100" height="50"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = [];
    const dataLT = [];
    const dataTH = [];
    
    <?php foreach ($thongke as $row): ?>
        labels.push('<?php echo $row->tenMH; ?>'); // Tên môn học
        dataLT.push(<?php echo $row->tong_sotietlt; ?>); // Số tiết lý thuyết
        dataTH.push(<?php echo $row->tong_sotietth; ?>); // Số tiết thực hành
    <?php endforeach; ?>
    
    const ctx = document.getElementById('myChart').getContext('2d');

    const myChart = new Chart(ctx, {
        type: 'bar', // Loại biểu đồ
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Số tiết lý thuyết',
                    data: dataLT,
                    backgroundColor: ctx.createPattern(createPlusPattern('rgba(238, 250, 250, 0.5)'), 'repeat'),
                    borderColor: 'rgb(255, 255, 255)',
                    borderWidth: 1
                },
                {
                    label: 'Số tiết thực hành',
                    data: dataTH,
                    backgroundColor: ctx.createPattern(createMinusPattern('rgba(246, 238, 240, 0.5)'), 'repeat'),
                    borderColor: 'rgb(255, 255, 255)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

 // Họa tiết dấu +
 function createPlusPattern(color) {
        const size = 10;
        const patternCanvas = document.createElement('canvas');
        const patternCtx = patternCanvas.getContext('2d');

        patternCanvas.width = size;
        patternCanvas.height = size;

        patternCtx.fillStyle = color;
        patternCtx.fillRect(0, 0, size, size);

        patternCtx.fillStyle = 'rgba(128, 128, 128, 0.3)'; // Màu xám nhạt
        patternCtx.fillRect(size / 2 - 1, 0, 2, size); // Dấu +
        patternCtx.fillRect(0, size / 2 - 1, size, 2); // Dấu +

        return patternCanvas;
    }


    // Họa tiết dấu -
    function createMinusPattern(color) {
        const size = 10;
        const patternCanvas = document.createElement('canvas');
        const patternCtx = patternCanvas.getContext('2d');

        patternCanvas.width = size;
        patternCanvas.height = size;

        patternCtx.fillStyle = color;
        patternCtx.fillRect(0, 0, size, size);

         patternCtx.fillStyle = 'rgba(128, 128, 128, 0.3)'; // Màu xám nhạt
        patternCtx.fillRect(size / 2 - 1, size / 2 - 1, size, 2); // Dấu -

        return patternCanvas;
    }
</script>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const searchTerm = document.getElementById('search_term');
        const yearSelect = document.getElementById('year_select');

        // Function to submit the form
        function submitForm() {
            filterForm.submit();
        }

        // Add event listeners for Enter key
        searchTerm.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent default form submission
                submitForm();
            }
        });

        yearSelect.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent default form submission
                submitForm();
            }
        });
    });
</script>

