<head>
        <link type="text/css" rel="stylesheet" href="views/css/jquery-te-1.4.0.css"> 
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="views/javascript/jquery-te-1.4.0.min.js" charset="utf-8"></script>
        
</head>
<br>
<br>
<div class="add-blog">

<form action="" method="POST" class="w3-container" id="addform" enctype="multipart/form-data">
    <br>
    <h2 class="text-center">New Blog</h2>
    <p>
        <br>
        <textarea class="form-control form-rounded" rows="1" cols="100" name="title" form="addform" placeholder="Title" required></textarea>
    </p>

   <p><br>
   <textarea  class="jqte-test" class="form-control form-rounded"rows="10" cols="100" name="content" form="addform" placeholder="Start writing your blog here..." required></textarea>
   </p>
   
 
 
      <input type="hidden"
       name="MAX_FILE_SIZE"
        value="10000000"
        />
 
         <div class="custom-file mb-3">
    <input type="file" class="custom-file-input" name="myUploader" id="customFile" required>
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
      
      
<!--
 <input type="file" name="myUploader" class="" required/>-->
  <br><br>
 <p align="center">
   <input class="btn btn-light text-center" type="submit" value="Add Blog Post">
 </p>
 </div>
</form>
</div>
<br>


         <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>