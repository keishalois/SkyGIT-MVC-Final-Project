<html>
    <head>
        <!-- include javascript sources - could go in layout? -->
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
<?php  // this is checking if a uploaded file exists to display on the blog page
$file = 'views/images/' . $blogpost->title . '.jpeg';
if(file_exists($file)){
    $img = "<img src='$file' width='150' />";
    echo $img;
}
?>
<br><br>

 <div class="reload">
  <?php 
//this method is checking if the blogpost belongs to the logged in user or user is admin
  if(BlogPost::userCanChange($blogpost->username, $blogpost->blogid) || $_SESSION["username"] == 'admin') { ?>
        <button class="w3-gray" onclick="deleteBlog(<?php echo $blogpost->blogid; ?>)"> <i class="fas fa-trash-alt"></i> Delete Blog Post</button>
        <button class="w3-gray" onclick="updateBlog(<?php echo $blogpost->blogid; ?>)">Update Blog Post</button> 
 <?php } 
        ?>  
</div>
<br><br>
</div>
<hr>
<hr>
    <?php // this is checking that the user is not a guest as guests cannot comment
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
        </form> 
   <?php } ?>
    </div>

<!-- this button toggles the view all blog comments page 
- which is a separate view controlled by comment controller -->
    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#collapseExample" onclick="showComments(<?php echo $blogpost->blogid; ?>)">See the discussion here  <i class="far fa-hand-point-down"></i></button>
<!-- this div is where the collapsed info will go once button is clicked -->        
        <div id="collapseExample" class="collapse">
            <!-- this div is where the ajax response from comments.js will be inserted
             and it will load the readallcomments.php file from views/comments-->
            <div id="comment"></div>
        </div>
    </body>
</html>


	
