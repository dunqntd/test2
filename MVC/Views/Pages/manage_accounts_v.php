<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>



    <form action="http://localhost/project_quanlisinhvien/manage_accounts/timkiem" method="post">

        <div class="container mt-6">
            <div class="d-flex justify-content-between mb-2">
                <h4>Danh sách tài khoản</h4>
            </div>
            <div class="form-inline">
                <label for="myemail">Email: </label>
                <input type="text" class="form-control1" id="myemail" name="txtemail" value="<?php if (isset($data['email'])) echo $data['email'] ?>">

                <label style="margin-left: 1cm; " for="myname">Họ và tên: </label>
                <input type="text" class="form-control1" id="myname" placeholder="" name="txtname" value="<?php if (isset($data['name'])) echo $data['name'] ?>">

                <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnTimkiem">Tìm Kiếm</button>
                <!-- <button type="submit" class="btn btn-success" name="btnXuatExcel" style="margin-left: 230px;">
                    Xuất Excel
                </button> -->
            </div>

            <br>
            <table class="table table-bordered table-striped">
                <thead class="table">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Mật khẩu</th>
                        <th>Vai trò</th>
                        <th>Tên</th>
                        <th>Ngày tạo</th>
                        <th>Cập nhật lần cuối</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['accounts'])): $i = 0; ?>

                        <?php foreach ($data['accounts'] as $account): ?>

                            <tr>
                                <td><?php echo (++$i); ?></td>
                                <td><?php echo $account['email']; ?></td>
                                <td><?php echo $account['password']; ?></td>
                                <td><?php echo $account['role'] == 0 ? 'Quản trị' : 'Sinh viên'; ?></td>
                                <td><?php echo $account['name']; ?></td>
                                <td><?php echo $account['created_at']; ?></td>
                                <td><?php echo $account['updated_at']; ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editAccountModal"
                                        type="button"
                                        onclick="setEditAccountData(<?php echo htmlspecialchars(json_encode($account), ENT_QUOTES, 'UTF-8'); ?>)">
                                        Sửa
                                    </button>

                                    <a href="http://localhost/project_quanlisinhvien/manage_accounts/delete/<?php echo $account['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?')">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Không có tài khoản nào!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <a href="http://localhost/project_quanlisinhvien/manage_accounts/view_addAccount" class="btn btn-success">Thêm Tài Khoản</a>

        </div>

    </form>

    <!-- Modal Sửa Tài Khoản -->
    <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="update_account">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAccountModalLabel">Sửa tài khoản</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editAccountId" name="id">
                        <div class="mb-3">
                            <label for="editAccountEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editAccountEmail" name="email" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editAccountPassword" class="form-label">Mật khẩu</label>
                            <input type="text" class="form-control" id="editAccountPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAccountRole" class="form-label">Vai trò</label>
                            <select class="form-select" id="editAccountRole" name="role" required>
                                <option value="1">Sinh viên</option>
                                <option value="0">Quản trị</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editAccountName" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="editAccountName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function setEditAccountData(account) {
            document.getElementById('editAccountId').value = account.id;
            document.getElementById('editAccountEmail').value = account.email;
            document.getElementById('editAccountPassword').value = account.password;
            document.getElementById('editAccountRole').value = account.role;
            document.getElementById('editAccountName').value = account.name;
        }

        function confirmDelete(accountId) {
            if (confirm('Bạn có chắc chắn muốn xóa tài khoản này?')) {
                // Gửi yêu cầu xóa tới server
                window.location.href = `http://localhost/project_quanlisinhvien/manage_accounts/delete/${accountId}`;
            }
        }
    </script>
</body>

</html>