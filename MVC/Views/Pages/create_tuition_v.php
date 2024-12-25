<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info">
        <?php echo $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); ?> <!-- Xóa thông báo sau khi hiển thị -->
    </div>
<?php endif; ?>

<form method="POST" action="http://localhost/project_quanlisinhvien/manage_tuition/insert_Tuition/">
    <h2>Tạo học phí</h2>
    <!-- Form để nhập học kỳ, năm học, và giá học phí mỗi tín chỉ -->
    <div class="form-group">
        <label for="HocKy">Học kỳ:</label>
        <input type="text" class="form-control" id="HocKy" name="HocKy" placeholder="Nhập học kỳ" required>
    </div>
    <div class="form-group">
        <label for="NamHoc">Năm học:</label>
        <input type="text" class="form-control" id="NamHoc" name="NamHoc" placeholder="Nhập năm học" required>
    </div>
    <div class="form-group">
        <label for="GiaHocPhiMoiTinChi">Giá học phí mỗi tín chỉ:</label>
        <input type="number" class="form-control" id="GiaHocPhiMoiTinChi" name="GiaHocPhiMoiTinChi" placeholder="Nhập giá học phí mỗi tín chỉ" required>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật học phí</button>
</form>