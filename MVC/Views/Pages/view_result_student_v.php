<div class="container mt-5">
    <!-- Thông tin sinh viên -->
    <?php if (isset($data['student_info']) && mysqli_num_rows($data['student_info']) > 0) {
        // Lấy dữ liệu thông tin sinh viên
        $student = mysqli_fetch_assoc($data['student_info']);
    ?>
        <h3>Thông tin sinh viên</h3>
        <p><strong>Mã sinh viên:</strong> <?php echo $student['MaSoSV']; ?></p>
        <p><strong>Họ tên:</strong> <?php echo $student['HoTen']; ?></p>

    <?php } else { ?>
        <p>Không tìm thấy thông tin sinh viên.</p>
    <?php } ?>

    <!-- Kết quả học tập -->
    <h3>Kết quả học tập</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã môn</th>
                <th>Tên môn học</th>
                <th>Số tín chỉ</th>
                <th>Điểm</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($data['student_results']) && mysqli_num_rows($data['student_results']) > 0) {
                $index = 1;
                // Duyệt qua các kết quả học tập
                while ($result = mysqli_fetch_assoc($data['student_results'])) { ?>
                    <tr>
                        <td><?php echo $index++; ?></td>
                        <td><?php echo $result['MaMon']; ?></td>
                        <td><?php echo $result['TenMon']; ?></td>
                        <td><?php echo $result['SoTinChi']; ?></td>
                        <td><?php echo $result['Diem']; ?></td>
                        <td><?php echo ($result['Diem'] >= 5 ? 'Đạt' : 'Không Đạt'); ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="6">Không có kết quả học tập nào.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>