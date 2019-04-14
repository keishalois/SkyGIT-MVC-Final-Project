<h3>Hello there <b><?php echo $username; ?></b>!</h3>
<h5>how are you today??? </h5>

<!-- this div put the silly smiley face in - we can delete this is people don't like -->
<div id="div1" class="fa fa-4x"></div>
        <script>// this is just a silly smiley we can get rid of if people don't like it
                function smile() {
                        var a;
                        a = document.getElementById("div1");
                        a.innerHTML = "&#xf118;";
                        setTimeout(function () {
                            a.innerHTML = "&#xf11a;";
                            }, 1000);
                        setTimeout(function () {
                            a.innerHTML = "&#xf119;";
                            }, 2000);
                        setTimeout(function () {
                            a.innerHTML = "&#xf11a;";
                            }, 3000);
                        }
            smile();
            setInterval(smile, 4000);
        </script>
        
<?php //check user is not a guest
if(!($_SESSION["username"] == 'guest')) { 
    ?> 
<p>This is your user page - you can see your blogs and comments below!</p>
<p>or you can see all blogs/create a new blog above</p>

<?php  //display blogs associated to user 
    foreach($blogposts as $blogpost) { ?>
            <div class="blogs-page">
                <h5><?php echo $blogpost->title; ?> </h5> 
                <p><?php echo $blogpost->content; ?> </p> 
                <br><br>
            <a href='?controller=blog&action=read&blogid=<?php echo $blogpost->blogid; ?>'>See Blog</a> &nbsp; &nbsp;
            <a href='?controller=blog&action=delete&blogid=<?php echo $blogpost->blogid; ?>'>Delete Blog</a>&nbsp; &nbsp;
            <a href='?controller=blog&action=update&blogid=<?php echo $blogpost->blogid; ?>'>Amend Blog</a> &nbsp;
            </div>
            <hr>
        <?php }
 } 
// below displays the guest home page
else { ?>
<p>As a guest, you can only see posts... you are not allowed
    to comment or post until you make an account or sign in!</p>
<?php }