<html>
    <head>
        <script src="/FinalProject/views/javascript/deleteBlog.js"></script>
        <script src="/FinalProject/views/javascript/updateBlog.js"></script>
        <script src="/FinalProject/views/javascript/addComment.js"></script>
    </head>
    <body>
<div class="blogs-page">
<h3><?php echo $blogpost->title; ?></h3>

<p>Added By: <?php echo $blogpost->username; ?></p>
<p>Date Added: <?php echo $blogpost->date; ?></p>
<p>Content: <?php echo $blogpost->content; ?></p>


<?php 
$file = 'views/images/' . $blogpost->title . '.jpeg';
if(file_exists($file)){
    $img = "<img src='$file' width='150' />";
    echo $img;
}


?>
<br><br>

 <div class="reload">
  <?php if(BlogPost::userCanChange($blogpost->username, $blogpost->blogid) || $_SESSION["username"] == 'admin') { ?>
     <button class="w3-gray" onclick="deleteBlog(<?php echo $blogpost->blogid; ?>)">Delete Blog Post</button>
<button class="w3-gray" onclick="updateBlog(<?php echo $blogpost->blogid; ?>)">Update Blog Post</button> <?php } 
?>  </p> 
</div>
<br><br>
</div>




<div>
    <form action="" method="POST" class="w3-container" id="cmtform" enctype="multipart/form-data">
    <p>
       <label>Add Comment</label><br>
            <textarea rows="10" cols="100" name="content" form="cmtform"></textarea>
    </p>
    <p>
        <input class="w3-btn" onclick="addComment(<?php echo $blogpost->blogid; ?>)" type="submit" value="Tell Us...">
    </p>
    </form>
</div>
<hr>
<hr>
<div>
    <?php // foreach($comments as $comment) { ?>
<div class="comments-page">
    <h3> <?php // echo $comment->comment;?></h3>
 <p>
 <?php // echo $comment->comment;
   ?> 
<!--     <br><br>-->
<!-- </p>
 <p>-->
  <?php // if(Comment::userCanChange($comment->username, $comment->commentid) || $_SESSION["username"] == 'admin') { ?>
<!--    <a href='?controller=blog&action=delete&blogid=<?php echo $comment->commentid; ?>'>Delete Comment</a>&nbsp; &nbsp;
    <a href='?controller=blog&action=update&blogid=<?php echo $comment->commentid; ?>'>Edit Comment</a> &nbsp;
  </p> 
  </div>
<hr>-->
<?php // } } ?>
</div>
    </body>
</html>


	
