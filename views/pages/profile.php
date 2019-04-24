<br><br>
<div class="add-blog">
    <br>
    <h2 class="text-center">Hello there <b><?php echo $username; ?></b>!</h2>
    <br>
    <?php
                //php code to upload photo
                if(!empty($_FILES['fileToUpload']))
                    {
                    $path =   __DIR__ .  "/../images/prophotos/";
                    $destinationFile = $path . $username . '.jpeg';
                    $tempyFile = $_FILES['fileToUpload']['tmp_name'];
                    if(move_uploaded_file($tempyFile, $destinationFile)) {
                        echo "The file ".  ( $_FILES['fileToUpload']['name']).
                        " has been uploaded as your profile photo!";
                    } else{
                        echo "There was an error uploading the file, please try again!";
                    }
                } //php code to show photo
       $file = 'views/images/prophotos/' . $username . '.jpeg';
       if(file_exists($file)){
       $img = "<div class='text-center'><img src='$file' width='200' /></div>";
       echo $img;
   }
    ?> 
   <br>
    <p align="center">Upload your profile photo:</p>
    <div custom-file mb-3>
        <?php        //check user is not a guest and let them view user blogs
        if(!($_SESSION["username"] == 'guest')) { ?>
        <!-- upload profile photo form-->
            <div align="center" class="profile-upload">
                
          <form class="col-sm-5"enctype="multipart/form-data" action="" method="POST">
   <input type="file" class="custom-file-input" name="fileToUpload" id="customFile">
   <label align="left" class="custom-file-label" for="customFile">Choose file</label>
   <br>
  <p align="center">
      <br>
    <input class="btn btn-light" type="submit" value="Upload">
  </p>
 </form>
                <br>
          </div>
    </div>
      </div>
        <br><br>
        <p id="seeuserblogs">  
            <button class="btn commentsbutton" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
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
                    <p class="card-text"><?php echo html_entity_decode($blogpost->content); ?> </p> 
                <br><br>
                <a class="btn btn-light" id="readbutton" href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'><i class="fas fa-book-open"></i> Read</a>
                <p><i class="fas fa-comment"></i> <?php echo $blogpost->blogComments($blogpost->blogid);?></p>
                <br><button class="btn btn-danger" onclick="deleteBlogonUserPage(<?php echo $blogpost->blogid; ?>)"> <i class="fas fa-trash-alt"></i> Delete</button>
            <button class="btn btn-light" onclick="updateBlog(<?php echo $blogpost->blogid; ?>)"><i class="fas fa-edit"></i> Update</button> 
            <br><br>
            </div>
        </div>
      <br>
  </div>
            <br>
        <?php } ?>
    </div>
</div>
<br><br>
<?php } ?>

<?php }
// below displays the guest home page

else { ?>
<p>As a guest, you can only see posts... you are not allowed
    to comment or post until you make an account or sign in!</p>
<?php } ?>

