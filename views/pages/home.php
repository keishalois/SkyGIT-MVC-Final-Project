<h3>Oh, hello <b><?php echo $username; ?></b>!</h3>
<h5>How are you today??? </h5>
<!-- this div put the silly smiley face in - we can delete this is people don't like -->
<div id="div1" class="fa fa-4x"></div>
        <script>// this is just a silly smiley we can get rid of if people don't like it
                function smile() {
                        var a;
                        a = document.getElementById("div1");
                        a.innerHTML = "&#xf118;";
                        setTimeout(function () {
                            a.innerHTML = "&#xf11a;";
                            }, 1000);
                        setTimeout(function () {
                            a.innerHTML = "&#xf119;";
                            }, 2000);
                        setTimeout(function () {
                            a.innerHTML = "&#xf11a;";
                            }, 3000);
                        }
            smile();
            setInterval(smile, 4000);
        </script>
            
<?php //check user is not a guest and let them view user blogs
        if(!($_SESSION["username"] == 'guest')) { 
    ?> 
        <br><br>
        <p id="seeuserblogs">  
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Show my blogs
            </button>
        </p>
    <div class="collapse" id="collapseExample">
        <div class="emptycomment">
    <?php //check user actually has blogposts - if not display wow much empty
        if(empty($blogposts)) {
                $emptypic = 'views/images/empty/wow-much-empty.jpg';
                if(file_exists($emptypic)){
                    $img = "<img src='$emptypic' width='150' />";
                echo $img;
                } 
                ?> <br><br> </div> 
<?php        //this means they do have blogposts so display them below
        } else { ?> 
    <div class="row">
   <?php    //display blogs associated to user 
   foreach($blogposts as $blogpost) { ?>

  <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $blogpost->title; ?> </h5>
                    <h6 class="card-subtitle mb-2 text-muted">You own this blog</h6>
                    <p class="card-text"><?php echo $blogpost->content; ?> </p> 
                <br><br>
                <a class="btn btn-light" id="readbutton" href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'><i class="fas fa-book-open"></i> Read</a>
                <p><i class="fas fa-comment"></i> <?php echo $blogpost->blogComments($blogpost->blogid);?></p>
                <br><button class="btn btn-danger" onclick="deleteBlogonUserPage(<?php echo $blogpost->blogid; ?>)"> <i class="fas fa-trash-alt"></i> Delete</button>
            <button class="btn btn-light" onclick="updateBlog(<?php echo $blogpost->blogid; ?>)"><i class="fas fa-edit"></i> Edit</button> 
            <br><br>
            </div>
        </div>
  </div>
            <hr>
        <?php } ?>
    </div>
</div>
<br><br>
<?php } ?>

        <p id="seeusercomments">  
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Show my comments
            </button>
        </p>
    <div class="collapse" id="collapseExample">
        <div class="emptycomment">
    <?php //check user actually has blogposts - if not display wow much empty
        if(empty($blogposts)) {
                $emptypic = 'views/images/empty/wow-much-empty.jpg';
                if(file_exists($emptypic)){
                    $img = "<img src='$emptypic' width='150' />";
                echo $img;
                } 
                ?> <br><br> </div> 
<?php        //this means they do have blogposts so display them below
        } else { ?> 
    <div class="row">
   <?php    //display blogs associated to user 
   foreach($comments as $comment) { ?>

                    <p class="card-text"><?php echo $comment->getContent(); ?> </p> 
                <br><br>
<!--                <a class="btn btn-light" id="readbutton" href='?controller=blog&action=read&blogid=<?php // echo $comment->blogid; ?>'><i class="fas fa-book-open"></i> Read</a>-->
                <br><button class="btn btn-danger" onclick="deleteComment(<?php echo $comment->getCommentID;  ?>)"> <i class="fas fa-trash-alt"></i> Delete</button>
            <button class="btn btn-light" onclick="updateComment(<?php echo $comment->getCommentID;  ?>)"><i class="fas fa-edit"></i> Edit</button> 
            <br><br>
   <hr>
        <?php } ?>
    </div>
</div>
<br><br>
<?php }
   }
// below displays the guest home page

else { ?>
<p>As a guest, you can only read posts... you can't add comments or create a post until you sign up or sign in!</p>
<?php } ?>