<html>
    
    <?php foreach($viewblogcomments as $comment) { ?>
        <div class="cmtcomment">
 <div>
    <div>
    <span class="cmtdate"> Posted on: <?php echo $comment->getDate();?> </span>
    <span class="cmtname"> : <?php echo $comment->getUsername();?></span>
    </div>
    <div class="cmtcontent">
 <?php echo $comment->getContent();
 ?> </div> </div>
  <?php if(Comment::userCanChange($comment->getUsername(), $comment->getCommentID()) || $_SESSION["username"] == 'admin') { ?>
            <hr>
  <p>   <a href='?controller=comment&action=delete&commentid=<?php echo $comment->getCommentID(); ?>'>Delete Comment</a>&nbsp; &nbsp;
       <a href='?controller=comment&action=update&commentid=<?php echo $comment->getCommentID(); ?>'>Edit Comment</a> &nbsp;
  </p><?php } ?>
</div>
  <?php  } ?> 
</body>
</html>
