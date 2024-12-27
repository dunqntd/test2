<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="http://localhost/project_quanlisinhvien/Public/Css/Home.css">
    <link rel="stylesheet" href="http://localhost/project_quanlisinhvien/Public/Css/bootstrap.min.css">
    <script src="http://localhost/project_quanlisinhvien/Public/Js/popper.min.js"></script>
    <script src="http://localhost/project_quanlisinhvien/Public/Js/jquery-3.3.1.slim.min.js"></script>
    <script src="http://localhost/project_quanlisinhvien/Public/Js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Header -->
    <div>
        <header class="header">
            <div class="logo">Student Management</div>
            <nav class="nav">
                <ul>
                    <li><a href=" http://localhost/project_quanlisinhvien/Home/student_dashboard">Trang chủ</a></li>
                    <li><a href="#">Hồ Sơ</a></li>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Đăng xuất</a></li>
                </ul>
            </nav>
        </header>
    </div>
    <!-- Layout Container -->
    <div class="layout d-flex">
        <!-- Sidebar -->
        <div class="p-3 text-white" style="width: 250px; height: 100vh; position: fixed; background-color: #243d55; ">
            <aside>
                <h5 class="text-light mb-4">Quản Lý Sinh Viên</h5>
                <ul class="nav flex-column">
                    <!-- Đăng kí môn học -->
                    <li class="nav-item mb-2">
                        <a href="http://localhost/project_quanlisinhvien/student_registration" class="nav-link text-white">
                            <i class="bi bi-pencil-square"></i> Đăng ký môn học
                        </a>
                    </li>
                    <!-- Kết quả học tập -->
                    <li class="nav-item mb-2">
                        <a href="http://localhost/project_quanlisinhvien/StudentResults" class="nav-link text-white">
                            <i class="bi bi-clipboard"></i> Kết quả học tập
                        </a>
                    </li>
                    <!-- Môn học đã đăng ký -->
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-book"></i> Môn học đã đăng ký
                        </a>
                    </li>
                    <!-- Học phí -->
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-cash"></i> Học phí
                        </a>
                    </li>
                </ul>
            </aside>
        </div>
        <!-- Main Content -->
        <div class="main-content p-4" style="margin-left: 250px; width: calc(100% - 250px);">
            <main>
                <?php
                // Nếu có trang con, bao gồm vào đây
                if (isset($data['page'])) {
                    include_once './MVC/Views/Pages/' . basename($data['page']) . '.php';
                }
                ?>
            </main>
        </div>
    </div>
    <div class="footer text-white text-center py-3 mt-auto" style="position: fixed; bottom: 0; left: 0; width: 100%; ">
        <!-- Footer -->
        <footer>
            <p class="mb-0">&copy; 2024 Student Management System. All rights reserved.</p>
        </footer>
    </div>

    <!-- Modal -->
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