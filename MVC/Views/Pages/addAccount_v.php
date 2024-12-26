<form action="http://localhost/project_quanlisinhvien/manage_accounts/addAccount" method="post">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Thêm Tài Khoản Mới</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Nhập email"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật Khẩu</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Nhập mật khẩu"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Nhập họ và tên"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Vai Trò</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="1">Sinh viên</option>
                                <option value="0">Quản Trị Viên</option>
                            </select>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-4">Thêm Tài Khoản</button>
                            <a href="http://localhost/project_quanlisinhvien/manage_accounts/Get_data" class="btn btn-outline-secondary px-4">Quay Lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>