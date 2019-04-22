
<?php
// I do think this php section should in theory be put somewhere else but will try later cos it works
    include __DIR__ .  "/../../models/user.php"; 
    if (!empty($_POST)){
//        $email= filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $usn= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $psw= filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $create=new User($usn, $psw);
        $create->addAdmin();  
    }
?>

<div class="container">
	<div class="col col-lg-12"></div>
            <div id="content">

        <!--<div class="form-sign">-->                
        <form action="" method="post" class="form">
             <span class="input-group-addon"><i class="far fa-envelope"></i></span> <input type="text" name="email" placeholder="Email address" required/><br>
             <span class="input-group-addon"><i class="far fa-user"></i></span> <input type="text" name="username" placeholder="Username" /><br>
            <span class="input-group-addon"><i class="fas fa-unlock-alt"></i></span> <input type="password" name="password" placeholder="Password" required/><br><br>
        <input type="submit" class="btn btn-default btn-lg" href='' value="Add Another Admin!"/>
        </form>
        </div>
</div>
