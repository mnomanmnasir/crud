<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>FORM</title>
</head>

<body>
    <!-- Student Add Model -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">Student Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" class="form-control" placeholder="Enter Your First Name">

                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="lname" class="form-control" placeholder="Enter Your Last Name">

                        </div>
                        <div class="form-group">
                            <label for="">Class</label>
                            <input type="text" name="class" class="form-control" placeholder="Enter Your Class">

                        </div>
                        <div class="form-group">
                            <label for="">Section</label>
                            <input type="text" name="section" class="form-control" placeholder="Enter Your Section">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="Submit" name="save_student" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Student View Modal -->
    <div class="modal fade" id="studentVIEWModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student View Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="student_viewing_data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--End Student View Modal -->
<!-- Student Edit Modal  -->
    <div class="modal fade" id="editstudentModal" tabindex="-1" aria-labelledby="editstudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">Student Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                       <input type="hidden" name="edit_id">
                    <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="edit_fname" class="form-control" placeholder="Enter Your First Name">

                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="lname" id="edit_lname" class="form-control" placeholder="Enter Your Last Name">

                        </div>
                        <div class="form-group">
                            <label for="">Class</label>
                            <input type="text" name="class" id="edit_class" class="form-control" placeholder="Enter Your Class">

                        </div>
                        <div class="form-group">
                            <label for="">Section</label>
                            <input type="text" name="section" id="edit_section" class="form-control" placeholder="Enter Your Section">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="Submit" name="update_student" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- End Student Edit Modal  -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                        unset($_SESSION['status']);
                    }
                    ?>
                    <div class="card-header">
                        <h1>STUDENT DATA</h1>
                        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal"
                            data-bs-target="#studentModal">
                            Add Student
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "test");
                                $query = "SELECT * FROM crud";
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    // while ($row = mysqli_fetch_array($query_run)) {
                                    foreach ($query_run as $row) {
                                ?>
                                <tr>
                                    <td class="stud_id"><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['fname']; ?></td>
                                    <td><?php echo $row['lname']; ?></td>
                                    <td><?php echo $row['class']; ?></td>
                                    <td><?php echo $row['section']; ?></td>
                                    <td>
                                        <a href="" class="btn btn-primary view_btn">VIEW</a>
                                        <a href="" class="btn btn-warning edit_btn">EDIT</a>
                                        <a href="" class="btn btn-danger">DELETE</a>

                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <!-- <script src="app.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('.view_btn').click(function (e) {
                e.preventDefault();
                // alert("hello")
                var stud_id = $(this).closest('tr').find('.stud_id').text();
                // console.log(stud_id);
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'checking_view_btn': true,
                        'student_id': stud_id,
                    },
                    success: function (response) {
                        // console.log(response);
                           $(".student_viewing_data").html(response)
                            $("#studentVIEWModal").modal("show");
                    }
                });
            });

            $('.edit_btn').click(function (e) {
                e.preventDefault();
                // alert("hello")
                var stud_id = $(this).closest('tr').find('.stud_id').text();
                // console.log(stud_id);
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'checking_edit_btn': true,
                        'student_id': stud_id,
                    },
                    success: function (response) {
                        // console.log(response);
                   $.each(response, function(key, value){
                    // console.log
                    $('#edit_fname').val(value['fname']);
                    $('#edit_lname').val(value['lname']);
                    $('#edit_class').val(value['class']);
                    $('#edit_section').val(value['section']);    
                });
                            $("#editstudentModal").modal("show");
                   
                 }
                });
            });
        });
    </script>
</body>

</html>