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
    <script src="Public/Js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">Student Management</div>
        <nav class="nav">
            <ul>
                <li><a href="http://localhost/project_quanlisinhvien">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Layout Container -->
    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="http://localhost/project_quanlisinhvien/manage_students">Manage Students</a></li>
                <li><a href="#">Manage Courses</a></li>
                <li><a href="#">View Grades</a></li>
                <li><a href="#">Financial Info</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <?php
            // Safely include the dynamic page content
            if (isset($data['page'])) {
                include_once './MVC/Views/Pages/' . basename($data['page']) . '.php';
            }
            ?>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Student Management System. All rights reserved.</p>
    </footer>

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