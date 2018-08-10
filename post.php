<?php
require('folder/dbconnect.php');
require('folder/bootstrap.php');


$id = $_GET['id'];
$type = "post";

$query=mysqli_query($con, "SELECT * FROM post WHERE id='$id'");
$a = mysqli_fetch_array($query);

// for posting comment
if (isset($_POST['submit'])) {
  $comment = $_POST['comment'];
  $myquery = mysqli_query($con, "INSERT INTO comment (post_id,comment) VALUES('$id','$comment')");
  if($myquery){
    // echo "<script>alert('Comment Posted Successfully')</script>";
  }else {
     echo "<script>alert('Something Went Wrong')</script>";
  }
}

 // for update comment
if (isset($_POST['save'])) {
  $comment = $_POST['comment'];
    $comment_id = $_POST['comment_id'];
  $myquery = mysqli_query($con, "UPDATE comment SET comment = '$comment' WHERE id = $comment_id ");
  if($myquery){
    // echo "<script>alert('Comment Saved Successfully')</script>";
  }else {
     echo "<script>alert('Something Went Wrong')</script>";
  }
}

// for delete comment
if(isset($_POST['delete'])){
  $comment_id = $_POST['comment_id'];
  $myquery = mysqli_query($con, "DELETE FROM comment WHERE id = '$comment_id' ");
  if($myquery){
    // echo "<script>alert('Comment Deleted Successfully')</script>";
  }else {
     echo "<script>alert('Something Went Wrong')</script>";
  }
}
if (isset($_POST['img'])){

}
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Post</title>
     <link rel="stylesheet" href="assets/css/style.css">
     <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
   </head>
   <body>


<section id="postSection">

<div class="container">

    <?php require("menu_bar.php"); ?>

    <!-- <button type="submit" name="submit">Delete </button> -->

       <div class="row">
         <!-- showing post title -->
         <div class="col-sm-12">
           <h1 class="post_title"><?php echo $a['post_title']; ?></h1>
         </div>
         <!-- /showing post title -->
       </div>
       <div class="row">

         <!-- showing posts -->
         <div class="col-sm-8">
           <p><?php echo $a['post']; ?></p>
         </div>
         <!-- /showing posts -->

         <!-- showing feature image -->
         <div class="col-md-4">
           <h4>Feature Image</h4>
           <?php if(isset($a['img']) && !empty($a['img'])){ ?>
           <div class="image-box">
             <img src="uploads/<?php echo $a['img']; ?>" alt="">
           </div>
         <?php }else{
           echo "<img src='assets/img/640x480.png' width='300'><br><br>";
         } ?>
           <form class="" action="uploads/uploadsimg.php" method="post" enctype="multipart/form-data">
             <input type="hidden" name="post_id" value="<?php echo $a['id']; ?>">
             <input type="file" name="fileToUpload" id="fileToUpload"><br>
             <button type="submit" class="btn btn-info" name="submit">upload</button>
           </form>
         </div>
         <!-- /showing feature image -->
       </div>
<hr>
<!-- for related post -->
<?php
  $mypostquery = mysqli_query($con,"SELECT * FROM post ORDER BY id desc");
  $j = 1;
  while($j<=5 && $a = mysqli_fetch_array($mypostquery)){
        $post_title[$j] = $a['post_title'];
        $img[$j] = $a['img'];
        $post_id[$j] = $a['id'];
    $j+=1;
  }
 ?>

  <div class="related_post">
    <h3 class="ml-2">View Recent Posts: </h1>
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-6">
          <div class="col-sm-12">
            <a href="post.php?id=<?php echo $post_id[1]; ?>">
            <div class="img-box">
              <?php
                if ($img[1] == true) {
                  echo '<img src="uploads/'.$img[1].'" style="width:100%;" alt="">';
                }else {
                  echo '<img src="assets/img/640x480.png" style="width:100%;" alt="">';

                }
               ?>
              <p><?php echo $post_title[1]; ?></p>
            </div>
          </a>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="col-sm-6">
            <a href="post.php?id=<?php echo $post_id[2]; ?>">
            <div class="img-box2">
              <?php
                  if ($img[2] == true) {
                    echo '<img src="uploads/'.$img[2].'" style="width:100%;" alt="">';
                  }else {
                    echo '<img src="assets/img/640x480.png" style="width:100%;" alt="">';

                  }
               ?>
                <p><?php echo $post_title[2]; ?></p>
            </div>
          </a>
          </div>
            <div class="col-sm-6">
                <a href="post.php?id=<?php echo $post_id[3]; ?>">
              <div class="img-box2">
              <?php
                if ($img[3] == true) {
                  echo '<img src="uploads/'.$img[3].'" style="width:100%;" alt="">';
                }else {
                  echo '<img src="assets/img/640x480.png" style="width:100%;" alt="">';

                }
               ?>
               <p><?php echo $post_title[3]; ?></p>
              </div>
            </a>
            </div>
              <div class="col-sm-6">
                  <a href="post.php?id=<?php echo $post_id[4]; ?>">
                <div class="img-box2">
                  <?php
                    if ($img[4] == true) {
                      echo '<img src="uploads/'.$img[4].'" style="width:100%;" alt="">';
                    }else {
                      echo '<img src="assets/img/640x480.png" style="width:100%;" alt="">';

                    }
                  ?>
                  <p><?php echo $post_title[4]; ?></p>
                </div>
              </a>
              </div>
                <div class="col-sm-6">
                    <a href="post.php?id=<?php echo $post_id[5]; ?>">
                  <div class="img-box2">
                  <?php
                    if ($img[5] == true) {
                      echo '<img src="uploads/'.$img[5].'" style="width:100%;" alt="">';
                    }else {
                      echo '<img src="assets/img/640x480.png" style="width:100%;" alt="">';

                    }
                  ?>                    
               <p><?php echo $post_title[5]; ?></p>
                  </div>
                </a>
                </div>
        </div>
      </div>
    </div>
  </div>

<!-- end of related post -->
<hr>

<!-- Edit post comment -->
       <div class="row">
         <div class="col-sm-12">
           <?php
             $i = 1;
             $query2 = mysqli_query($con, "SELECT * FROM comment WHERE post_id = '$id'");
             $count = mysqli_num_rows($query2);
             if($count!='0'){
             ?>
          <h3> Answers(<?php echo $count; ?>):- </h3>
        <?php
        }
            while ($a = mysqli_fetch_array($query2)) {

              echo "<p>Ans-".$i." : ".$a['comment']." <a id='comment$i' class='edit text-primary'>Edit</a></p><br>";
              ?>
              <div class="comment<?php echo $i; ?> " class="">

              <form class="" method="post">
                <input type="hidden" name="comment_id" value="<?php echo $a['id'] ?>">
                <textarea name="comment" rows="4" cols="80" placeholder="Enter your Comment"><?php echo $a['comment'];
                 ?></textarea><br>
                 <input type="submit" name="save" value="Save">
                 <!-- <input type="reset" name="reset" value="Reset"> -->
                 <input type="submit" name="delete" value="Delete">
              </form>

            </div>
              <?php
              $i+=1;
            }
           ?>
         </div>
       </div>
 <!-- /edit post comment -->

 <!-- Post new comment -->
       <div class="comment">
         <h3>Post Comment</h3>
          <form class="" action="" method="post">
             <textarea name="comment" rows="8" cols="80"></textarea><br>
             <button type="submit" class="btn btn-success" name="submit">submit</button>
           </form>
       </div>
<!-- /post new comment -->

     </div>

    </section>


     <script type="text/javascript">
         $(document).ready(function(){
           <?php
           $a=1;
           while ($a <= $count) {
             ?>
             $(".comment<?php echo $a; ?>").hide();
             <?php
             $a+=1;
           }
           $b=1;
           while ($b <= $count) {
            ?>
              $("#comment<?php echo $b; ?>").click(function(){
                  console.log("SHOWN");
                  $(".comment<?php echo $b; ?>").slideToggle("slow","swing");
                  console.log($(this).text());
                  if ($(this).text() == "Edit"){
                   $(this).text("Close");
                 }
                 else {
                     $(this).text("Edit");
                   }

            });
            <?php $b+=1;  }  ?>
          });
     </script>
   </body>
 </html>
