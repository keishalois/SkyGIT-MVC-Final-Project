<br>
<br>
<div class="add-blog">

<form action="" method="POST" class="w3-container" id="addform" enctype="multipart/form-data">
    <br>
    <h2 class="text-center">Update Blog</h2>
    <div class ="add-form">
    <p>
        <br>
        <input class="form-control form-rounded" type="text" name="title" value="<?= $blogpost->title; ?>">
    </p>
    <p><br>
        <textarea class="form-control form-rounded"r rows="10" cols="100" name="content" form="addform" required><?= $blogpost->content; ?></textarea>
        <!--<input class="w3-input" type="text" name="content" value="<?//= $blogpost->content; ?>" >-->
    </p>
            
  <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<?php 
$file = 'views/images/' . $blogpost->blogid . '.jpeg';
if(file_exists($file)){
    $img = "<img src='$file' width='150' />";
    echo $img;
}


?>
  <br/>  <br/>    
  <div class="custom-file mb-3">
    <input type="file" class="custom-file-input" name="myUploader" id="customFile" required>
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
  <br><br>
  <p align="center">
    <input class="btn btn-light" type="submit" value="Update Blog">
    </p>
    

    
        </div>       
</form>
</div> 