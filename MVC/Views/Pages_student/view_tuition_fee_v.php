<div class="container mt-7">
    <h3>Thông tin học phí sinh viên</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Sinh Viên</th>
                <th>Số Tín Chỉ Đăng Ký</th>
                <th>Số Tiền</th>
                <th>Tiền Đã Nộp</th>
                <th>Học Kỳ</th>
                <th>Năm Học</th>
                <th>Trạng Thái Thanh Toán</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['tuition_summary']) && mysqli_num_rows($data['tuition_summary']) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($data['tuition_summary'])): ?>
                    <tr>
                        <td><?php echo $row['MaSoSV']; ?></td>
                        <td><?php echo $row['TongSoTinChi']; ?></td>
                        <td><?php echo number_format($row['TongHocPhi'], 0, ',', '.'); ?> VNĐ</td>
                        <td><?php echo number_format($row['TongTienDaNop'], 0, ',', '.'); ?> VNĐ</td>
                        <td><?php echo $row['HocKy']; ?></td>
                        <td><?php echo $row['NamHoc']; ?></td>
                        <td>
                            <?php
                            if ($row['TrangThai'] == 'Chua thanh toan') {
                                echo 'Chưa thanh toán';
                            } elseif ($row['TrangThai'] == 'Da thanh toan') {
                                echo 'Đã thanh toán';
                            } else {
                                echo 'Một phần thanh toán';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Không có dữ liệu học phí.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>