<div class="add-blog">
<p>Fill in the following form to create a new blogpost:</p>

<form action="" method="POST" class="w3-container" id="addform" enctype="multipart/form-data">

   <h2>Add New Blog</h2>
   <div class ="add-form">
   <p>
       <label>Title</label><br>
       <textarea rows="1" cols="100" name="title" form="addform"></textarea>
   </p>

   <p>
       <label>Content</label><br>
   <textarea rows="10" cols="100" name="content" form="addform"></textarea>
   </p>
 <input type="hidden"
       name="MAX_FILE_SIZE"
        value="10000000"
        />

 <input type="file" name="myUploader" class="w3-btn" required />
 <p>
   <input class="w3-btn" type="submit" value="Add Blog Post">
 </p>
 </div>
</form>
</div>
<br>