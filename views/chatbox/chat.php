<head>
<title>FML ChatBox</title>
<link type="text/css" rel="stylesheet" href="views/chatbox/chat.css" />
        <script src="views/javascript/chatbox.js"></script>
</head>
 
<div id="wrapper">
    <div id="menu">
<p class="welcome">Welcome, <b><?php echo $_SESSION['username']; ?></b></p>        
<p class="logout"><a id="exit" href="#">Exit Chat</a></p>
        <div style="clear:both"></div>
    </div>
     
<div id="chatbox">
<?php
    foreach($chatmessages as $chatmessage) { ?>
        <div class="chatboxmessage">
            <div>
<!-- this div displays the date and username associated with the comment -->
<div> <p>
              <span class="chatdate"> <?php echo $chatmessage->getTimestamp();?> </span>
              <span class="chatname"> <?php echo $chatmessage->getUser();?></span>
              <span class="chatmessage"><?php echo $chatmessage->getMessage();?> </span>
    </p>
                </div>
            </div> <?php } ?>
        </div>
</div>
     
    <form name="message" action="" method="POST">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
</div> 
