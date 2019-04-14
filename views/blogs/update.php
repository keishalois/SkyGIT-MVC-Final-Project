<p>Wanna change your blog post?</p>
<form action="" method="POST" class="w3-container" enctype="multipart/form-data">
    <h2>Update Blog</h2>
        <div class ="add-form">
    <p>
        <input class="w3-input" type="text" name="title" value="<?= $blogpost->title; ?>">
        <label>Title</label>
    </p>
    <p>
        <input class="w3-input" type="text" name="content" value="<?= $blogpost->content; ?>" >
        <label>Content</label>
    </p>
            
  <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<?php 
$file = 'views/images/' . $blogpost->title . '.jpeg';
if(file_exists($file)){
    $img = "<img src='$file' width='150' />";
    echo $img;
}


?>
  <br/>
  <input type="file" name="myUploader"/>
  <p>
    <input class="btn btn-light" type="submit" value="Update Blog">
    </p>
        </div>
</form>