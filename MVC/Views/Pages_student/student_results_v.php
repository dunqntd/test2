<div class="container my-6">
    <h2>Kết quả học tập</h2>

    <!-- Chọn học kỳ và năm học -->
    <form method="POST" action="http://localhost/project_quanlisinhvien/StudentResults/view_result/">
        <div class="mb-3">
            <label for="HocKy">Học kỳ:</label>
            <select id="HocKy" name="HocKy" class="form-select" required>
                <option value="" disabled selected>-- Chọn học kỳ --</option>
                <option value="1">Học kỳ 1</option>
                <option value="2">Học kỳ 2</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="NamHoc">Năm học:</label>
            <select id="NamHoc" name="NamHoc" class="form-select" required>
                <option value="" disabled selected>-- Chọn năm học --</option>
                <?php
                $namHocList = ['2023-2024', '2024-2025']; // Có thể thay đổi danh sách năm học theo dữ liệu thực tế
                foreach ($namHocList as $namHoc) {
                    echo "<option value='$namHoc'>$namHoc</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Xem kết quả</button>
    </form>
    <br>
    <!-- Hiển thị kết quả học tập -->
    <?php if (isset($data['results']) && !empty($data['results'])): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Học kỳ</th>
                    <th>Năm học</th>
                    <th>Điểm</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $index = 1;
                foreach ($data['results'] as $result): ?>
                    <tr>
                        <td><?php echo $index++; ?></td>
                        <td><?php echo $result['MaMon']; ?></td>
                        <td><?php echo $result['TenMon']; ?></td>
                        <td><?php echo $result['HocKy']; ?></td>
                        <td><?php echo $result['NamHoc']; ?></td>
                        <td><?php echo $result['Diem']; ?></td>
                        <td><?php echo $result['TrangThai'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Không có kết quả học tập nào.</p>
    <?php endif; ?>

    <!-- Hiển thị điểm trung bình -->
    <?php if (isset($data['average_score'])) { ?>
        <h4>Điểm Trung Bình: <?php echo $data['average_score']; ?></h4>
    <?php } ?>

    <!-- Hiển thị thông báo nếu không chọn học kỳ hoặc năm học -->
    <?php if (isset($data['message'])): ?>
        <p><?php echo $data['message']; ?></p>
    <?php endif; ?>
</div>