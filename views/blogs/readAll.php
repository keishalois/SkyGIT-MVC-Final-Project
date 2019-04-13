<p>Here is a list of all blogs:</p>

<?php  foreach($blogposts as $blogpost) { ?>
<div class="blogs-page">
 <p>
   <a class="blogTitle" href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'>
       <h3><?php echo $blogpost->title;?> </h3></a> 
 <p><?php echo $blogpost->content;?> </p>
       <br>
       <p><i class="fas fa-comment"></i> <?php echo $blogpost->blogComments($blogpost->blogid);?></p>
   <?php
   $file = 'views/images/' . $blogpost->title . '.jpeg';

       if(file_exists($file)){
           $img = "<img src='$file' width='150' />";
           echo $img;
       }
   ?>
<br><br>
  </p> 
  </div>
<hr>
<?php } ?>
