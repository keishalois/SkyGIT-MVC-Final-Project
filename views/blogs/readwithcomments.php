<html>
    <?php
    foreach($viewblogcomments as $comment) { ?>
<div class="cmtcomment">
    <div>
    <span class="cmtdate"> <p> Posted on: <?php echo $comment->getDate();?> </span></p>
     <span class="cmtname"> <p> Posted by: <?php echo $comment->getUsername();?></span></p>
    </div>
    <div class="cmtcontent">
 <?php echo $comment->getContent();
 ?> </div>
     <br><br>
 </p>
 
  <?php if(Comment::userCanChange($comment->getUsername(), $comment->getCommentID()) || $_SESSION["username"] == 'admin') { ?>
 <p>   <a href='?controller=comment&action=delete&commentid=<?php echo $comment->getCommentID(); ?>'>Delete Comment</a>&nbsp; &nbsp;
    <a href='?controller=comment&action=update&commentid=<?php echo $comment->getCommentID(); ?>'>Edit Comment</a> &nbsp;
  </p>
</div>
    <?php  }} ?> 
    </body>
</html>
