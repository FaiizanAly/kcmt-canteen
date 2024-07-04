<?php
include ("connection/connect.php");
session_start();
$user_id = $_SESSION["user_id"];
// $user_id = mysqli_real_escape_string($db, $_GET['u_id']); // Sanitize user input

if (isset($_POST['update_update_btn'])) {
   $update_value = mysqli_real_escape_string($db, $_POST['update_quantity']);
   $update_id = mysqli_real_escape_string($db, $_POST['update_quantity_id']);
   $update_quantity_query = mysqli_query($db, "UPDATE `cart` SET quantity = '$update_value' WHERE d_id = '$update_id' AND u_id='$user_id'");
   if ($update_quantity_query) {
      echo "<script>alert('Item updated successfully')</script>";
   }
}

if (isset($_GET['remove'])) {
   $remove_id = mysqli_real_escape_string($db, $_GET['remove']);
   mysqli_query($db, "DELETE FROM `cart` WHERE d_id = '$remove_id' AND u_id='$user_id'");
}

if (isset($_GET['delete_all'])) {
   mysqli_query($db, "DELETE FROM `cart` WHERE u_id='$user_id'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>
   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Bootstrap Stylesheet -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
   * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      text-transform: capitalize;
   }

   li,
   a {
      text-decoration: none;
   }

   img {
      height: 100px;
      width: 100px;
   }

   body {
      background-color:black;
   }

   .breadcrumb-item a {
      color: #007bff;
   }

   .breadcrumb-item.active {
      color: #6c757d;
   }

   .container.my-4 {
    background-color: black;
    color: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0px 10px 4px white;
}

   .table thead {
      background-color:hsl(38deg 84.67% 61.48%);
      color:black;
   }

   .table th,
   .table td {
      vertical-align: middle;
      color: white;
   }

   .alert-info {
      background-color: #e9ecef;
      border-color: #e9ecef;
      color: #6c757d;
   }
</style>

<body>
   <div class="container my-4 ">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="menu.php">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">My cart</li>
         </ol>
      </nav>

      <div class="container table-responsive">
         <section class="shopping-cart">
            <?php
            $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE u_id='$user_id'");
            $grand_total = 0;
            if (mysqli_num_rows($select_cart) > 0) {
               ?>
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        ?>
                        <tr>
                           <td><img src="admin/Res_img/dishes/<?php echo $fetch_cart['img']; ?>" alt="" class="img-thumbnail"></td>
                           <td><?php echo $fetch_cart['name']; ?></td>
                           <td>Rs.<?php echo number_format($fetch_cart['price']); ?>/-</td>
                           <td>
                              <form action="" method="post">
                                 <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['d_id']; ?>">
                                 <input type="number" name="update_quantity" min="1"style="width:50px;"
                                    value="<?php echo $fetch_cart['quantity']; ?>">
                                 <input type="submit" value="update" name="update_update_btn" class="btn btn-warning">
                              </form>
                           </td>
                           <td>Rs.<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-
                           </td>
                           <td><a href="cart.php?remove=<?php echo $fetch_cart['d_id']; ?>&u_id=<?php echo $user_id; ?>"
                                 onclick="return confirm('remove item from cart?')" class="btn btn-danger"> <i
                                    class="fas fa-trash"></i> remove</a></td>
                        </tr>
                        <?php
                        $grand_total += $sub_total;
                     }
                     ?>
                     <tr class="table-bottom">
                        <td colspan="3"><a href="menu.php" class="btn btn-warning" style="margin-top: 0;">Continue Shopping</a>
                        </td>
                        <td>Grand total</td>
                        <td>Rs.<?php echo $grand_total; ?>/-</td>
                        <td><a href="cart.php?delete_all&u_id=<?php echo $user_id; ?>"
                              onclick="return confirm('are you sure you want to delete all?');" class="btn btn-danger"> <i
                                 class="fas fa-trash"></i> delete all</a></td>
                     </tr>
                  </tbody>
               </table>
               <?php
            } else {
               // If there are no items in the cart, display a message
               echo '<div class="alert alert-info text-center" role="alert">
            <strong>There are no items in your cart.</strong>
         </div>';
            }
            ?>
            <div class="checkout-btn text-center <?= (mysqli_num_rows($select_cart) > 0) ? '' : 'd-none'; ?>">
               <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
            </div>
         </section>
      </div>
   </div>

   <!-- Bootstrap JS and Custom JS -->
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="js/script.js"></script>

</body>

</html>