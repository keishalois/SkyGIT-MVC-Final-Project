<!DOCTYPE html>

<?php
// I do think this php section should in theory be put somewhere else but will try later cos it works
    session_start();
    include __DIR__ .  "/../../models/user.php"; 
    if (!empty($_POST)){
//        $email= filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $usn= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $psw= filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $create=new User($usn, $psw);
        $create->createUser();  
        $login = $create->loginUser();  
    }
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up - Fork My Life</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
</head>
<body class="container landingpage"> 
<div class="container">
	<div class="col col-lg-12"></div>
            <div id="content">

         <div class="area">
		<h2>#FML: Fork My Life</h2>
                <h4>For all those FML moments</h4>
                <p><i>FYI: A fork is a copy of a repository.</i>
		<hr>
         </div>
        <div class="form-sign">                
        <form action="" method="post" class="form">
             <span class="input-group-addon"><i class="far fa-envelope"></i></span> <input type="text" name="email" placeholder="Email address" required/><br>
             <span class="input-group-addon"><i class="far fa-user"></i></span> <input type="text" name="username" placeholder="Username" /><br>
            <span class="input-group-addon"><i class="fas fa-unlock-alt"></i></span> <input type="password" name="password" placeholder="Password" required/><br><br>
        <input type="submit" class="btn btn-default btn-lg" href='../index.php'value="Register"/>
        </form>
        <br>
        Already signed up?<a class="btn btn-default btn-lg" href='login.php'>Log in!</a>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</body>
</html>