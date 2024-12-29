<div class="container mt-6">
    <!-- Thông tin sinh viên -->
    <?php if (isset($data['student_info']) && mysqli_num_rows($data['student_info']) > 0) {
        $student = mysqli_fetch_assoc($data['student_info']);
    ?>
        <h3>Thông tin sinh viên</h3>
        <p><strong>Mã sinh viên:</strong> <?php echo $student['MaSoSV']; ?></p>
        <p><strong>Họ tên:</strong> <?php echo $student['HoTen']; ?></p>
    <?php } else { ?>
        <p>Không tìm thấy thông tin sinh viên.</p>
    <?php } ?>

    <!-- Danh sách môn học đã đăng ký -->
    <h3>Danh sách môn học đã đăng ký</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã môn</th>
                <th>Tên môn học</th>
                <th>Số tín chỉ</th>
                <th>Học kỳ</th>
                <th>Năm học</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($data['registered_courses']) && mysqli_num_rows($data['registered_courses']) > 0) {
                $index = 1;
                while ($course = mysqli_fetch_assoc($data['registered_courses'])) { ?>
                    <tr>
                        <td><?php echo $index++; ?></td>
                        <td><?php echo $course['MaMon']; ?></td>
                        <td><?php echo $course['TenMon']; ?></td>
                        <td><?php echo $course['SoTinChi']; ?></td>
                        <td><?php echo $course['HocKy']; ?></td>
                        <td><?php echo $course['NamHoc']; ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="6">Không có môn học nào được đăng ký.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>