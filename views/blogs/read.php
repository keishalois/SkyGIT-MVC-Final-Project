<html>
    <head>
        <script src="/FinalProject/views/javascript/deleteBlog.js"></script>
        <script src="/FinalProject/views/javascript/updateBlog.js"></script>
        <script src="/FinalProject/views/javascript/comments.js"></script>
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
<hr>
<hr>
    <?php
           if(!($_SESSION["username"] == 'guest'))  {?>    
<div>
    <form action="" method="POST" class="w3-container" id="cmtform" enctype="multipart/form-data">
    <p>
       <label>Add Comment</label><br>
            <textarea rows="6" cols="80" name="comment" form="cmtform"></textarea>
    </p>
    <p>
        <input class="w3-btn" onsubmit="addComment(<?php echo $_GET['blogid'] ?>)" type="submit" value="Comment">
    </p>
    </form> <?php } ?>
</div>
<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo" onclick="showComments(<?php echo $blogpost->blogid; ?>)">See the discussion here  <i class="far fa-hand-point-down"></i></button>
<div id="demo" class="collapse">
    <div id="comment"></div>
</div>
    </body>
</html>


	
