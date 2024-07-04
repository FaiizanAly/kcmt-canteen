<!DOCTYPE html>
<html lang="en">
<?php
include ("../connection/connect.php");
error_reporting(0);
session_start();
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
} else {
    ?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Admin Panel</title>
        <!-- Font Awesome CDN Link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>
        <div id="main-wrapper">
            <!-- ///////////////////////////sidebar//////////////////////////////////////////// -->
            <div class="d-flex">
                <?php include ('include/sidebar.php'); ?>
                <!-- Main content here -->
                <div class="container-fluid">
                    <div class="col-lg-12 my-2 mx-auto">
                        <div class="card">
                            <div class="card-header bg-warning mb-4">
                                <h4 class="m-b-0 text-dark text-center">ALL USERS</h4>
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>User Id</th>
                                                <th>Username</th>
                                                <th>FirstName</th>
                                                <th>LastName</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Deptt.</th>
                                                <th>Sem</th>
                                                <th>Reg-Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            $sql = "SELECT * FROM users order by u_id desc";
                                            $query = mysqli_query($db, $sql);

                                            if (!mysqli_num_rows($query) > 0) {
                                                echo '<td colspan="7"><center>No Users</center></td>';
                                            } else {
                                                while ($rows = mysqli_fetch_array($query)) {



                                                    echo ' <tr><td>' . $rows['u_id'] . '</td>
                                                    <td>' . $rows['username'] . '</td>
<td>' . $rows['f_name'] . '</td>
<td>' . $rows['l_name'] . '</td>
<td>' . $rows['email'] . '</td>
<td>' . $rows['phone'] . '</td>
<td>' . $rows['department'] . '</td>																								
	<td>' . $rows['semester'] . '</td>																								
						<td>' . $rows['date'] . '</td>

                        <td><a href="delete_users.php?user_del=' . $rows['u_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash" style="font-size:16px"></i></a> 
	 <a href="update_users.php?user_upd=' . $rows['u_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
									</td></tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
}
?>