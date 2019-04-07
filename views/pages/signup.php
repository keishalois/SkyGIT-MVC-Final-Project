<!DOCTYPE html>

<?php
    session_start();
    include "/Applications/XAMPP/xamppfiles/htdocs/FinalProject/models/user.php"; 
    if (!empty($_POST)){
        $email= filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $usn= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $psw= $_POST["password"];
        $create=new User($email, $usn, $psw);
        $create->createUser();  
        $login = $create->loginUser();  
    }
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up - FML</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/playbeforeyoupay.css">
  <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
</head>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col col-lg-12"></div>
			<div id="content">
        <form action="" method="post" class="form">
        Email address: <input type="text" name="email" placeholder="Email address" required/>
        Username: <input type="text" name="username" placeholder="Username" />
        Password: <input type="password" name="password" placeholder="Password" required/>
        <input type="submit" class="btn btn-default btn-lg" href='index.php'value="Register"/>
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