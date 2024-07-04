<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("connection/connect.php");
if (isset($_POST['submit'])) {
   if (
      empty($_POST['firstname']) ||
      empty($_POST['email']) ||
      empty($_POST['phone']) ||
      empty($_POST['department']) ||
      empty($_POST['semester']) ||
      empty($_POST['password']) ||
      empty($_POST['cpassword']) ||
      empty($_POST['cpassword'])
   ) {
      $message = "All fields must be Required!";
   } else {
      $check_username = mysqli_query($db, "SELECT username FROM users where username = '" . $_POST['username'] . "' ");
      $check_email = mysqli_query($db, "SELECT email FROM users where email = '" . $_POST['email'] . "' ");

      if ($_POST['password'] != $_POST['cpassword']) {
         echo "<script>alert('Password not match');</script>";
      } elseif (strlen($_POST['password']) < 6) {
         echo "<script>alert('Password Must be >=6');</script>";
      } elseif (strlen($_POST['phone']) < 10) {
         echo "<script>alert('Invalid phone number!');</script>";
      } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
         echo "<script>alert('Invalid email address please type a valid email!');</script>";
      } elseif (mysqli_num_rows($check_username) > 0) {
         echo "<script>alert('Username Already exists!');</script>";
      } elseif (mysqli_num_rows($check_email) > 0) {
         echo "<script>alert('Email Already exists!');</script>";
      } else {
         $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,department,semester) VALUES('" . $_POST['username'] . "','" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . ($_POST['password']) . "','" . $_POST['department'] . "','" . $_POST['semester'] . "')";
         mysqli_query($db, $mql);
         echo "<script>alert('Account Created Successfully');</script>";
         header("refresh:0.1;url=login.php");
      }
   }
}
?>

<head>
   <meta charset="utf-8">
   <title>KCMT Canteen - Food Ordering & Management</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <meta content="" name="keywords">
   <meta content="" name="description">

   <!-- aos library -->
   <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

   <!-- Icon Font Stylesheet -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

   <!-- Bootstrap Stylesheet -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

   <!-- External Css -->
   <link href="style.css" rel="stylesheet">
   <style>
      .background {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: linear-gradient(to bottom, rgb(30 27 27 / 78%), rgba(0, 0, 0, 0.5)), url(img/canteen.jpg) no-repeat center center fixed;
         background-size: cover;
         z-index: -1;
         animation: slider 5s linear forwards infinite;
      }

      .navbar-dark {
         position: fixed;
         background: hsla(40, 12%, 5%, 1) !important;
         margin: 0px;
         padding: 0;
         overflow: hidden;
         z-index: 1;
      }

      .contact-page {
         background: hsl(38deg 4.33% 23.1% / 54%);
         border-radius: 15px;
         box-shadow: 0px 0px 10px 3px #fff;
         padding: 30px;
         margin: 85px 100px;
      }

      label {
         color: hsl(38deg 84.67% 61.48%);
         font-weight: 400;
      }

      .form-control {
         border-radius: 10px;
         border-color: hsl(38, 61%, 73%);
      }
   </style>
</head>

<body data-spy="scroll" data-target="navscroll" data-offset="0">
   <div class="background"></div>
   <div class="carousel-item">
      <img src="img/canteen.jpg" alt="">
   </div>

   <header>
      <div class="container-xxl position-relative p-0">
         <nav class="navbar navbar-expand-lg  navbar-dark px-4 px-lg-5 " id="navscroll">
            <a href="" class="navbar-brand p-0 ">
               <h1 class=" m-0"><i class="fa fa-utensils me-3"></i>KCMT Canteen</h1>
            </a>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
               <a href="index.php" class="btnnn  py-2 px-4">HOME</a>
               <a href="login.php" class="btnnn  py-2 px-4 mx-lg-3 my-2">LOGIN</a>
            </div>
         </nav>
      </div>
   </header>
   <div class="page-wrapper">
      <section class="contact-page inner-page">
         <span style="color:red;"><?php echo $message; ?></span>
         <div class="container-fluid ">
            <div class="row ">
               <div class="col-md-12">
                  <div class="widget">
                     <div class="widget-body">
                        <form id="registrationForm" action="" method="post" onsubmit="return validateForm()">
                           <div class="row">
                              <div class="form-group col-sm-12">
                                 <label for="exampleInputEmail1">User-Name:</label>
                                 <input class="form-control" type="text" name="username" id="username">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputEmail1">First Name:</label>
                                 <input class="form-control" type="text" name="firstname" id="firstname">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputEmail1">Last Name:</label>
                                 <input class="form-control" type="text" name="lastname" id="lastname">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputEmail1">Email Address:</label>
                                 <input type="text" class="form-control" name="email" id="email">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputEmail1">Phone number:</label>
                                 <input class="form-control" type="text" name="phone" id="phone">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="Deparment">Deparment:</label>
                                 <input class="form-control" type="text" name="department" id="department">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="Year">Semester:</label>
                                 <input class="form-control" type="text" name="semester" id="semester">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputPassword1">Password:</label>
                                 <input type="password" class="form-control" name="password" id="password">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputPassword1">Confirm password:</label>
                                 <input type="password" class="form-control" name="cpassword" id="cpassword">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-4 ">
                                 <p> <input type="submit" value="Register" name="submit" class="btn btnnn my-2 w-100">
                                 </p>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
   <script>
      AOS.init();

      function validateForm() {
         var username = document.getElementById("username").value;
         var firstname = document.getElementById("firstname").value;
         var lastname = document.getElementById("lastname").value;
         var email = document.getElementById("email").value;
         var phone = document.getElementById("phone").value;
         var department = document.getElementById("department").value;
         var semester = document.getElementById("semester").value;
         var password = document.getElementById("password").value;
         var cpassword = document.getElementById("cpassword").value;

         if (username == "" || firstname == "" || lastname == "" || email == "" || phone == "" || department == "" || semester == "" || password == "" || cpassword == "") {
            alert("All fields must be filled out");
            return false;
         }

         if (password != cpassword) {
            alert("Passwords do not match");
            return false;
         }

         if (password.length < 6) {
            alert("Password must be at least 6 characters long");
            return false;
         }

         if (phone.length < 10) {
            alert("Invalid phone number");
            return false;
         }

         var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
         if (!emailPattern.test(email)) {
            alert("Invalid email address");
            return false;
         }

         return true;
      }
   </script>
</body>

</html>