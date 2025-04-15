<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Nhập Điểm Sinh Viên</h3>
        </div>
        <div class="card-body">
            <form action="http://websinhvien.local/result_student/save_result" method="POST">
                <!-- Chọn sinh viên -->
                <div class="mb-4">
                    <label for="student_id" class="form-label">Sinh viên</label>
                    <select class="form-select" id="student_id" name="student_id" required>
                        <option value="" disabled selected>-- Chọn sinh viên --</option>
                        <?php foreach ($data['students'] as $student): ?>
                            <option value="<?php echo $student['MaSoSV']; ?>">
                                <?php echo $student['HoTen']; ?> (ID: <?php echo $student['MaSoSV']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Chọn học kỳ -->
                <div class="mb-4">
                    <label for="HocKy" class="form-label">Học kỳ</label>
                    <select id="HocKy" name="HocKy" class="form-select" required>
                        <option value="" disabled selected>-- Chọn học kì --</option>
                        <option value="1">Học kỳ 1</option>
                        <option value="2">Học kỳ 2</option>
                    </select>
                </div>

                <!-- Danh sách môn học -->
                <div class="mb-4">
                    <label for="courses_id" class="form-label">Môn học</label>
                    <select id="courses_id" name="courses_id" class="form-select" required>
                        <option value="" disabled selected>-- Chọn môn học --</option>
                    </select>
                </div>

                <!-- Nhập điểm -->
                <div class="mb-4">
                    <label for="Diem" class="form-label">Điểm</label>
                    <input
                        type="number"
                        id="Diem"
                        name="Diem"
                        class="form-control"
                        placeholder="Nhập điểm từ 0 đến 10"
                        step="0.01"
                        min="0"
                        max="10"
                        required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5">Lưu Điểm</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0 text-center">Nhập Điểm Bằng File</h5>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="http://websinhvien.local/result_student/uploadfile">
                <div class="row align-items-center">
                    <div class="col-md-8 mb-3 mb-md-0">
                        <input type="file" class="form-control" id="txtFile" name="txtFile" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100" name="btnUpload">Tải Lên</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#student_id, #HocKy').change(function() {
            const student_id = $('#student_id').val();
            const semester = $('#HocKy').val();

            if (student_id && semester) {
                $.ajax({
                    url: 'http://websinhvien.local/result_student/get_registered_courses',
                    method: 'POST',
                    data: {
                        student_id: student_id,
                        semester: semester
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#courses_id').empty().append('<option value="" disabled selected>-- Chọn môn học --</option>');
                        if (response.length > 0) {
                            response.forEach(course => {
                                $('#courses_id').append(
                                    `<option value="${course.MaMon}">${course.TenMon} - ${course.SoTinChi} tín chỉ</option>`
                                );
                            });
                        } else {
                            alert('Không tìm thấy môn học cho học kỳ này!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    });
</script>