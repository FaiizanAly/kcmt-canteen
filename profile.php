<?php session_start();
include_once ('connection/connect.php');
if (strlen($_SESSION['user_id'] == 0)) {
  header('location:logout.php');
} else {

  ?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }


      .card {
        background-color: black;
        color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0px 10px 4px white;
      }


      .table th,
      .table td {
        vertical-align: middle;
        color: white;
      }
    </style>
  </head>

  <body class="bg-dark">
    <main>
      <div class="container-fluid px-4 ">
        <?php
        $userid = $_SESSION['user_id'];
        $query = mysqli_query($db, "select * from users where u_id='$userid'");
        while ($result = mysqli_fetch_array($query)) { ?>
          <h1 class="my-4 text-center text-warning text-capitalize"><?php echo $result['f_name']; ?> Profile</h1>
          <div class="card col-md-6 col-10 mb-4 mx-auto">
            

          <div class="card-body ">
            <a href="menu.php" class="btn btn-warning my-3">Back</a>
            <a href="edit_userprofile.php" class="btn btn-danger m-3">Edit</a>

            <table class="table  table-bordered table-striped">
              <tr>
                <th>First Name</th>
                <td><?php echo $result['f_name']; ?></td>
              </tr>
              <tr>
                <th>Last Name</th>
                <td><?php echo $result['l_name']; ?></td>
              </tr>
              <tr>
                <th>Email</th>
                <td colspan="3"><?php echo $result['email']; ?></td>
              </tr>
              <tr>
                <th>Contact No.</th>
                <td colspan="3"><?php echo $result['phone']; ?></td>
              </tr>
              <tr>
                <th>Department.</th>
                <td colspan="3"><?php echo $result['department']; ?></td>
              </tr>
              <tr>
                <th>Semester.</th>
                <td colspan="3"><?php echo $result['semester']; ?></td>
              </tr>
              
              <tr>
                <th>Reg. Date</th>
                <td colspan="3"><?php echo $result['date']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <?php } ?>
      
      
    </div>
    </main>



    <!--  Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>

  </body>

  </html>
<?php } ?>