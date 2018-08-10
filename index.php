<?php
require('folder/dbconnect.php');
require('folder/bootstrap.php');

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
    <title>Quora</title>
  </head>
  <body>
    <div class="container">

    <?php require("menu_bar.php"); ?>

    <h1 class="text-center related-text">All POSTS</h1>

     <div class="row">

           <?php
              $query = mysqli_query($con, "SELECT * FROM post");
              while($a = mysqli_fetch_array($query)){
                ?>
                   <div class="col-sm-3 col-xs-6">
                     <a href="post.php?id=<?php echo $a['id'];  ?>">
                     <div class="post_box">
                       <div class="img">
                         <?php if(isset($a['img']) && !empty($a['img'])){
                            echo '<img src="uploads/'.$a['img'].'" alt="640x480.png">';
                         }else{
                           echo '<img src="assets/img/640x480.png" alt="640x480.png">';
                         }
                            ?>
                       </div>
                      <?php
                        echo "<h3>".$a['post_title']."</h3>";
                       ?>
                     </div>
                     </a>
                   </div>
               <?php
             }
           ?>

     </div>
   </div>
  </body>
</html>
