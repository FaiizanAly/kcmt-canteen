<?php
include ("connection/connect.php");
session_start();

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
    exit();
} else {

    $user_id = $_SESSION["user_id"];

    // Fetch user's orders from the database
    $user_orders_query = mysqli_query($db, "SELECT * FROM `users_orders` WHERE u_id='$user_id' ORDER BY  date DESC");

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Orders</title>
        <!-- Font Awesome CDN Link -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <!-- Bootstrap Stylesheet -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Custom CSS -->
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .card {
                background-color: black;
                color: black;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 0px 10px 4px white;
            }
            .table th
            {
                color:black;
            }
            .table td {
                vertical-align: middle;
                color: white;
            }
        </style>
    </head>
    <body class="bg-dark">
        <main>
            <div class="container col-12  ">
                <div class="card col-12 col-md-10 m-auto ">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="menu.php">Menu</a></li>
                            <li class="breadcrumb-item"><a href="cart.php?u_id=<?php echo $user_id; ?>">My cart</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                        </ol>
                    </nav>
                    <div class="card-body ">
                        <?php
                        if (mysqli_num_rows($user_orders_query) > 0) {
                            $orders = [];
                            while ($row = mysqli_fetch_assoc($user_orders_query)) {
                                $orders[$row['o_id']][] = $row;
                            }
                            ?>
                            <table class="table table-bordered">
                                <thead class="bg-warning ">
                                    <tr>
                                        <th>Order ID</th>
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
                                                echo "<td rowspan='$rowspan'>" . $item['o_id'] . "</td>";
                                                $first = false;
                                            }
                                            echo '<td>' . htmlspecialchars($item['name']) . '</td>
                                                            <td>' . htmlspecialchars($item['quantity']) . '</td>
                                                            <td>' . htmlspecialchars($item['price']) . '</td>
                                                            <td>' . htmlspecialchars($item['status']) . '</td>
                                                            <td>' . htmlspecialchars($item['payment_method']) . '</td>
                                                            <td>' . htmlspecialchars($item['date']) . '</td>
                                                            <td>
                                                                <a href="delete_order.php?order_del=' . htmlspecialchars($item['o_num']) . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash" style="font-size:16px"></i></a>

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
        </main>
        <!-- Bootstrap JS and Custom JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </body>

    </html>
<?php } ?>
