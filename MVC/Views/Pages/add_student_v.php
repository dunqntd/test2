<form action="http://websinhvien.local/manage_students/themmoi" method="post">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Thêm Sinh Viên</h3>
                    </div>
                    <div class="card-body">

                        <!-- Thông tin sinh viên -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentId" class="form-label">Mã Sinh Viên</label>
                                <input type="text" class="form-control" id="studentId" name="student_id" placeholder="Mã Sinh Viên"
                                    value="<?php echo isset($data['oldData']['student_id']) ? $data['oldData']['student_id'] : ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentName" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="studentName" name="name" placeholder="Họ và tên"
                                    value="<?php echo isset($data['oldData']['name']) ? $data['oldData']['name'] : ''; ?>" required>
                            </div>
                        </div>

                        <!-- Ngày sinh và giới tính -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentDob" class="form-label">Ngày Sinh</label>
                                <input type="date" class="form-control" id="studentDob" name="dob"
                                    value="<?php echo isset($data['oldData']['dob']) ? $data['oldData']['dob'] : ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentGender" class="form-label">Giới Tính</label>
                                <select class="form-select" id="studentGender" name="gender" required>
                                    <option value="" disabled>Chọn giới tính</option>
                                    <option value="Nam" <?php echo (isset($data['oldData']['gender']) && $data['oldData']['gender'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                                    <option value="Nu" <?php echo (isset($data['oldData']['gender']) && $data['oldData']['gender'] == 'Nu') ? 'selected' : ''; ?>>Nữ</option>
                                    <option value="Khac" <?php echo (isset($data['oldData']['gender']) && $data['oldData']['gender'] == 'Khac') ? 'selected' : ''; ?>>Khác</option>
                                </select>
                            </div>
                        </div>

                        <!-- Email và điện thoại -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="studentEmail" name="email" placeholder="Email"
                                    value="<?php echo isset($data['oldData']['email']) ? $data['oldData']['email'] : ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentPhone" class="form-label">Điện thoại</label>
                                <input type="text" class="form-control" id="studentPhone" name="phone" placeholder="Điện thoại"
                                    value="<?php echo isset($data['oldData']['phone']) ? $data['oldData']['phone'] : ''; ?>" required>
                            </div>
                        </div>

                        <!-- Quê quán và mật khẩu -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentAddress" class="form-label">Quê Quán</label>
                                <input type="text" class="form-control" id="studentAddress" name="address" placeholder="Quê Quán"
                                    value="<?php echo isset($data['oldData']['address']) ? $data['oldData']['address'] : ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentPassword" class="form-label">Mật Khẩu</label>
                                <input type="password" class="form-control" id="studentPassword" name="password" placeholder="Mật khẩu" required>
                            </div>
                        </div>

                        <!-- Nút hành động -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-4" name="btnthem">Thêm Sinh Viên</button>
                            <a href="http://websinhvien.local/manage_students/Get_data" class="btn btn-outline-secondary px-4">Quay lại danh sách</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Form tải file -->
<form method="post" enctype="multipart/form-data" action="http://websinhvien.local/manage_students/uploadfile">
    <div class="container mt-4">
        <div class="card p-3">
            <h5 class="text-center mb-3">Thêm danh sách sinh viên bằng file</h5>
            <div class="row">
                <div class="col-md-8">
                    <input type="file" class="form-control" id="txtFile" name="txtFile" placeholder="Chọn file" required>
                </div>
                <div class="col-md-4">
                    <button style="background-color: #26a69a;" type="submit" class="btn btn-primary w-100" name="btnUpload">Tải lên</button>
                </div>
            </div>
        </div>
    </div>
</form>