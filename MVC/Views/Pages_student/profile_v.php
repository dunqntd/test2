<div class="container mt-5">
    <!-- Thông tin sinh viên -->
    <h2 class="mb-5 text-center text-primary">Thông Tin Sinh Viên</h2>

    <div class="row justify-content-start">
        <!-- Thêm ảnh đại diện -->
        <div class="col-12 col-md-4 text-center mb-4">
            <?php
            $avatar = isset($data['studentInfo']['Avatar']) ? $data['studentInfo']['Avatar'] : 'default-avatar.jpg';
            ?>
            <div class="avatar-container mb-4">
                <img src="uploads/<?php echo $avatar; ?>" alt="Avatar" class="img-fluid rounded-circle avatar-img">
            </div>
            <!-- Form upload ảnh -->
            <form action="upload_avatar.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="avatar" accept="image/*" class="form-control">
                </div>
                <button type="submit" class="btn btn-info btn-block mt-3">Cập Nhật Ảnh Đại Diện</button>
            </form>
        </div>

        <!-- Thông tin sinh viên -->
        <div class="col-12 col-md-8">
            <div class="card  rounded-lg border-light mb-4">
                <div class="card-header bg-dark text-white text-center">
                    <h5 class="card-title mb-0"><?php echo $data['studentInfo']['HoTen']; ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <strong>Mã Số Sinh Viên:</strong> <span class="text-muted"><?php echo $data['studentInfo']['MaSoSV']; ?></span>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <strong>Tên Sinh Viên:</strong> <span class="text-muted"><?php echo $data['studentInfo']['HoTen']; ?></span>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <strong>Ngày Sinh:</strong> <span class="text-muted"><?php echo $data['studentInfo']['NgaySinh']; ?></span>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <strong>Giới Tính:</strong> <span class="text-muted"><?php echo $data['studentInfo']['GioiTinh']; ?></span>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <strong>Quê Quán:</strong> <span class="text-muted"><?php echo $data['studentInfo']['QueQuan']; ?></span>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <strong>Email:</strong> <span class="text-muted"><?php echo $data['studentInfo']['Email']; ?></span>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <strong>Số Điện Thoại:</strong> <span class="text-muted"><?php echo $data['studentInfo']['SoDienThoai']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-container {
        position: relative;
        width: 160px;
        height: 160px;
        overflow: hidden;
        border-radius: 50%;
        margin: 0 auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: box-shadow 0.3s ease;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .avatar-container:hover .avatar-img {
        transform: scale(1.1);
    }

    .card {
        border-radius: 20px;
        border: none;
    }

    .card-header {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .card-body {
        background-color: #f9f9f9;
        padding: 2rem;
    }

    .card-title {
        font-size: 1.6rem;
        font-weight: bold;
    }

    .text-muted {
        color: #6c757d;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
</style>