<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("../connection/connect.php");

if(isset($_POST['submit'] ))
{
	$mql = "update users set username='$_POST[uname]', f_name='$_POST[fname]', l_name='$_POST[lname]',email='$_POST[email]',phone='$_POST[phone]',password='".$_POST['password']."' where u_id='$_GET[user_upd]' ";
	mysqli_query($db, $mql);
			$success = 	
                                                                '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>User Updated!.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
	
    }
	


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
            <!-- ///////////////////////////sidebar//////////////////////////////////////////// -->
            <div class="d-flex">
                <?php include ('include/sidebar.php'); ?>
                <!-- Main content here -->
                <div class="container-fluid">
                <div class="row">
                   <div class="container-fluid">
                                  <?php  
                                          echo $success; 
                                          
                                          ?>
                      <div class="col-lg-10 mx-auto my-5">
                      <div class="card ">
                      <div class="card-header bg-warning mb-4">
                                <h4 class="m-b-0 text-dark text-center">Admin Dashboard</h4>
                            </div>
                          <div class="card-body">
                            <?php $ssql ="select * from users where u_id='$_GET[user_upd]'";
                                                  $res=mysqli_query($db, $ssql); 
                                                  $newrow=mysqli_fetch_array($res);?>
                              <form action='' method='post'  >
                                  <div class="form-body">
                                    
                                      
                                      <div class="row p-t-20">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="control-label">Username</label>
                                                  <input type="text" name="uname" class="form-control" value="<?php  echo $newrow['username']; ?>" placeholder="username">
                                                 </div>
                                          </div>
                                   
                                          <div class="col-md-6">
                                              <div class="form-group has-danger">
                                                  <label class="control-label">First-Name</label>
                                                  <input type="text" name="fname" class="form-control form-control-danger"  value="<?php  echo $newrow['f_name'];  ?>" placeholder="jon">
                                                  </div>
                                          </div>
                                    
                                      </div>
                                  
                                      <div class="row my-2">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="control-label">Last-Name </label>
                                                  <input type="text" name="lname" class="form-control" placeholder="doe"  value="<?php  echo $newrow['l_name']; ?>">
                                                 </div>
                                          </div>
                                   
                                          <div class="col-md-6">
                                              <div class="form-group has-danger">
                                                  <label class="control-label">Email</label>
                                                  <input type="text" name="email" class="form-control form-control-danger"  value="<?php  echo $newrow['email'];  ?>" placeholder="example@gmail.com">
                                                  </div>
                                          </div>
                                      
                                      </div>
                                      <div class="row my-2">

                                      <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="control-label">Phone</label>
                                                  <input type="text" name="phone" class="form-control form-control-danger"   value="<?php  echo $newrow['phone'];  ?>" placeholder="phone">
                                                  </div>
                                              </div>
                                 
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="control-label">Password</label>
                                                  <input type="text" name="password" class="form-control form-control-danger"   value="<?php  echo $newrow['password'];  ?>" placeholder="password">
                                                  </div>
                                      
                                         
                                          </div>
                               
                                          
                                    
                                      
                                      </div>
                                      <div class="row my-2">

                                      <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="control-label">Department</label>
                                                  <input type="text" name="department" class="form-control form-control-danger"   value="<?php  echo $newrow['department'];  ?>" placeholder="department">
                                                  </div>
                                              </div>
                                 
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="control-label">Semester</label>
                                                  <input type="text" name="semester" class="form-control form-control-danger"   value="<?php  echo $newrow['semester'];  ?>" placeholder="semester">
                                                  </div>
                                      
                                         
                                          </div>
                               
                                          
                                    
                                      
                                      </div>
                                  </div>
                                  <div class="form-actions">
                                      <input type="submit" name="submit" class="btn btn-warning" value="Save"> 
                                      <a href="all_users.php" class="btn btn-inverse">Cancel</a>
                                  </div>
                              </form>
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
  
