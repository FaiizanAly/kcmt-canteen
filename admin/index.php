<!DOCTYPE html>
<html lang="en">
<?php
include ("../connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!empty($_POST["submit"])) {
    $loginquery = "SELECT * FROM admin WHERE username='$username' && password='" . ($password) . "'";
    $result = mysqli_query($db, $loginquery);
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
      $_SESSION["adm_id"] = $row['adm_id'];
      header("refresh:1;url=dashboard.php");
    } else {
      echo "<script>alert('Invalid Username or Password!');</script>";
    }
  }


}

?>

<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
  body{
    background-color: black;
  }
  img{
    width: 50%;
    margin: auto;
  }
  .card {
    border-radius: 10px;
    box-shadow: 0px 0px 10px 3px white;
    background-color: #3b3737;
}
</style>


</head>

<body>


  <div class="container my-5 ">
    <div class="card col-4 text-center m-auto">
      <div class="card-header text-warning">
        <h1>Admin Panel </h1>
      </div>
      <img src="images/manager.png" class="my-3 bg-warning rounded-circle" alt="admin" >
      <span style="color:red;"><?php echo $message; ?></span>
      <div class="card-body">

        <form class="login-form" action="index.php" method="post">
          <div class="mb-3">
            <input type="text" placeholder="Username" class="form-control" name="username" />
          </div>
          <div class="mb-3">
            <input type="password" placeholder="Password" class="form-control" name="password" />
          </div>
          <input type="submit" name="submit" value="Login" class=" btn w-100 bg-warning" />

        </form>
        <a href="../index.php">home</a>


      </div>
    </div>
  </div>


    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
</body>

</html>