<!DOCTYPE html>
<html>
  <head> 
       <?php session_start();   
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
<link rel="stylesheet" href="views/chatbox/chat.css">
<!-- link to fontawesome icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<!-- javascript links for blog page -->
        <script src="views/javascript/chatbox.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<title>Live Chat - Fork My Life</title>
  </head>
  <body>
      <div class="w3-container">
    <?php require_once('routes.php'); ?>
</div>
    
<!-- scripts required for bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  
</body>
</html>