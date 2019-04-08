<p>Here is a list of all blogs:</p>

<?php foreach($blogposts as $blogpost) { ?>
  <p>
    <?php echo $blogpost->title; ?> &nbsp; &nbsp;
    <a href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'>See Blog</a> &nbsp; &nbsp;
    <a href='?controller=blog&action=delete&blogid=<?php echo $blogpost->blogid; ?>'>Delete Blog</a> &nbsp; &nbsp;
    <a href='?controller=blog&action=update&blogid=<?php echo $blogpost->blogid; ?>'>Amend Blog</a> &nbsp;
  </p>
<?php } ?>