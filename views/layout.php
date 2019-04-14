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
<!-- link to internal style sheet -->
<link rel="stylesheet" href="views/css/styles.css">
<!-- link to fontawesome icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<title>Fork My Life</title>
  </head>
  <body>
      <div class="nav-bar">
        <a href='/FinalProject'><i class="fas fa-home fa-3x"></i></a>
        <a href='?controller=blog&action=readAll'><i class="fas fa-blog fa-3x"></i></a>
        <?php  //check user is not a guest 
        if(!($_SESSION["username"] == 'guest'))  {
            ?>    
        <a href='?controller=blog&action=create'><i class="fas fa-plus fa-3x"></i></a>
        <a href='landingpage.php'><i class="fas fa-sign-out-alt fa-3x"></i></a> 
    <?php } //if user is a guest, they can only read blogs or sign up/login
     else {
         ?>     
        <a href='views/user/signup.php'><i class="fas fa-user-plus fa-3x"></i></a>
        <a href='views/user/login.php'><i class="fas fa-portrait fa-3x"></i></a> 
    <?php } ?>
      </div>

<!-- this div displays the page/view made by the controllers&actions controlled by routes -->
            <div class="w3-container"> 
                <?php require_once('routes.php'); ?>
            </<div>
<!-- this div displays the footer on each page -->
            <div class="w3-container w3-gray">
                <footer>
                    Copyright &COPY; <?= date('Y'); ?>
                </footer>
            </div>
  </body>
</html>