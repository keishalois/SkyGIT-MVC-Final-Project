

<?php  foreach($blogposts as $blogpost) { ?>
<div class="blogs-page">
 <p>
   <a href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'><?php echo '<h3>' . $blogpost->title . '</h3></a>' . $blogpost->content . '<br><br>';

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
    </div>
<hr>
<?php } 
?>