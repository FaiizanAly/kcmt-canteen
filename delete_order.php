<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE  FROM users_orders WHERE o_num = '".$_GET['order_del']."'");
header("location:your_orders.php");  

?>
