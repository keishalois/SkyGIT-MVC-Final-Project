<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fork My Life</title>
        <link rel="icon" type="image/png" href="views/images/standard/header-fml.png">
        <?php
        //this checks if any session is started and logs the user out
        session_start();
        //clear session
        session_unset();
        //destroy session
        session_destroy();
        ?>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="views/css/styles.css">
</head>
<body>
<!--    <br><br><br> commented these out to push it up, so you don't have to scroll down to log in-->

<div class="container center-block">
<!--	<div class="row justify-content-md-center">-->
		<div class="col col-lg-12"></div>
			<div id="content">
                           <div class="area">
                               <img class="landingpagelogo" src ="views/images/standard/logo.png">
                               <br><br>
				<h2>#FML: Fork My Life</h2>
                                <h4>For all those FML moments</h4>
                                <p><i>FYI: A fork is a copy of a repository.</i>
				<hr>
                                <a class="btn btn-default btn-lg" href='views/user/login.php'>Sign in </a>
                                <a class="btn btn-default btn-lg" href='views/user/signup.php'>Sign up</a>
                                <a class="btn btn-default btn-lg" href='views/user/guestpage.php'>Guest?</a>
                           </div>
                        </div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</body>