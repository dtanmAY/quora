<div class="header">
   <ul>
     <li><a href="index.php"> View Posts </a></li>
       <li><a href="post_add.php"> Add Posts </a></li>

<!-- for showing only on POST page -->
          <?php
          if(isset($type) && $type == "post"){
            ?>
             <li><a href="edit_post.php?id=<?php echo $a['id']; ?>">Edit Post</a> </li>
             <li><a href="delete_post.php?id=<?php echo $id; ?>" onclick="alert('Do You Really Want to delete ?');">Delete Post</a> </li>

                <?php
              }
            ?>
  <!-- the end -->


   </ul>
</div>
