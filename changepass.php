<?php session_start();
include_once ('connection/connect.php');
if (strlen($_SESSION['user_id'] == 0)) {
    header('location:logout.php');
} else {
    //Code for Updation 
    // for  password change   
    if (isset($_POST['update'])) {
        $oldpassword = $_POST['currentpassword'];
        $newpassword = $_POST['newpassword'];
        $sql = mysqli_query($db, "SELECT password FROM users where password='$oldpassword'");
        $num = mysqli_fetch_array($sql);
        if ($num > 0) {
            $userid = $_SESSION['user_id'];
            $ret = mysqli_query($db, "update users set password='$newpassword' where u_id='$userid'");
            echo "<script>alert('Password Changed Successfully !!');</script>";
            echo "<script type='text/javascript'> document.location = 'changepass.php'; </script>";
        } else {
            echo "<script>alert('Old Password not match !!');</script>";
            echo "<script type='text/javascript'> document.location = 'changepass.php'; </script>";
        }
    }


    ?>



    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script language="javascript" type="text/javascript">
            
            function valid() {
                if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                    alert("Password and Confirm Password Field do not match  !!");
                    document.changepassword.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
        <title>changepassword</title>
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

            .table thead {
                background-color: hsl(38deg 84.67% 61.48%);
                color: black;
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
            <div class="container-fluid px-4">


                <h1 class="my-5  text-center text-warning">Change Password</h1>
                <div class="card col-10 col-md-6 mb-4 m-auto">
                    <form method="post" name="changepassword" onSubmit="return valid();">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Current Password</th>
                                    <td><input class="form-control" id="currentpassword" name="currentpassword"
                                            type="password" value="" required /></td>
                                </tr>
                                <tr>
                                    <th>New Password</th>
                                    <td><input class="form-control" id="newpassword" name="newpassword" type="password"
                                            value="" required /></td>
                                </tr>
                                <tr>
                                    <th>Confirm Password</th>
                                    <td colspan="3"><input class="form-control" id="confirmpassword" name="confirmpassword"
                                            type="password" required /></td>
                                </tr>

                                <tr>
                                    <td><a href="menu.php" class="btn btn-warning">Back</a></td>
                                    <td colspan="4" style="text-align:center ;"><button type="submit"
                                            class="btn btn-success btn-block" name="update">Change</button></td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>


            </div>
        </main>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    </body>

    </html>
<?php } ?>