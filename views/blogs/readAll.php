<br><br>
<div class="row">
  <select class="form-control col-sm-2" name="order" id="order" onchange="orderBlogs(this)">
    <option value="Select">Sort By</option>
    <option value="Newest">Newest Post</option>
    <option value="Oldest">Oldest Post</option>
    <option value="NewComm">Newest Comment</option>
    <option value="BlogTitle">Name</option>
  </select>
    <br>
</div>
<br>
<div class="row">
<?php    //display blogs associated to user 
   foreach($blogposts as $blogpost) { ?>

  <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <a class="all-card-title" href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'>
                    <h3><?php echo $blogpost->title;?> </h3>
                </a> 
                <p class="card-text"><?php echo html_entity_decode($blogpost->content); ?> </p> 
                <br><br>
                <p><i class="fas fa-comment"></i> <?php echo $blogpost->blogComments($blogpost->blogid);?></p>
                <?php
                    $file = 'views/images/' . $blogpost->blogid . '.jpeg';
                    if(file_exists($file)){
                        $img = "<img src='$file' width='150' />";
                        echo $img;
                    }
                ?>
            <br><br>
            </div>
        </div>
      <br>
  </div>
            <hr>
        <?php } ?>
</div>