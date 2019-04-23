<br><br>
<div class="row">
    <div class="col-sm-2">
  <select class="form-control" name="order" id="order" onchange="orderBlogs(this)">
    <option value="Select">Sort By</option>
    <option value="Newest">Newest Post</option>
    <option value="Oldest">Oldest Post</option>
    <option value="NewComm">Newest Comment</option>
    <option value="BlogTitle">Name</option>
  </select>
    </div>
    <div class="col-sm-1"></div>
    <div align="right" class="col-sm-5">
    <form action="index.php?controller=blog&action=search" method="post">
      <input class="form-control" type="text" placeholder="Search.." name="search">
    </form>
    </div>
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
                
                <?php
                    $file = 'views/images/' . $blogpost->blogid . '.jpeg';
                    if(file_exists($file)){
                        $img = "<img src='$file' width='200' />";
                        echo $img;
                    }
                ?>
                <br><Br>
                <p align="center"><i class="fas fa-comment"></i> <?php echo $blogpost->blogComments($blogpost->blogid);?></p>
            </div>
        </div>
      <br>
  </div>
            
        <?php } ?>
</div>