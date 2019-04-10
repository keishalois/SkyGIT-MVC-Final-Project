<html>
    <head>
        <script src="/FinalProject/views/javascript/deleteBlog.js"></script>
    </head>
    <body>
<div class="blogs-page">
<h3><?php echo $blogpost->title; ?></h3>

<p>Blog ID: <?php echo $blogpost->blogid; ?></p>
<p>Added By: <?php echo $blogpost->username; ?></p>
<p>Date Added: <?php echo $blogpost->date; ?></p>
<p>Content: <?php echo $blogpost->content; ?></p>


<?php 
$file = 'views/images/' . $blogpost->title . '.jpeg';
if(file_exists($file)){
    $img = "<img src='$file' width='150' />";
    echo $img;
}
else
{
echo "<img src='views/images/standard/_noproductimage.png' width='150' />";
}
?>
<br><br>
 
 <div class="reload">
<!--     <a href='?controller=blog&action=addcomment&blogid=<?php echo $blogpost->blogid; ?>'>Add Comment</a> &nbsp;-->
  <?php if(BlogPost::userCanChange($blogpost->username, $blogpost->blogid) || $_SESSION["username"] == 'admin') { ?>
     <button class="w3-gray" onclick="deleteBlog(<?php echo $blogpost->blogid; ?>)">Delete Blog Post</button>
     <a href='?controller=blog&action=update&blogid=<?php echo $blogpost->blogid; ?>'>Edit Blog</a> &nbsp;
  </p> 
</div>
</div>

    
    <?php } 
?>
    </body>
</html>


	
