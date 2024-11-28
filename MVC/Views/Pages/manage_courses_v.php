<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary">Manage Courses</h2>
                <a href="http://localhost/project_quanlisinhvien/manage_courses/add_course" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Add New Course
                </a>
            </div>

            <!-- Courses Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Description</th>
                            <th>Credits</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Course Rows -->
                        <tr>
                            <td>1</td>
                            <td>CS101</td>
                            <td>Introduction to Computer Science</td>
                            <td>A foundational course in CS</td>
                            <td>3</td>
                            <td>
                                <a href="http://localhost/project_quanlisinhvien/manage_courses/edit_course/CS101" class="btn btn-warning btn-sm me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="http://localhost/project_quanlisinhvien/manage_courses/delete_course/CS101" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CS102</td>
                            <td>Data Structures</td>
                            <td>Learn about data organization</td>
                            <td>4</td>
                            <td>
                                <a href="http://localhost/project_quanlisinhvien/manage_courses/edit_course/CS102" class="btn btn-warning btn-sm me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="http://localhost/project_quanlisinhvien/manage_courses/delete_course/CS102" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>