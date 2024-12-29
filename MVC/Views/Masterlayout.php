<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Sinh Viên</title>
    <!-- CSS -->
    <link rel="stylesheet" href="http://localhost/project_quanlisinhvien/Public/Css/Home.css">
    <link rel="stylesheet" href="http://localhost/project_quanlisinhvien/Public/Css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- JavaScript -->
    <script src="http://localhost/project_quanlisinhvien/Public/Js/popper.min.js"></script>
    <script src="http://localhost/project_quanlisinhvien/Public/Js/jquery-3.3.1.slim.min.js"></script>
    <script src="http://localhost/project_quanlisinhvien/Public/Js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- Header -->
    <header class="header bg-primary text-white py-3" style="position: fixed; top: 0; left: 0; right: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <div class="d-flex w-100 align-items-center">
            <div class="logo fs-4 fw-bold me-auto">Hệ Thống Quản Lý Sinh Viên</div>
            <nav class="nav">
                <ul class="d-flex list-unstyled mb-0">
                    <li class="me-2"><a href="http://localhost/project_quanlisinhvien/Home/" class="text-white text-decoration-none">Trang chủ</a></li>
                    <li class="me-2"><a href="#" class="text-white text-decoration-none">Hồ Sơ</a></li>
                    <li><a href="#" class="text-white text-decoration-none" data-bs-toggle="modal" data-bs-target="#logoutModal">Đăng xuất</a></li>
                </ul>
            </nav>
        </div>
    </header>





    <aside class="bg text-white" style="position: fixed; top: 60px; left: 0; bottom: 0; width: 250px; background-color: #243d55; height: 100vh; overflow-y: auto;">
        <div class="p-3">
            <h5 class="mb-3">Chức Năng</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-3">
                    <a href="http://localhost/project_quanlisinhvien/manage_students" class="nav-link text-white">
                        <i class="bi bi-people"></i> Quản Lý Sinh Viên
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#courseManagement">
                        <i class="bi bi-book"></i> Quản Lý Khóa Học
                    </a>
                    <ul id="courseManagement" class="collapse list-unstyled ps-3 text-center">
                        <li><a href="http://localhost/project_quanlisinhvien/manage_courses" class="text-white text-decoration-none">Danh Sách Khóa Học</a></li>
                        <li><a href="http://localhost/project_quanlisinhvien/registration/Get_data" class="text-white text-decoration-none">Quản Lý Đăng Ký</a></li>
                    </ul>
                </li>
                <li class="nav-item mb-3">
                    <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#Management2">
                        <i class="bi bi-journal-text"></i> Quản Lý Học Tập
                    </a>
                    <ul id="Management2" class="collapse list-unstyled ps-3 text-center">
                        <li><a href="http://localhost/project_quanlisinhvien/result_student/" class="text-white text-decoration-none">Xem Kết Quả</a></li>
                        <li><a href="http://localhost/project_quanlisinhvien/result_student/view_enter_score/" class="text-white text-decoration-none">Nhập Điểm</a></li>
                    </ul>
                </li>
                <li class="nav-item mb-3">
                    <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#Management3">
                        <i class="bi bi-cash-coin"></i> Quản Lý Học Phí
                    </a>
                    <ul id="Management3" class="collapse list-unstyled ps-3 text-center">
                        <li><a href="http://localhost/project_quanlisinhvien/manage_tuition" class="text-white text-decoration-none">Học Phí</a></li>
                        <li><a href="http://localhost/project_quanlisinhvien/payment_tuition" class="text-white text-decoration-none">Thanh Toán Học Phí</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/project_quanlisinhvien/manage_accounts/" class="nav-link text-white">
                        <i class="bi bi-person-circle"></i> Quản Lý Tài Khoản
                    </a>
                </li>
            </ul>
        </div>

    </aside>



    <!-- Main Content -->
    <div class="main-content" style="margin-left: 250px; padding: 20px; height: calc(100vh - 70px); overflow-y: auto; margin-top: 70px;">
        <?php
        if (isset($data['page'])) {
            include_once './MVC/Views/Pages/' . basename($data['page']) . '.php';
        }
        ?>
    </div>



    <!-- Footer -->
    <footer style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #007bff; color: white; text-align: center; padding: 10px; z-index: 999; box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);">
        <p class="mb-0">&copy; 2024 Student Management System. All rights reserved.</p>
    </footer>


    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Xác nhận đăng xuất</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn đăng xuất không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <a href="http://localhost/project_quanlisinhvien/LoginController/logout" class="btn btn-primary">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>