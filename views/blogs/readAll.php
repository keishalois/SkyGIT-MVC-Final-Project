<p>Here is a list of all blogs:</p>

<?php  foreach($blogposts as $blogpost) { ?>
<div class="blogs-page">
 <p>
   <?php echo '<h3>' . $blogpost->title . '</h3>' . $blogpost->content . '<br><br>';

   $file = 'views/images/' . $blogpost->title . '.jpeg';

       if(file_exists($file)){
           $img = "<img src='$file' width='150' />";
           echo $img;
       }
       else{
           echo "<img src='views/images/standard/_noproductimage.png' width='150' />";
       }

   echo '<br><br>';
   ?>
    
    <a href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'>See Blog</a> &nbsp; &nbsp;
  <?php if(BlogPost::userCanChange($blogpost->username, $blogpost->blogid) || $_SESSION["username"] == 'admin') { ?>
    <a href='?controller=blog&action=delete&blogid=<?php echo $blogpost->blogid; ?>'>Delete Blog</a>&nbsp; &nbsp;
    <a href='?controller=blog&action=update&blogid=<?php echo $blogpost->blogid; ?>'>Amend Blog</a> &nbsp;
  </p> 
  </div>
<hr>
<?php } }
?>