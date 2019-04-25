<head>
<title>FML ChatBox</title>
<link type="text/css" rel="stylesheet" href="views/chatbox/chat.css" />
        <script src="/views/javascript/chatbox.js"></script>
<!--    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>-->
    <script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>
</head>
 
<div id="wrapper">
    <div id="menu">
<p class="welcome">Hi <b><?php echo $_SESSION['username']; ?></b></p>        
<p class="logout"><a id="exit" href="#">Leave ChatBox</a></p>
        <div style="clear:both"></div>
    </div>
     
<div id="chatbox"></div>
     
    <form name="message" action="" method="POST">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
   </div> 

