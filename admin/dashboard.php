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
                    <div class="col-lg-11 my-2 mx-auto">
                        <div class="card">
                            <div class="card-header bg-warning mb-4">
                                <h4 class="m-b-0 text-dark text-center">Admin Dashboard</h4>
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <!-- row 1 -->
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card bg-dark text-white mb-4">
                                            <div class="card-body text-center"><span class="fs-3"><i
                                                        class="fa fa-home f-s-40 "></i> Total Stall </span>
                                            </div>
                                            <div class="card-footer text-center ">
                                                <h3>
                                                    3
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card bg-dark text-white mb-4">
                                            <div class="card-body text-center"><span class="fs-3"><i
                                                        class="fa fa-cutlery "></i> Total Products </span>
                                            </div>
                                            <div class="card-footer text-center ">
                                                <h3><?php $sql = mysqli_query($db, "select * from dishes");
                                                $row = mysqli_num_rows($sql);
                                                echo $row; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card bg-dark text-white mb-4">
                                            <div class="card-body text-center"><span class="fs-3"><i
                                                        class="fa fa-users f-s-40"></i> Total Users </span>
                                            </div>
                                            <div class="card-footer text-center ">
                                                <h3><?php $sql = mysqli_query($db, "select * from users");
                                                $row = mysqli_num_rows($sql);
                                                echo $row; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- row two -->
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card bg-dark text-white mb-4">
                                            <div class="card-body text-center"><span class="fs-3"><i
                                                        class="fa fa-shopping-cart f-s-40"></i> Total Orders</span>
                                            </div>
                                            <div class="card-footer text-center ">
                                                <h3><?php $sql = mysqli_query($db, "select * from users_orders");
                                                $row = mysqli_num_rows($sql);
                                                echo $row; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card bg-dark text-white mb-4">
                                            <div class="card-body text-center"><span class="fs-3"><i
                                                        class="fa fa-spinner f-s-40" aria-hidden="true"></i> Processing
                                                    Orders</span>
                                            </div>
                                            <div class="card-footer text-center ">
                                                <h3><?php $sql = mysqli_query($db, "select * from users_orders where status='process'");
                                                $row = mysqli_num_rows($sql);
                                                echo $row; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card bg-dark text-white mb-4">
                                            <div class="card-body text-center"><span class="fs-3"><i
                                                        class="fa fa-check f-s-40"></i> Delivered Orders</span>
                                            </div>
                                            <div class="card-footer text-center ">
                                                <h3><?php $sql = mysqli_query($db, "select * from users_orders where status='delivered'");
                                                $row = mysqli_num_rows($sql);
                                                echo $row; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- row three -->
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card bg-dark text-white mb-4">
                                            <div class="card-body text-center"><span class="fs-3"><i
                                                        class="fa fa-times f-s-40"></i> Cancelled Orders</span>
                                            </div>
                                            <div class="card-footer text-center ">
                                                <h3><?php $sql = mysqli_query($db, "select * from users_orders where status='cancelled'");
                                                $row = mysqli_num_rows($sql);
                                                echo $row; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card bg-dark text-white mb-4">
                                            <div class="card-body text-center"><span class="fs-3"><i
                                                        class="fa fa-rupee f-s-40"></i> Today Earning</span>
                                            </div>
                                            <div class="card-footer text-center ">
                                                <h3><?php
                                                $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM users_orders WHERE status = "placed" and  date(date)=CURRENT_DATE()');
                                                $row = mysqli_fetch_assoc($result);
                                                $sum = $row['value_sum'];
                                                echo $sum; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card bg-dark text-white mb-4">
                                            <div class="card-body text-center"><span class="fs-3"><i
                                                        class="fa fa-rupee f-s-40"></i> Total Earning</span>
                                            </div>
                                            <div class="card-footer text-center ">
                                                <h3><?php
                                                $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM users_orders WHERE status = "placed"');
                                                $row = mysqli_fetch_assoc($result);
                                                $sum = $row['value_sum'];
                                                echo $sum; ?></h3>
                                            </div>
                                        </div>
                                    </div>
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