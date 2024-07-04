<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();




if(isset($_POST['submit']))           //if upload btn is pressed
{
	
			
		
			
		  
		
	
		
				$fname = $_FILES['file']['name'];
								$temp = $_FILES['file']['tmp_name'];
								$fsize = $_FILES['file']['size'];
								$extension = explode('.',$fname);
								$extension = strtolower(end($extension));  
								$fnew = uniqid().'.'.$extension;
   
								$store = "Res_img/dishes/".basename($fnew);                     
				                                 
												$sql = "update dishes set name='$_POST[d_name]',slogan='$_POST[description]',price='$_POST[price]',img='$fnew' where d_id='$_GET[menu_upd]'";
												mysqli_query($db, $sql); 
												move_uploaded_file($temp, $store);
			  
													$success = 	'<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>Succesfully Updated.
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
            <div class="d-flex">
                <?php include('include/sidebar.php'); ?>
                <div class="container-fluid">
        
                  
									
        <?php  echo $error;
                echo $success; ?>
        
        
    
    
<div class="col-lg-12">
<div class="card card-outline-primary">
<div class="card-header bg-warning mb-4">
                                        <h4 class="m-b-0 text-dark text-center">Update Menu</h4>
                                    </div>
<div class="card-body">
    <form action='' method='post'  enctype="multipart/form-data">
        <div class="form-body">
            <?php $qml ="select * from dishes where d_id='$_GET[menu_upd]'";
                        $rest=mysqli_query($db, $qml); 
                        $roww=mysqli_fetch_array($rest);
                            ?>
            <div class="row p-t-20">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Dish Name</label>
                        <input type="text" name="d_name" value="<?php echo $roww['name'];?>" class="form-control" placeholder="Morzirella">
                       </div>
                </div>
    
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <label class="control-label">About</label>
                        <input type="text" name="description" value="<?php echo $roww['slogan'];?>" class="form-control form-control-danger" placeholder="slogan">
                        </div>
                </div>
 
            </div>
     
            <div class="row p-t-20">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Price </label>
                        <input type="text" name="price" value="<?php echo $roww['price'];?>"  class="form-control" placeholder="$">
                       </div>
                </div>
     
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <label class="control-label">Image</label>
                        <input type="file" name="file"  id="lastName" class="form-control form-control-danger"
                        value="<?php echo $roww['img'];?> placeholder="12n">
                        </div>
                </div>
            </div>
        
            
    
           
         
            </div>
        </div>
        <div class="form-actions m-4">
            <input type="submit" name="submit" class="btn btn-warning" value="Save"> 
            <a href="all_menu.php" class="btn btn-inverse">Cancel</a>
        </div>
    </form>
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




