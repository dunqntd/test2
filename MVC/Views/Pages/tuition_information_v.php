<div class="container">
    <h2>Thông tin học phí sinh viên</h2>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Sinh Viên</th>
                <th>Số Tín Chỉ Đăng Ký</th>
                <th>Số Tiền</th>
                <th>Tiền Đã nộp</th>
                <th>Học Kỳ</th>
                <th>Năm Học</th>
                <th>Trạng Thái Thanh Toán</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Kiểm tra nếu có dữ liệu học phí
            if (isset($data['danhsachhocphi']) && !empty($data['danhsachhocphi'])) {
                foreach ($data['danhsachhocphi'] as $row) {
            ?>
                    <tr>
                        <td><?php echo $row['MaSoSV']; ?></td>
                        <td><?php echo $row['TongSoTinChi']; ?></td>
                        <td><?php echo number_format($row['TongSoTien'], 2); ?> VNĐ</td>
                        <td><?php echo number_format($row['Tongtiendathanhtoan'], 2); ?> VNĐ</td>
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

                        <td>
                            <!-- Nút thanh toán hiển thị khi chưa thanh toán hoặc có một phần thanh toán -->
                            <?php if ($row['TrangThai'] == 'Chua thanh toan'): ?>
                                <button
                                    type="button"
                                    class="btn btn-success open-modal"
                                    data-bs-toggle="modal"
                                    data-bs-target="#paymentModal"
                                    data-masv="<?php echo $row['MaSoSV']; ?>"
                                    data-hocky="<?php echo $row['HocKy']; ?>"
                                    data-namhoc="<?php echo $row['NamHoc']; ?>"
                                    data-tongtien="<?php echo $row['TongSoTien']; ?>">
                                    Thanh Toán
                                </button>
                            <?php elseif ($row['TrangThai'] == 'Mot phan thanh toan'): ?>
                                <button
                                    type="button"
                                    class="btn btn-warning open-modal"
                                    data-bs-toggle="modal"
                                    data-bs-target="#paymentModal"
                                    data-masv="<?php echo $row['MaSoSV']; ?>"
                                    data-hocky="<?php echo $row['HocKy']; ?>"
                                    data-namhoc="<?php echo $row['NamHoc']; ?>"
                                    data-tongtien="<?php echo $row['TongSoTien']; ?>">
                                    Thanh Toán Thêm
                                </button>
                            <?php else: ?>
                                Đã thanh toán
                            <?php endif; ?>
                        </td>

                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>Không có thông tin học phí.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal xác nhận thanh toán -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Xác nhận thanh toán</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm" method="POST" action="http://localhost/project_quanlisinhvien/payment_tuition/submitPayment">
                    <input type="hidden" name="MaSoSV" id="modalMaSoSV">
                    <input type="hidden" name="HocKy" id="modalHocKy">
                    <input type="hidden" name="NamHoc" id="modalNamHoc">
                    <input type="number" name="SoTienThanhToan" id="modalSoTienThanhToan" placeholder="Số tiền thanh toán" required>
                    <button type="submit" class="btn btn-primary">Xác nhận thanh toán</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<!-- Script xử lý Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('paymentModal');
        const maSoSVInput = document.getElementById('modalMaSoSV');
        const hocKyInput = document.getElementById('modalHocKy');
        const namHocInput = document.getElementById('modalNamHoc');
        const soTienThanhToanInput = document.getElementById('modalSoTienThanhToan');

        // Lắng nghe sự kiện khi modal mở
        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Nút kích hoạt modal
            const maSoSV = button.getAttribute('data-masv');
            const hocKy = button.getAttribute('data-hocky');
            const namHoc = button.getAttribute('data-namhoc');
            const tongTien = button.getAttribute('data-tongtien');

            // Gán giá trị vào các trường trong modal
            maSoSVInput.value = maSoSV;
            hocKyInput.value = hocKy;
            namHocInput.value = namHoc;

            // Hiển thị số tiền thanh toán
            soTienThanhToanInput.value = tongTien; // Hiển thị số tiền thanh toán
        });
    });
</script>