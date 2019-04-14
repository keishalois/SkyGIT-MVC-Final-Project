<html>
    <!-- this all goes technically as its own view based on commentlayout.php into the comment div
    under the see all comments button on views/blogs/read.php -->
    <?php foreach($viewblogcomments as $comment) { ?>
        <div class="cmtcomment">
            <div>
<!-- this div displays the date and username associated with the comment -->
                <div>
                    <span class="cmtdate"> Posted on: <?php echo $comment->getDate();?> </span>
                    <span class="cmtname"> : <?php echo $comment->getUsername();?></span>
                </div>
                <div class="cmtcontent">
                        <?php echo $comment->getContent();?> 
                </div> 
            </div>
<!-- this checks if the user owns the comment before letting them delete or edit -->
            <?php if(Comment::userCanChange($comment->getUsername(), $comment->getCommentID()) || $_SESSION["username"] == 'admin') { ?>
            <hr>
            <p>   
                <a href='?controller=comment&action=delete&commentid=<?php echo $comment->getCommentID(); ?>'>Delete Comment</a>&nbsp; &nbsp;
                <a href='?controller=comment&action=update&commentid=<?php echo $comment->getCommentID(); ?>'>Edit Comment</a> &nbsp;
            </p>
            <?php } ?>
        </div>
  <?php  } ?> 
</body>
</html>
