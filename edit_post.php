<?php
require('folder/dbconnect.php');
require('folder/bootstrap.php');

if(isset($_POST['save'])){
  $post_title = $_POST['post_title'];
  $post = $_POST['post'];
  $query = mysqli_query($con,"INSERT INTO post (post_title,post) VALUES('$post_title','$post')");
  if($query){
    // echo "<script>alert('Post Successful');</script>";
    $query2 = mysqli_query($con,"SELECT * FROM post ORDER BY ID DESC LIMIT 1");
    $array = mysqli_fetch_array($query2);
    header("Location:post.php?id=".$array['id']);
  }
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
    <title>Post_ ADD</title>
  </head>
  <body>
    <div class="container">
      <?php
        $id=$_GET['id'];
        $query= mysqli_query($con, "SELECT * FROM post WHERE id='$id'");
        $a=mysqli_fetch_array($query);
      ?>
      <form class="" method="post">
      <!-- creating a text area for my editor in the form -->
        <h1>Add Post</h1>
        <br>
          <input type="text" class="form-control" name="post_title" placeholder="Enter POST Titile" value="<?php echo $a['post_title']; ?> ">
          <br>
          <textarea id="myeditor" name="post" placeholder="Enter Your Text Inside" rows="20"><?php echo $a['post']; ?> </textarea>
          <button type="submit" class="save_btn" name="save">SAVE</button>
      </form>

      <!-- creating a CKEditor instance called myeditor -->

      <script type="text/javascript">
        CKEDITOR.replace('myeditor');
      </script>

    </div>
  </body>
</html>
