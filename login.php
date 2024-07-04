<!DOCTYPE html>
<html lang="en">
<?php
session_start();

  include ("connection/connect.php");
  $message='';
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($_POST['submit'])) {
      $loginquery = "SELECT * FROM users WHERE username='$username' && password='" . ($password) . "'"; //selecting matching records
      $result = mysqli_query($db, $loginquery); //executing
      $row = mysqli_fetch_array($result);

      if (is_array($row)) {
        
        $_SESSION["user_id"] = $row['u_id'];
        header("refresh:1;url=menu.php");
      } else {
        $message = "Invalid Username or Password!";
      }
    }
  }
  ?>

<head>
  <meta charset="utf-8">
  <title>Canteen food ordering and management system</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Bootstrap Stylesheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- External Css -->
  <link href="style.css" rel="stylesheet">
  <style>
    .background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgb(30 27 27 / 78%), rgba(0, 0, 0, 0.8)), url(img/canteen.jpg) no-repeat center center fixed;
      background-size: cover;
      /* opacity: 0.5; */
      z-index: -1;
      animation: slider 5s linear forwards infinite;
    }

    .navbar-dark {
      position: fixed;
      background: hsla(40, 12%, 5%, 1) !important;
      margin: 0px;
      padding: 0;
      overflow: hidden;

    }

    .container {
      width: 350px;
      border-radius: 10px ;
      margin-top: 150px;
      box-shadow: 0px 0px 16px 2px white;
      padding: 41px;
      background-color: #0000009e;
    }
    label{
      color:  hsl(38deg 84.67% 61.48%);
    }
    .btn{
      background-color:  hsl(38deg 84.67% 61.48%);
    }
    
    .bnt{
      margin: auto;
    }
  </style>
</head>
<!-- /////////////////////////navbar//////////////////////////////////////// -->

<body>
  <div class="background"></div>
  <header>
    <div class="container-xxl position-relative p-0">
      <nav class="navbar navbar-expand-lg  navbar-dark px-4 px-lg-5 " id="navscroll">
        <a href="" class="navbar-brand p-0 ">
          <h1 class=" m-0"><i class="fa fa-utensils me-3"></i>KCMT Canteen</h1>
        </a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- nav div -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">

          <!-- btn -->
          <a href="index.php" class="btnnn  py-2 px-4">HOME</a>
          <a href="admin/index.php" class="btnnn  py-2 px-4 mx-lg-3 my-2">ADMIN LOGIN</a>
        </div>
      </nav>
    </div>
  </header>
  <!-- ///////////////////////////////////////////check user in the database////////////////////// -->
  
  <!-- ////////////////////////////////////////////////form///////////////////////////////// -->

  <div class="container ">
    <div class="login-container">
      <h1 class="text-center text-light">User Login</h1>
      <span style="color:red;"><?php echo $message; ?></span>
      <form action="" method="post">
        <div class="form-group mb-3">
          <label for="username">Username:</label>
          <input type="text" class="form-control " name="username" placeholder="Enter Username" required>
        </div>
        <div class="form-group mb-3">
          <label for="password">Password:</label>
          <input type="password" class="form-control" name="password" placeholder=" Enter Password" required>
        </div>
        <input type="submit" class="btn form-control w-100 " name="submit">
      </form>
    </div>
    <div class="cta mt-3 text-center text-light">Not registered?<a href="registration.php" style="color:#5c4ac7;"> Create
        an account</a></div>
  </div>
  </div>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- aos script -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
</body>

</html>
