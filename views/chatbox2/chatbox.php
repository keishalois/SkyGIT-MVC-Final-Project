<!DOCTYPE html>
<html>
               <?php 
//check uer is logged in otherwise send them to the landing page
       session_start();   
       if(!empty($_SESSION)){
            $username = $_SESSION["username"];
                $fp = fopen ( "chatlog.html", 'a' );
		fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ["username"] . " has joined the chat session.</i><br></div>" );
		fclose ( $fp );
    }
    else {header("Location:../../landingpage.php");} 
    
    if(isset($_GET['logout'])){ 
    //Simple exit message
    $fp = fopen("chatlog.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION["username"] ." has left the chat session.</i><br></div>");
    fclose($fp);
        header("Location:../../index.php");} //Redirect the user ?>
    
    
<head>
<title>FML ChatBox</title>
<link type="text/css" rel="stylesheet" href="chat.css" />
</head>
 
<div id="wrapper">
    <div id="menu">
<p class="welcome">Welcome, <b><?php echo $_SESSION['username']; ?></b></p>        
<p class="logout"><a id="exit" href="#">Exit Chat</a></p>
        <div style="clear:both"></div>
    </div>
     
<div id="chatbox"><?php
if(file_exists("chatlog.html") && filesize("chatlog.html") > 0){
    $handle = fopen("chatlog.html", "r");
    $contents = fread($handle, filesize("chatlog.html"));
    fclose($handle);
    echo $contents;
}
?></div>
     
    <form name="message" action="" method="POST">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
	//If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Are you sure you want to end the session?");
		if(exit===true){window.location = 'chatbox.php?logout=true';}		
	});
});


	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
                loadLog;
		return false;
	});
        
        	function loadLog(){
     var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
		$.ajax({
			url: "chatlog.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div	
				
				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}					
		  	}
		});
	}
 setInterval (loadLog, 2500);
</script>
</body>
</html>
