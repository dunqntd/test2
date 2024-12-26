<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Học Sinh</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Header -->
    <header class=" p-2 ">
        <h2>Kết Quả Học Tập</h2>
    </header>

    <div class="container mt-6">
        <!-- Danh sách học sinh -->
        <table class="table table-hover table-bordered table-striped align-middle">
            <thead class="table">
                <tr>
                    <th>#</th>
                    <th>Mã sinh viên</th>
                    <th>Tên</th>
                    <th>Ngày Sinh</th>
                    <th>Giới Tính</th>
                    <th>Quê Quán</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($data['danhsachsinhvien']) && mysqli_num_rows($data['danhsachsinhvien']) > 0) {
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($data['danhsachsinhvien'])) {
                ?>
                        <tr>
                            <td><?php echo (++$i); ?></td>
                            <td><?php echo $row['MaSoSV']; ?></td>
                            <td><?php echo $row['HoTen']; ?></td>
                            <td><?php echo $row['NgaySinh']; ?></td>
                            <td><?php echo $row['GioiTinh']; ?></td>
                            <td><?php echo $row['QueQuan']; ?></td>
                            <td>
                                <a href="http://localhost/project_quanlisinhvien/result_student/view_result/<?php echo $row['MaSoSV']; ?>"
                                    class="btn btn-sm btn-info">Xem kết quả</a>
                                </a>

                            </td>
                    <?php

                    }
                }
                    ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>