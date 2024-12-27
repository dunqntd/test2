<div class="container my-4">
    <h2>Danh sách môn học đã đăng ký</h2>
    <h4>Sinh viên ID: <?php echo $data['studentId']; ?></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Môn</th>
                <th>Tên Môn</th>
                <th>Học Kỳ</th>
                <th>Năm Học</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['registeredCourses'])): ?>
                <?php foreach ($data['registeredCourses'] as $course): ?>
                    <tr>
                        <td><?php echo $course['MaMon']; ?></td>
                        <td><?php echo $course['TenMon']; ?></td>
                        <td><?php echo $course['HocKy']; ?></td>
                        <td><?php echo $course['NamHoc']; ?></td>
                        <td>
                            <!-- Nút sửa -->
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal_<?php echo $course['MaMon']; ?>">Sửa</button>

                            <!-- Nút xóa -->
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal_<?php echo $course['MaMon']; ?>">Xóa</button>
                        </td>
                    </tr>

                    <!-- Modal Sửa -->
                    <div class="modal fade" id="editModal_<?php echo $course['MaMon']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Sửa Môn Học</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="http://localhost/project_quanlisinhvien/registration/updateCourse" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="student_id" value="<?php echo $data['studentId']; ?>">
                                        <input type="hidden" name="course_id" value="<?php echo $course['MaMon']; ?>">

                                        <div class="form-group mb-3">
                                            <label for="semester">Học Kỳ:</label>
                                            <select class="form-control" id="semester" name="semester" required>
                                                <option value="1" <?php echo $course['HocKy'] == '1' ? 'selected' : ''; ?>>Học kỳ 1</option>
                                                <option value="2" <?php echo $course['HocKy'] == '2' ? 'selected' : ''; ?>>Học kỳ 2</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="academic_year">Năm Học:</label>
                                            <select class="form-control" id="academic_year" name="academic_year" required>
                                                <option value="2024-2025" <?php echo $course['NamHoc'] == '2024-2025' ? 'selected' : ''; ?>>2024-2025</option>
                                                <option value="2025-2026" <?php echo $course['NamHoc'] == '2025-2026' ? 'selected' : ''; ?>>2025-2026</option>
                                            </select>
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

                    <!-- Modal Xóa -->
                    <div class="modal fade" id="deleteModal_<?php echo $course['MaMon']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Xác Nhận Xóa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xóa môn học này không?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <a href="http://localhost/project_quanlisinhvien/registration/deleteCourse/<?php echo $course['MaMon']; ?>/<?php echo $data['studentId']; ?>" class="btn btn-danger">Xóa</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Sinh viên chưa đăng ký môn học nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>