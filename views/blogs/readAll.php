<br><br>
<div class="row"    >
    <div class="col-sm-2">
  <select class="form-control" name="order" id="order" onchange="orderBlogs(this)">
    <option value="Select">Sort by:</option>
    <option value="Newest">Newest post</option>
    <option value="Oldest">Oldest post</option>
    <option value="NewComm">Newest comment</option>
    <option value="BlogTitle">Blog title</option>
  </select>
    </div>
    <div class="col-sm-1"></div>
    <div align="right" class="col-sm-5">
    <form action="index.php?controller=blog&action=search" method="post">
      <input class="form-control" type="text" placeholder="Search..." name="search">
    </form>
    </div>
    <br>
</div>
<br>
<div class="row">
<?php    //display blogs associated to user 
   foreach($blogposts as $blogpost) { ?>

  <div class="col-sm-4" align="center">
        <div class="card">
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
                <a class="commButt" href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'<p><i class="fas fa-comment"></i> <?php echo $blogpost->blogComments($blogpost->blogid);?></p></a>
            </div>
        </div>
      <br>
  </div>
            
        <?php } ?>
</div>