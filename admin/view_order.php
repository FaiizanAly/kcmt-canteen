<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
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
                    <div class="col-lg-12">
                        <div class="card p-2">
                            <div class="card-header bg-warning mb-4">
                                <h4 class="m-b-0 text-dark text-center">All Orders</h4>
                            </div>
                            <div class="table-responsive m-t-20">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <tbody>
                                        <?php
                                        // Fetching user data
                                        $order_upd = $_GET['order_upd'];
                                        $o_num = $_GET['o_num'];

                                        $user_sql = "SELECT * FROM users WHERE u_id = '$order_upd'";
                                        $user_query = mysqli_query($db, $user_sql);
                                        $user_row = mysqli_fetch_array($user_query);

                                        // Fetching order data
                                        $order_sql = "SELECT * FROM users_orders WHERE o_num = '$o_num'";
                                        $order_query = mysqli_query($db, $order_sql);
                                        $order_row = mysqli_fetch_array($order_query);
                                        ?>

                                        <tr>
                                            <td><strong>Username:</strong></td>
                                            <td><?php echo htmlspecialchars($user_row['username']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Department:</strong></td>
                                            <td><?php echo htmlspecialchars($user_row['department']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Semester:</strong></td>
                                            <td><?php echo htmlspecialchars($user_row['semester']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Order id:</strong></td>
                                            <td><?php echo htmlspecialchars($order_row['o_id']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Product Name:</strong></td>
                                            <td><?php echo htmlspecialchars($order_row['name']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Quantity:</strong></td>
                                            <td><?php echo htmlspecialchars($order_row['quantity']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date:</strong></td>
                                            <td><?php echo htmlspecialchars($order_row['date']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                <?php 
                                                $status = $order_row['status'];
                                                if ($status == "" || $status == "pending") {
                                                    echo '<center><button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span>pending</button></center>';
                                                } elseif ($status == "Ready") {
                                                    echo '<center><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> Ready!</button></center>';
                                                } elseif ($status == "delivered") {
                                                    echo '<center><button type="button" class="btn btn-primary"><span class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button></center>';
                                                } elseif ($status == "rejected") {
                                                    echo '<center><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Cancelled</button></center>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Update Status:</strong></td>
                                            <td>
                                                <form method="post" action="">
                                                    <select name="status" class="form-select">
                                                        <option value="pending" <?php if ($status == "" || $status == "pending") echo 'selected'; ?>>Pending</option>
                                                        <option value="Ready" <?php if ($status == "Ready") echo 'selected'; ?>>Ready!</option>
                                                        <option value="delivered" <?php if ($status == "delivered") echo 'selected'; ?>>Delivered</option>
                                                        <option value="rejected" <?php if ($status == "rejected") echo 'selected'; ?>>Cancelled</option>
                                                    </select>
                                                    <input type="hidden" name="order_id" value="<?php echo $order_row['o_id']; ?>">
                                                    <button type="submit" name="update_status" class="btn btn-primary mt-2">Update</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <?php
                                        if (isset($_POST['update_status'])) {
                                            $new_status = $_POST['status'];
                                            $order_id = $_POST['order_id'];

                                            $update_sql = "UPDATE users_orders SET status='$new_status' WHERE o_num='$o_num'";
                                            if (mysqli_query($db, $update_sql)) {
                                                echo '<script>alert("Status updated successfully!"); window.location.href=window.location.href;</script>';
                                            } else {
                                                echo '<script>alert("Failed to update status.");</script>';
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>
