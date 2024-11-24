<form action="http://localhost/project_quanlisinhvien/manage_students/themmoi" method="post">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Add New Student</h3>
                    </div>
                    <div class="card-body">
                        <form action="process_add_student.php" method="POST">
                            <!-- Row 1: Student ID and Full Name -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="studentId" class="form-label">Student ID</label>
                                    <input type="text" class="form-control" id="studentId" name="student_id" placeholder="Enter Student ID" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="studentName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="studentName" name="name" placeholder="Enter Full Name" required>
                                </div>
                            </div>
                            <!-- Row 2: Date of Birth and Gender -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="studentDob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="studentDob" name="dob" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="studentGender" class="form-label">Gender</label>
                                    <select class="form-select" id="studentGender" name="gender" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nu">Nu</option>
                                        <option value="Khac">Khac</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Row 3: Email and Phone -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="studentEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="studentEmail" name="email" placeholder="Enter Email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="studentPhone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="studentPhone" name="phone" placeholder="Enter Phone Number" required>
                                </div>
                            </div>
                            <!-- Row 4: Address (Quê quán) -->
                            <div class="mb-3">
                                <label for="studentAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="studentAddress" name="address" placeholder="Enter Address" required>
                            </div>
                            <!-- Buttons -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success px-4" name=btnthem>Add Student</button>
                                <a href="index.php" class="btn btn-outline-secondary px-4">Back to List</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>