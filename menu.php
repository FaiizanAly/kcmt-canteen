<?php
include ("connection/connect.php");
session_start();
$user_id = null;
$current_res_id = isset($_GET['res_id']) ? $_GET['res_id'] : '';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = mysqli_query($db, "SELECT * FROM users WHERE u_id='$user_id'");
    $row = mysqli_fetch_array($query);
    $username = $row['username'];
    // echo "<script>alert($username)</script>";

    if (isset($_POST['add_to_cart'])) {

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = 1;

        $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE name = '$product_name' and u_id='$user_id'");

        if (mysqli_num_rows($select_cart) > 0) {
            // $message[] = '';
            echo "<script>alert('product already added to cart')</script>";
        } else {
            $user_id = $_SESSION['user_id'];
            $insert_product = mysqli_query($db, "INSERT INTO `cart`(d_id,u_id,name, price, img, quantity) VALUES('$product_id','$user_id','$product_name', '$product_price', '$product_image', '$product_quantity')");
            // $message[] = 'product added to cart succesfully';
            echo "<script>alert('product added to cart succesfully')</script>";

        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <!-- aos library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Icon Font Stylesheet 
  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS File Link -->

    <link href="style.css" rel="stylesheet">

    <style>
        body {
            text-transform: capitalize;
            background-color: black;
        }
        nav.navbar.navbar-expand-lg.navbar-light {
            background-color: hsl(38deg 84.67% 61.48%);
        }
        .nav-item .nav-link {
            color: white;
            font-weight: bold;
        }
        .nav-item .nav-link.active {
            color: black;
            background-color: hsl(38deg 84.67% 61.48%);
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
<!-- 
            <a class="navbar-brand mx-3" href="#">Welcome 
            </a> -->
            <div class="dropdown">
  <a class=" navbar-brand dropdown-toggle fw-bold" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-user fa-fw"></i> Welcome
  <?php echo $username; ?>
    </a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="profile.php">View profile</a></li>
    <li><a class="dropdown-item" href="changepass.php">Change password</a></li>
    <li><a class="dropdown-item" href="logout.php">LogOut</a></li>
  </ul>
</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link active" aria-current="page" href="menu.php">Menu</a>
                    <a class="nav-link" href="your_orders.php">My orders</a>
                    <?php

                    $select_rows = mysqli_query($db, "SELECT * FROM `cart` where u_id='$user_id'") or die('query failed');
                    $row_count = mysqli_num_rows($select_rows);

                    ?>
                    <a class="nav-link" href="cart.php">My Cart <span
                            class="badge bg-success"><?php echo $row_count; ?></span></a>

                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <ul class="nav nav-pills my-3 justify-content-center ">
            <li class="nav-item">
                <a class="nav-link <?php echo $current_res_id == '' ? 'active' : ''; ?>" href="menu.php">All
                    Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_res_id == '1' ? 'active' : ''; ?>"
                    href="menu.php?res_id=1">Breakfast</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_res_id == '2' ? 'active' : ''; ?>"
                    href="menu.php?res_id=2">Lunch</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_res_id == '3' ? 'active' : ''; ?>"
                    href="menu.php?res_id=3">Snacks</a>
            </li>
        </ul>
    </div>
    <div class="container">
        <section class="menu" id="menu">
            <div class="container-xxl">
                <div class="row align-items-stretch justify-content-center my-5">
                    <?php
                    if ($current_res_id != '') {
                        $select_products = mysqli_query($db, "SELECT * FROM dishes WHERE rs_id = '$current_res_id'");
                    } else {
                        $select_products = mysqli_query($db, "SELECT * FROM dishes");
                    }

                    if (mysqli_num_rows($select_products) > 0) {
                        $counter = 0;
                        while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                            if ($counter % 3 == 0 && $counter != 0) {
                                echo '</div><div class="row align-items-stretch justify-content-center my-5">';
                            }
                            $counter++;
                            ?>

                            <div class="col-md-4 mb-4 " data-aos="zoom-in-up">
                                <form action="menu.php" method="post">
                                    <div class="card w-100">
                                        <img class="card-img-top"
                                            src="admin/Res_img/dishes/<?php echo $fetch_product['img']; ?>"
                                            alt="<?php echo $fetch_product['name']; ?>">
                                        <div class="card-body">
                                            <h2 class="card-title text-center"><?php echo $fetch_product['name']; ?></h2>
                                            <h3 class="card-title text-center"><?php echo $fetch_product['slogan']; ?></h3>
                                            <div class="content d-flex justify-content-around align-items-center">
                                                <h2 class="text-bold"><i
                                                        class="fas fa-rupee-sign mt-1"><?php echo $fetch_product['price']; ?>/-</i>
                                                </h2>

                                                <input type="hidden" name="product_id"
                                                    value="<?php echo $fetch_product['d_id']; ?>">
                                                <input type="hidden" name="product_name"
                                                    value="<?php echo $fetch_product['name']; ?>">
                                                <input type="hidden" name="product_price"
                                                    value="<?php echo $fetch_product['price']; ?>">
                                                <input type="hidden" name="product_image"
                                                    value="<?php echo $fetch_product['img']; ?>">

                                                <input type="submit" class="btn menubutton" value="Add Item" name="add_to_cart">
                                                <!-- <a href="#" class="btn btn-warning">Add item</a> -->
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>
                            <?php
                        }
                    } else {
                        echo '<p class="text-center">No products found!</p>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <!-- Custom JS File Link -->
    <script src="js/script.js"></script>
    <!-- aos script -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>