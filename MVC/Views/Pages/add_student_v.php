<form action="http://localhost/project_quanlisinhvien/manage_students/themmoi" method="post">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Thêm Sinh Viên</h3>
                    </div>
                    <div class="card-body">

                        <!-- Các trường thông tin sinh viên -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentId" class="form-label">Mã Sinh Viên</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="studentId"
                                    name="student_id"
                                    placeholder="Mã Sinh Viên"
                                    value="<?php echo isset($data['oldData']['student_id']) ? $data['oldData']['student_id'] : ''; ?>"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentName" class="form-label">Họ và tên</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="studentName"
                                    name="name"
                                    placeholder="Họ và tên"
                                    value="<?php echo isset($data['oldData']['name']) ? $data['oldData']['name'] : ''; ?>"
                                    required>
                            </div>
                        </div>

                        <!-- Thông tin ngày sinh và giới tính -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentDob" class="form-label">Ngày Sinh</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="studentDob"
                                    name="dob"
                                    value="<?php echo isset($data['oldData']['dob']) ? $data['oldData']['dob'] : ''; ?>"
                                    required>
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

                        <!-- Thông tin email và điện thoại -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentEmail" class="form-label">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="studentEmail"
                                    name="email"
                                    placeholder="Email"
                                    value="<?php echo isset($data['oldData']['email']) ? $data['oldData']['email'] : ''; ?>"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentPhone" class="form-label">Điện thoại</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="studentPhone"
                                    name="phone"
                                    placeholder="Điện thoại"
                                    value="<?php echo isset($data['oldData']['phone']) ? $data['oldData']['phone'] : ''; ?>"
                                    required>
                            </div>
                        </div>

                        <!-- Thông tin mật khẩu và quê quán (cùng một hàng) -->
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="studentAddress" class="form-label">Quê Quán</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="studentAddress"
                                    name="address"
                                    placeholder="Quê Quán"
                                    value="<?php echo isset($data['oldData']['address']) ? $data['oldData']['address'] : ''; ?>"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentPassword" class="form-label">Mật Khẩu</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="studentPassword"
                                    name="password"
                                    placeholder="Mật khẩu"
                                    required>
                            </div>
                        </div>

                        <!-- Các nút submit và quay lại -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-4" name="btnthem">Thêm Sinh Viên</button>
                            <a href="http://localhost/project_quanlisinhvien/manage_students/Get_data" class="btn btn-outline-secondary px-4">Quay lại danh sách</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>