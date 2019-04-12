<h3>Hello there <b><?php echo $username; ?></b>!</h3>
<?php if(!($_SESSION["username"] == 'guest'))  {?>    
<p>This is your user page - you can see your blogs and comments below! Oldest blogs first..</p>
<p>or you can see all blogs/create a new blog above!</p>
  <p>
<?php  foreach($blogposts as $blogpost) { ?>
<div class="blogs-page">
 <p>
 <h5><?php echo $blogpost->title; ?> </h5> 
 <p><?php echo $blogpost->content; ?> </p> <br>
   
 <br>
    <a href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'>See Blog</a> &nbsp; &nbsp;
    <a href='?controller=blog&action=delete&blogid=<?php echo $blogpost->blogid; ?>'>Delete Blog</a>&nbsp; &nbsp;
    <a href='?controller=blog&action=update&blogid=<?php echo $blogpost->blogid; ?>'>Amend Blog</a> &nbsp;
  </p>
  </p> 
  </div>
<hr>
<?php }} else { ?>
<p>As a guest, you can only see posts... you are not allowed
    to comment or post yourself until you make an account or sign in!</p>
<?php } ?>