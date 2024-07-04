<?php
session_start();
include_once ('connection/connect.php');
if (strlen($_SESSION['user_id'] == 0)) {
    header('location:logout.php');
} else {
    $userid = $_SESSION['user_id'];
    //Code for Updation 
    if (isset($_POST['update'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $department = $_POST['department'];
        $semester = $_POST['semester'];
        $userid = $_SESSION['user_id'];
        $msg = mysqli_query($db, "update users set f_name='$fname',l_name='$lname',phone='$phone',department='$department',semester='$semester' where u_id='$userid'");

        if ($msg) {
            echo "<script>alert('Profile updated successfully');</script>";
            echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
        }
    }



    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Hello, world!</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            .card {
                background-color: black;
                color: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 0px 10px 4px white;

            }

            .table thead {
                background-color: hsl(38deg 84.67% 61.48%);
                color: black;
            }

            .table th,
            .table td {
                vertical-align: middle;
                color: white;
            }
        </style>
    </head>

    <body class="bg-dark">
        <main>
            <div class="container-fluid px-4 ">

                <?php
                
                $query = mysqli_query($db, "select * from users where u_id='$userid'");
                while ($result = mysqli_fetch_array($query)) { ?>
                    <h1 class="my-3 text-center text-warning text-capitalize"><?php echo $result['f_name']; ?> Profile</h1>
                    <div class="card col-10 col-md-6  mb-4 mx-auto">
                        <form method="post">
                            <div class="card-body ">


                                <table class="table table-bordered col-md-6 col-sm-10 col-xs-10">
                                    <tbody>
                                        <tr>
                                            <th>Username</th>
                                            <td><?php echo $result['username']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>First Name</th>
                                            <td><input class="form-control" id="fname" name="fname" type="text"
                                                    value="<?php echo $result['f_name']; ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td><input class="form-control" id="lname" name="lname" type="text"
                                                    value="<?php echo $result['l_name']; ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Contact No.</th>
                                            <td><input class="form-control" id="contact" name="phone" type="text"
                                                    value="<?php echo $result['phone']; ?>" pattern="[0-9]{10}"
                                                    title="10 numeric characters only" maxlength="10" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td><input class="form-control" id="department" name="department" type="text"
                                                    value="<?php echo $result['department']; ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Semester</th>
                                            <td><input class="form-control" id="semester" name="semester" type="text"
                                                    value="<?php echo $result['semester']; ?>" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?php echo $result['email']; ?></td>
                                        </tr>



                                        <tr>
                                            <th>Reg. Date</th>
                                            <td><?php echo $result['date']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"> <a href="profile.php" class="btn btn-warning ">Back</a></td>
                                            <td colspan="2" style="text-align:center ;"><button type="submit"
                                                    class="btn btn-success  btn-block" name="update">Update</button></td>

                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </form>
                    </div>
                <?php } ?>

            </div>
        </main>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    </body>

    </html>
<?php } ?>