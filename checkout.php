<?php
include("connection/connect.php");
session_start();

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
    exit();
}
$user_id = $_SESSION["user_id"];

function alert_and_redirect($message, $order_id, $redirect_url)
{
    echo "<script>alert('$message Order ID: $order_id');</script>";
    echo "<script>window.location.replace('$redirect_url');</script>";
}

$total_price = 0;
$cart_items = mysqli_query($db, "SELECT * FROM `cart` WHERE u_id='$user_id'");
while ($item = mysqli_fetch_assoc($cart_items)) {
    $total_price += ($item['price'] * $item['quantity']);
}

if (isset($_POST['submit'])) {
    $payment_method = mysqli_real_escape_string($db, $_POST['payment_method']);
    $order_date = date('Y-m-d H:i:s');
    $status = 'placed';

    // Generate a numeric order ID
    $order_id = generateNumericOrderId($db);

    // Insert each product in the cart as a separate entry in users_orders table
    $cart_items = mysqli_query($db, "SELECT * FROM `cart` WHERE u_id='$user_id'");
    while ($item = mysqli_fetch_assoc($cart_items)) {
        $product_name = mysqli_real_escape_string($db, $item['name']);
        $product_quantity = mysqli_real_escape_string($db, $item['quantity']);
        $product_price = mysqli_real_escape_string($db, $item['price'] * $item['quantity']);

        $order_query = mysqli_query($db, "INSERT INTO `users_orders` (o_id, u_id, name, quantity, price, status, date, payment_method) VALUES ('$order_id', '$user_id', '$product_name', '$product_quantity', '$product_price', '$status', '$order_date', '$payment_method')");

        if (!$order_query) {
            alert_and_redirect("Order placement failed. Please try again.", "", "checkout.php");
            exit();
        }
    }

    // If all inserts are successful, clear the cart
    mysqli_query($db, "DELETE FROM `cart` WHERE u_id='$user_id'");
    alert_and_redirect("Thank you. Your Order has been placed!", $order_id, "your_orders.php");
}

// Function to generate a numeric order ID
function generateNumericOrderId($db) {
    $unique = false;
    $order_id = '';

    // Loop until a unique numeric ID is generated
    while (!$unique) {
        // Generate a numeric ID (adjust the range as needed)
        $order_id = mt_rand(10000, 99999); // Example range, adjust as per your requirements

        // Check if this ID already exists in the database
        $check_query = mysqli_query($db, "SELECT o_id FROM `users_orders` WHERE o_id = '$order_id'");
        if (mysqli_num_rows($check_query) == 0) {
            $unique = true; // ID is unique, exit loop
        }
    }

    return $order_id;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .card{
                box-shadow: 0px 0px 10px 1px white;
            }
        </style>
</head>

<body class="bg-dark">
    <div class="container my-4">
        <div class="card  col-8 mx-auto">

        <nav aria-label="breadcrumb" class="m-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="menu.php">Menu</a></li>
                <li class="breadcrumb-item"><a href="cart.php?u_id=<?php echo $user_id; ?>">My cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>

    <div class="card-body ">
        <h2 class="my-4 text-warning ">Checkout</h2>
        <form action="checkout.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Select Payment Method</label>
                        <select id="payment_method" name="payment_method" class="form-control" required>
                           
                            <option value="upi">UPI</option>
                            <option value="credit_card">Credit Card</option>
                        </select>
                    </div>
                    <div class="cart-totals margin-b-20">
                        <div class="cart-totals-title">
                            <h4>Cart Summary</h4>
                        </div>
                        <div class="cart-totals-fields">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Cart Subtotal</td>
                                        <td><?php echo "Rs." . number_format($total_price, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Delivery Charges</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td class="text-color"><strong>Total</strong></td>
                                        <td class="text-color">
                                            <strong><?php echo "Rs." . number_format($total_price, 2); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="payment-option">
                       
                        <p class="text-xs-center">
                            <input type="submit" name="submit" class="btn btn-success btn-block" value="Order Now">
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
