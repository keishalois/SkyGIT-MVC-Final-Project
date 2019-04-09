<!DOCTYPE html>
<html>
  <head> 
       <?php session_start();   
       if(!empty($_SESSION)){
            $username = $_SESSION["username"];
    }
    else {header("Location:landingpage.php");} ?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico|Pangolin" >
<link rel="stylesheet" href="views/css/styles.css">
<title>FML Blog</title>
  </head>
  <body>
    <header class="w3-container w3-gray">
      <a href='/FinalProject'>Home</a>
      <a href='?controller=blog&action=readAll'>Blog Posts</a>
      <a href='?controller=blog&action=create'>Add New Blog Post</a>
      <a href='landingpage.php'>Logout</a>
    </header>
<div class="w3-container">
    <?php require_once('routes.php'); ?>
</<div>
<div class="w3-container w3-gray">
    <footer >
        Copyright &COPY; <?= date('Y'); ?>
    </footer>
</div>
  </body>
</html>