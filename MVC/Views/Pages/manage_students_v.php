<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="layout d-flex">
        <main class="main-content flex-fill p-3">
            <h2>Manage Students</h2>
            <!-- Table for displaying students -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Ngày Sinh</th>
                        <th>Giới Tính</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($data['danhsachhocsinh']) && mysqli_num_rows($data['danhsachhocsinh']) > 0) {
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($data['danhsachhocsinh'])) {
                    ?>
                            <tr>
                                <td><?php echo (++$i); ?></td>
                                <td><?php echo $row['MaSoSV']; ?></td>
                                <td><?php echo $row['HoTen']; ?></td>
                                <td><?php echo $row['NgaySinh']; ?></td>
                                <td><?php echo $row['GioiTinh']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['SoDienThoai']; ?></td>
                                <td>
                                    <!-- Edit Button (modal trigger) -->
                                    <a href="#" class="edit-link" data-id="<?php echo $row['MaSoSV']; ?>" data-name="<?php echo $row['HoTen']; ?>" data-email="<?php echo $row['Email']; ?>" data-phone="<?php echo $row['SoDienThoai']; ?>" data-dob="<?php echo $row['NgaySinh']; ?>" data-gender="<?php echo $row['GioiTinh']; ?>" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <img src="http://localhost/project_quanlisinhvien/Public/Pictures/edit.gif" alt="Edit">
                                    </a>
                                    <!-- Delete Button (direct URL) -->
                                    <a href="http://localhost/project_quanlisinhvien/DSsinhvien/xoa/<?php echo $row['MaSoSV']; ?>">
                                        <img src="http://localhost/project_quanlisinhvien/Public/Pictures/13.png" alt="Delete">
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" class="text-center">No students found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <a href="http://localhost/project_quanlisinhvien/manage_students/addstudent" class="btn btn-success">Add New Student</a>
        </main>
    </div>

    <!-- Modal for edit student -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit student form -->
                    <form action="edit_student.php" method="POST">
                        <input type="hidden" name="id" id="studentId">
                        <div class="mb-3">
                            <label for="studentName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="studentName">
                        </div>
                        <div class="mb-3">
                            <label for="studentDob" class="form-label">Ngaysinh</label>
                            <input type="date" class="form-control" name="dob" id="studentDob">
                        </div>
                        <div class="mb-3">
                            <label for="studentGender" class="form-label">GioiTinh</label>
                            <select class="form-select" name="gender" id="studentGender">
                                <option value="Nam">Nam</option>
                                <option value="Nu">Nữ</option>
                                <option value="Khac">khác</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="studentEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="studentEmail">
                        </div>
                        <div class="mb-3">
                            <label for="studentPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="studentPhone">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    // Ensure the modal data is populated when editing
    const editLinks = document.querySelectorAll('.edit-link');
    editLinks.forEach(link => {
        link.addEventListener('click', function() {
            const studentId = this.getAttribute('data-id');
            const studentName = this.getAttribute('data-name');
            const studentEmail = this.getAttribute('data-email');
            const studentPhone = this.getAttribute('data-phone');
            const studentDob = this.getAttribute('data-dob');
            const studentGender = this.getAttribute('data-gender');

            document.getElementById('studentId').value = studentId;
            document.getElementById('studentName').value = studentName;
            document.getElementById('studentEmail').value = studentEmail;
            document.getElementById('studentPhone').value = studentPhone;
            document.getElementById('studentDob').value = studentDob;
            document.getElementById('studentGender').value = studentGender;
        });
    });
</script>