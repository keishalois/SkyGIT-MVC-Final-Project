<!DOCTYPE html>
<html>
  <head> 
       <?php 
//check uer is logged in otherwise send them to the landing page
       session_start();   
       if(!empty($_SESSION)){
            $username = $_SESSION["username"];
    }
    else {header("Location:landingpage.php");} ?>
      
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- link to w3 schools css -->
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<!-- links to google fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico|Pangolin" >
<!-- link to bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<!-- link to internal style sheet -->
<link rel="stylesheet" href="views/css/styles.css">
<!-- link to fontawesome icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<!-- javascript links for blog page -->
        <script src="views/javascript/deleteBlog.js"></script>
        <script src="views/javascript/updateBlog.js"></script>
        <script src="views/javascript/comments.js"></script>
        <script src="views/javascript/orderBlogs.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
<title>Fork My Life</title>
<link rel="icon" type="image/png" href="images/standard/header-fml.png">
  </head>
  <body>
      <div class="nav-bar" align="center">
        <a href='?controller=blog&action=readAll' title='All Blogs'><i class="fas fa-blog fa-3x"></i></a>
       <a href='?controller=pages&action=profile' title='Profile'>
                <?php
       // if there is a proile photo uploaded it will show it in Nav, or it will show profile icon
           $file = 'views/images/prophotos/' . $username . '.jpeg';
               if(file_exists($file)){
                   $img = '<img class=' . '"navprofile"' . "src='$file' width='50' />";
                   echo $img;
               } else {
                   echo "<i class='far fa-user-circle fa-3x'></i>";
               }
       ?></a>
        <?php  //check user is not a guest 
        if(!($_SESSION["username"] == 'guest'))  {
            ?>    
        <a href='?controller=blog&action=create' title='New Blog'><i class="fas fa-plus fa-3x"></i></a>
        <a href='views/chatbox/chat.php' title='Live Chat'><i class="fas fa-comment-dots fa-3x"></i></a> 
        <a href='landingpage.php' title='Sign Out'><i class="fas fa-sign-out-alt fa-3x"></i></a> 
    <?php } //if user is a guest, they can only read blogs or sign up/login
     else {
         ?>     
        <a href='views/user/signup.php' title='Sign Up'><i class="fas fa-user-plus fa-3x"></i></a>
        <a href='views/user/login.php' title='Login'><i class="fas fa-portrait fa-3x"></i></a> 
    <?php } ?>
      </div>

<!-- this div displays the page/view made by the controllers&actions controlled by routes -->
            <div class="w3-container"> 
                <?php require_once('routes.php'); ?>
            </<div>
                <br><br>
<!-- this div displays the footer on each page -->
<!--            <div class="w3-container w3-gray">
                <footer>
                    Copyright &COPY; <?//= date('Y'); ?>
                </footer>
            </div>-->
<!-- scripts required for bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>