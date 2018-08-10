<?php
require('folder/dbconnect.php');
require('folder/bootstrap.php');

$id = $_GET['id'];
$myquery = mysqli_query($con, "DELETE FROM post WHERE id = '$id' ");
  if($myquery){
    header("Location: index.php");
  }else {
     echo "<script>alert('Something Went Wrong')</script>";
  }
 ?>
