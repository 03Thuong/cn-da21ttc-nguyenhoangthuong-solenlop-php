<div class="main-content">
    <div class="content">
        <div class="form-container">
            <h2>Chỉnh sửa thông tin phân công</h2>
            <form action="<?= base_url('phancong/update') ?>" method="post">
                            <input type="hidden" name="maPC" value="<?= htmlspecialchars($phan_cong->maPC) ?>">
                        
                            <!-- Nhóm -->
                            <label for="manhom">Nhóm</label>
                            <select id="manhom" name="manhom" class="select_update">
                                <?php foreach ($nhommonhoc as $nhom): ?>
                                    <option value="<?= $nhom['manhom'] ?>" <?= $phan_cong->manhom == $nhom['manhom'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($nhom['manhom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        
                            <!-- Mã môn học -->
                            <label for="maMH">Mã môn học</label>
                            <select id="maMH" name="maMH" class="select_update">
                                <?php foreach ($monhoc as $mh): ?>
                                    <option value="<?= $mh['maMH'] ?>" <?= $phan_cong->maMH == $mh['maMH'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($mh['maMH']) . ' - ' . htmlspecialchars($mh['tenMH']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        
                            <!-- Mã giảng viên -->
                            <label for="maGV">Mã giảng viên</label>
                            <select id="maGV" name="maGV" class="select_update">
                                <?php foreach ($giangvien as $gv): ?>
                                    <option value="<?= $gv['maGV'] ?>" <?= $phan_cong->maGV == $gv['maGV'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($gv['maGV']) . ' - ' . htmlspecialchars($gv['tenGV']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        
                            <!-- Học kỳ -->
                            <label for="maHK">Học kỳ</label>
                            <select id="maHK" name="maHK" class="select_update">
                                <?php foreach ($hocKyResult as $hk): ?>
                                    <option value="<?= $hk['maHK'] ?>" <?= $phan_cong->maHK == $hk['maHK'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($hk['maHK']) . ' - ' . htmlspecialchars($hk['namhoc']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        
                            <button type="submit" class="btn-save">Cập nhật</button>
                        </form>

        </div>
    </div>
</div>