    <!-- this all goes technically as its own view based on commentlayout.php into the comment div
    under the see all comments button on views/blogs/read.php -->
    
    <p class="emptycomment">
    <?php if(empty($viewblogcomments)) {
        $emptypic = 'views/images/empty/wow-much-empty.jpg';
        if(file_exists($emptypic)){
    $img = "<img src='$emptypic' width='150' />";
    echo $img;
} ?> </p>
        
  <?php  } else {
    
    foreach($viewblogcomments as $comment) { ?>
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
                <button class="btn btn-danger" onclick="deleteComment(<?php echo $comment->getCommentID(); ?>)"> <i class="fas fa-trash-alt"></i> Delete</button>
                <button class="btn btn-light" onclick="updateComment(<?php echo $comment->getCommentID(); ?>)"> <i class="fas fa-edit"></i> Edit</button>
            </p>
            <?php } ?>
        </div>
    <?php  } } ?> 
