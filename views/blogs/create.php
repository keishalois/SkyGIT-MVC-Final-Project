<br>
<br>
<div class="add-blog">
<p>Fill in the following form to create a new blogpost:</p>

<form action="" method="POST" class="w3-container" id="addform" enctype="multipart/form-data">

   <h2>Add New Blog</h2>

   <p>
       <label>Title</label><br>
       <textarea rows="1" cols="100" name="title" form="addform" required></textarea>
   </p>

   <p>
       <label>Content</label><br>
   <textarea rows="10" cols="100" name="content" form="addform" required></textarea>
   </p>
 <input type="hidden"
       name="MAX_FILE_SIZE"
        value="10000000"
        />

 <input type="file" name="myUploader" class=""/>
 <br><br>
 <p>
   <input class="btn btn-light" type="submit" value="Add Blog Post">
 </p>
 </div>
</form>
</div>
<br>