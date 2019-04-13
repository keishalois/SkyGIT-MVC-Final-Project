<!DOCTYPE html>

<?php
// I do think this php section should in theory be put somewhere else but will try later cos it works
    session_start();
    include "C:/xampp/htdocs/FinalProject/models/user.php"; 
    if (!empty($_POST)){
        $usn= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $psw= filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $login=new User($usn, $psw);
        $login->loginUser();  
    }
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Guest?- Fork My Life</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body class="container landingpage"> 
<div class="container">
<!--	<div class="row justify-content-md-center">-->
		<div class="col col-lg-12"></div>
			<div id="content">
        <div class="formLog">
	<form action="" method="post" class="form">
        <input type="hidden" name="username" value="guest" required/><br>
        <input type="hidden" name="password" value="guest" required/>
        Are you sure you don't want to <a href='../pages/signup.php' class="guestsign">sign up</a>?! 
        <br> <br>
        <input type="submit" class="btn btn-default btn-lg" href='#'value="Go Guest!"/>
        </form>
        </div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</body>
</html>