<form action="http://localhost/project_quanlisinhvien/manage_students/themmoi" method="post">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Add New Student</h3>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentId" class="form-label">Student ID</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="studentId"
                                    name="student_id"
                                    placeholder="Enter Student ID"
                                    value="<?php echo isset($data['oldData']['student_id']) ? $data['oldData']['student_id'] : ''; ?>"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentName" class="form-label">Full Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="studentName"
                                    name="name"
                                    placeholder="Enter Full Name"
                                    value="<?php echo isset($data['oldData']['name']) ? $data['oldData']['name'] : ''; ?>"
                                    required>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentDob" class="form-label">Date of Birth</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="studentDob"
                                    name="dob"
                                    value="<?php echo isset($data['oldData']['dob']) ? $data['oldData']['dob'] : ''; ?>"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentGender" class="form-label">Gender</label>
                                <select class="form-select" id="studentGender" name="gender" required>
                                    <option value="" disabled>Select Gender</option>
                                    <option value="Nam" <?php echo (isset($data['oldData']['gender']) && $data['oldData']['gender'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                                    <option value="Nu" <?php echo (isset($data['oldData']['gender']) && $data['oldData']['gender'] == 'Nu') ? 'selected' : ''; ?>>Nu</option>
                                    <option value="Khac" <?php echo (isset($data['oldData']['gender']) && $data['oldData']['gender'] == 'Khac') ? 'selected' : ''; ?>>Khác</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="studentEmail" class="form-label">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="studentEmail"
                                    name="email"
                                    placeholder="Enter Email"
                                    value="<?php echo isset($data['oldData']['email']) ? $data['oldData']['email'] : ''; ?>"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="studentPhone" class="form-label">Phone</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="studentPhone"
                                    name="phone"
                                    placeholder="Enter Phone Number"
                                    value="<?php echo isset($data['oldData']['phone']) ? $data['oldData']['phone'] : ''; ?>"
                                    required>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="studentAddress" class="form-label">Address</label>
                            <input
                                type="text"
                                class="form-control"
                                id="studentAddress"
                                name="address"
                                placeholder="Enter Address"
                                value="<?php echo isset($data['oldData']['address']) ? $data['oldData']['address'] : ''; ?>"
                                required>
                        </div>


                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-4" name="btnthem">Add Student</button>
                            <a href="http://localhost/project_quanlisinhvien/manage_students/Get_data" class="btn btn-outline-secondary px-4">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>