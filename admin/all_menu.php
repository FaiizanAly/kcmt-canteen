<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
    exit();
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
            <div class="d-flex">
                <?php include('include/sidebar.php'); ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-11 m-auto my-2">
                            <div class="col-lg-12">
                                <div class="card p-2">
                                    <div class="card-header bg-warning mb-4">
                                        <h4 class="m-b-0 text-dark text-center">All Menu</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive m-t-40">
                                            <table id="example23"
                                                class="display nowrap table table-hover table-striped table-bordered"
                                                cellspacing="0" width="100%">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Product Id</th>
                                                        <th>Stall Id</th>
                                                        <th>Name</th>
                                                        <th>Title</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM dishes order by d_id desc";
                                                    $query = mysqli_query($db, $sql);
                                                    if (!mysqli_num_rows($query) > 0) {
                                                        echo '<td colspan="6"><center>No Menu</center></td>';
                                                    } else {
                                                        while ($rows = mysqli_fetch_array($query)) {
                                                            
                                                          
                                                            echo '<tr>
                                                            <td><div class="col-md-3 col-lg-8 m-b-10">
                                                                    <center><img src="Res_img/dishes/' . $rows['img'] . '" class="img-responsive  radius" style="max-height:100px;max-width:150px;" /></center>
                                                                </div></td>
                                                            <td>' . $rows['d_id'] . '</td>
                                                                <td>' . $rows['rs_id'] . '</td>
                                                                <td>' . $rows['name'] . '</td>
                                                                <td>' . $rows['slogan'] . '</td>
                                                                <td>Rs.' . $rows['price'] . '</td>
                                                                
                                                                <td><a href="delete_menu.php?menu_del=' . $rows['d_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash" style="font-size:16px"></i></a> 
                                                                <a href="update_menu.php?menu_upd=' . $rows['d_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
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
