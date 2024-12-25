<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info">
        <?php echo $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); ?> <!-- Xóa thông báo sau khi hiển thị -->
    </div>
<?php endif; ?>

<h2>Quản lý học phí</h2>

<!-- Bảng danh sách học phí -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Học kỳ</th>
            <th>Năm học</th>
            <th>Giá học phí mỗi tín chỉ</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($data['tuitionData']) && mysqli_num_rows($data['tuitionData']) > 0): ?>
            <?php
            $i = 0;
            while ($tuition = mysqli_fetch_assoc($data['tuitionData'])):
            ?>
                <tr>
                    <td><?php echo $tuition['HocKy']; ?></td>
                    <td><?php echo $tuition['NamHoc']; ?></td>
                    <td><?php echo $tuition['GiaHocPhiMoiTinChi']; ?> VNĐ</td>
                    <td>
                        <!-- Sửa học phí -->
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-hocky="<?php echo $tuition['HocKy']; ?>" data-namhoc="<?php echo $tuition['NamHoc']; ?>" data-giatc="<?php echo $tuition['GiaHocPhiMoiTinChi']; ?>">Sửa</button>

                        <!-- Nút xóa học phí -->
                        <a href="http://localhost/project_quanlisinhvien/manage_tuition/delete_Tuition/<?php echo $tuition['HocKy']; ?>/<?php echo $tuition['NamHoc']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa học phí này không?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Không có thông tin học phí.</td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>

<a href="http://localhost/project_quanlisinhvien/manage_tuition/view_createTuition/" class="btn btn-success">Tạo học phí mới</a>

<!-- Modal chỉnh sửa học phí -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa học phí</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="http://localhost/project_quanlisinhvien/manage_tuition/update_Tuition/">
                <div class="modal-body">
                    <!-- Học kỳ và năm học (ẩn đi) -->
                    <input type="hidden" name="HocKy" id="HocKy">
                    <input type="hidden" name="NamHoc" id="NamHoc">

                    <!-- Form nhập giá học phí mới -->
                    <div class="form-group">
                        <label for="GiaHocPhiMoiTinChi">Giá học phí mỗi tín chỉ:</label>
                        <input type="number" class="form-control" id="GiaHocPhiMoiTinChi" name="GiaHocPhiMoiTinChi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút kích hoạt modal
        var hocKy = button.data('hocky');
        var namHoc = button.data('namhoc');
        var giaHocPhiMoiTinChi = button.data('giatc');

        // Truyền dữ liệu vào modal
        var modal = $(this);
        modal.find('.modal-body #HocKy').val(hocKy);
        modal.find('.modal-body #NamHoc').val(namHoc);
        modal.find('.modal-body #GiaHocPhiMoiTinChi').val(giaHocPhiMoiTinChi);
    });
</script>