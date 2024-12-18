<!-- enter_score_v.php - View -->
<div class="container mt-4">
    <h3>Nhập Điểm Sinh Viên</h3>
    <form action="http://localhost/project_quanlisinhvien/result_student/save_result" method="POST">
        <!-- Chọn sinh viên -->
        <div class="mb-3">
            <label for="student_id">Sinh viên</label>
            <select class="form-control" id="student_id" name="student_id" required>
                <option value="" disabled selected>-- Chọn sinh viên --</option>
                <?php foreach ($data['students'] as $student): ?>
                    <option value="<?php echo $student['MaSoSV']; ?>">
                        <?php echo $student['HoTen']; ?> (ID: <?php echo $student['MaSoSV']; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Danh sách môn học -->
        <div class="mb-3">
            <label for="courses_id">Môn học</label>
            <select id="courses_id" name="courses_id" class="form-select" required>
                <option value="" disabled selected>-- Chọn môn học --</option>
                <?php if (!empty($data['courses'])): ?>
                    <?php foreach ($data['courses'] as $course): ?>
                        <option value="<?php echo $course['MaMon']; ?>">
                            <?php echo $course['TenMon']; ?> - <?php echo $course['SoTinChi']; ?> tín chỉ
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <!-- Điểm và thông tin khác -->
        <div class="mb-3">
            <label for="Diem">Điểm</label>
            <input type="number" id="Diem" name="Diem" step="0.01" min="0" max="10" class="form-control" required placeholder="0-10">
        </div>
        <div class="mb-3">
            <label for="HocKy">Học kỳ</label>
            <select id="HocKy" name="HocKy" class="form-select" required>
                <option value="" disabled selected>-- Chọn học kỳ --</option>
                <option value="1">Học kỳ 1</option>
                <option value="2">Học kỳ 2</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="NamHoc">Năm học</label>
            <input type="text" id="NamHoc" name="NamHoc" class="form-control" placeholder="Nhập năm học" required>
        </div>

        <button type="submit" class="btn btn-primary">Lưu Điểm</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#student_id').change(function() {
            const student_id = $(this).val();
            console.log('Student ID selected:', student_id); // In ra console

            if (!student_id) {
                alert('Vui lòng chọn sinh viên!');
                return;
            }

            $.ajax({
                url: 'http://localhost/project_quanlisinhvien/result_student/get_registered_courses',
                method: 'POST',
                data: {
                    student_id: student_id
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Response received:', response); // Debug response
                    if (Array.isArray(response) && response.length > 0) {
                        $('#courses_id').empty().append('<option value="" disabled selected>-- Chọn môn học --</option>');
                        response.forEach(course => {
                            $('#courses_id').append(
                                `<option value="${course.MaMon}">${course.TenMon} - ${course.SoTinChi} tín chỉ</option>`
                            );
                        });
                    } else {
                        alert('Không tìm thấy môn học!');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.error('XHR Response:', xhr.responseText);
                }
            });
        });

    });
</script>