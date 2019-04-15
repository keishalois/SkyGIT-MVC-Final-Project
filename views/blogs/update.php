<br>
<br>
<div class="add-blog">
<p>Wanna change your blog post?</p>
<form action="" method="POST" class="w3-container" id="addform" enctype="multipart/form-data">
    <h2>Update Blog</h2>
        <div class ="add-form">
    <p>
        <label>Title</label>
        <input class="w3-input" type="text" name="title" value="<?= $blogpost->title; ?>">
    </p>
    <p>
        <label>Content</label>
        <textarea rows="10" cols="100" name="content" form="addform" required><?= $blogpost->content; ?></textarea>
        <!--<input class="w3-input" type="text" name="content" value="<?= $blogpost->content; ?>" >-->
    </p>
            
  <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<?php 
$file = 'views/images/' . $blogpost->title . '.jpeg';
if(file_exists($file)){
    $img = "<img src='$file' width='150' />";
    echo $img;
}


?>
  <input type="file" name="myUploader" class=""/>
  <br><br>
  <p>
    <input class="btn btn-light" type="submit" value="Update Blog">
    </p>
        </div>       
</form>
</div>