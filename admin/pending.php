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
                                        <h4 class="m-b-0 text-dark text-center">Pending Orders</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $user_orders_query = mysqli_query($db, "SELECT * FROM `users_orders` where `status`='placed' ORDER BY date DESC");
                                        if (mysqli_num_rows($user_orders_query) > 0) {
                                            $orders = [];
                                            while ($row = mysqli_fetch_assoc($user_orders_query)) {
                                                $orders[$row['o_id']][] = $row;
                                            }
                                            ?>
                                            <table class="table table-bordered">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>User ID</th>
                                                        <th>Name</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Status</th>
                                                        <th>Payment Method</th>
                                                        <th>Time</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($orders as $o_id => $order_items) {
                                                        $rowspan = count($order_items);
                                                        $first = true;
                                                        foreach ($order_items as $item) {
                                                            echo "<tr>";
                                                            if ($first) {
                                                                echo "<td rowspan='$rowspan'>" . htmlspecialchars($item['o_id']) . "</td>";
                                                                echo "<td rowspan='$rowspan'>" . htmlspecialchars($item['u_id']) . "</td>";
                                                                $first = false;
                                                            }
                                                            echo '<td>' . htmlspecialchars($item['name']) . '</td>
                                                            <td>' . htmlspecialchars($item['quantity']) . '</td>
                                                            <td>' . htmlspecialchars($item['price']) . '</td>
                                                            <td>' . htmlspecialchars($item['status']) . '</td>
                                                            <td>' . htmlspecialchars($item['payment_method']) . '</td>
                                                            <td>' . htmlspecialchars($item['date']) . '</td>
                                                            <td>
                                                                <a href="delete_orders.php?order_del=' . htmlspecialchars($item['o_num']) . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash" style="font-size:16px"></i></a>
                                                                <a href="view_order.php?order_upd=' . htmlspecialchars($item['u_id']) . '&o_num=' . htmlspecialchars($item['o_num']) . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                                                            </td></tr>';
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="alert alert-info" role="alert">
                                                <strong>No orders found!</strong> You haven't placed any orders yet.
                                            </div>
                                            <?php
                                        }
                                        ?>
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
