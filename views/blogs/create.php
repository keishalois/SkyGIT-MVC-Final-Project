<div class="add-blog">
<p>Fill in the following form to create a new product:</p>

<form action="" method="POST" class="w3-container" id="usrform" enctype="multipart/form-data">

   <h2>Add New Blog</h2>

   <p>
       <label>Title</label><br>
       <textarea rows="1" cols="100" name="title" form="usrform"></textarea>
   </p>

   <p>
       <label>Content</label><br>
   <textarea rows="10" cols="100" name="content" form="usrform"></textarea>
   </p>
 <input type="hidden"
       name="MAX_FILE_SIZE"
        value="10000000"
        />

 <input type="file" name="myUploader" class="w3-btn" required />
 <p>
   <input class="w3-btn" type="submit" value="Add Blog Post">
 </p>
</form>
</div>
<br>