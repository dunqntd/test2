<style>
    .form-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-right: 520px;
    }

    .form-container .form-group {
        max-width: 250px;
    }

    .form-container button {
        margin-left: 20px;
    }
</style>

<div class="container mt-7">
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

    <!-- Chọn học kỳ và năm học -->
    <form method="POST" action="http://localhost/project_quanlisinhvien/result_student/view_result/<?php echo $student['MaSoSV']; ?>">
        <div class="form-container">
            <div class="form-group">
                <label for="HocKy">Học kỳ:</label>
                <select id="HocKy" name="HocKy" class="form-select" required>
                    <option value="" disabled selected>-- Chọn học kỳ --</option>
                    <option value="1">Học kỳ 1</option>
                    <option value="2">Học kỳ 2</option>
                </select>
            </div>

            <div class="form-group">
                <label for="NamHoc">Năm học:</label>
                <select id="NamHoc" name="NamHoc" class="form-select" required>
                    <option value="" disabled selected>-- Chọn năm học --</option>
                    <?php
                    $namHocList = ['2023-2024', '2024-2025'];
                    foreach ($namHocList as $namHoc) {
                        echo "<option value='$namHoc'>$namHoc</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 15px;">Xem kết quả</button>
        </div>
    </form>

    <!-- Kết quả học tập -->
    <?php if (isset($data['student_results']) && count($data['student_results']) > 0) { ?>
        <h3>Kết quả học tập</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mã môn</th>
                    <th>Tên môn học</th>
                    <th>Học Kỳ</th>
                    <th>Năm học</th>
                    <th>Điểm</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 1;
                // Duyệt qua các kết quả học tập
                foreach ($data['student_results'] as $result) { ?>
                    <tr>
                        <td><?php echo $index++; ?></td>
                        <td><?php echo $result['MaMon']; ?></td>
                        <td><?php echo $result['TenMon']; ?></td>
                        <td><?php echo $result['HocKy']; ?></td>
                        <td><?php echo $result['NamHoc']; ?></td>
                        <td><?php echo $result['Diem']; ?></td>
                        <td><?php echo ($result['Diem'] >= 5 ? 'Đạt' : 'Không Đạt'); ?></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>

        <!-- Hiển thị điểm trung bình -->
        <h4>Điểm Trung Bình: <?php echo $data['average_score']; ?></h4>
    <?php } else { ?>
        <p>Chưa có kết quả cho học kỳ và năm học đã chọn.</p>
    <?php } ?>
</div>