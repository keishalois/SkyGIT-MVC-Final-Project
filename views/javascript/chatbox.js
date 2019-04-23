$(document).ready(function(){
    
    	$("#exit").click(function(){
		var exit = confirm("Are you sure you want to end the session?");
		if(exit===true){
            $.get("?controller=chat&action=exitChat");				
            window.location.href = 'index.php?controller=blog&action=readAll';}		
	});  }); 
    
$(document).ready(function() {
   var chatInterval = 250; //refresh interval in ms
    var $chatOutput = $("#chatbox");
    var $chatInput = $("#usermsg");
    var $chatSend = $("#submitmsg");
    
    function sendMessage() {
        var chatInputString = $chatInput.val();
        $.get("?controller=chat&action=addMessage", {
            text: chatInputString
        });
        retrieveMessages();
    }

    function retrieveMessages() {
        $.get("?controller=chat&action=readAll", function() {
            $chatOutput.html(); //Paste content into chat output
        });
    }
        $chatSend.click(function() {
        sendMessage();
    });

	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("?controller=chat&action=addMessage", {text: clientmsg});				
		$("#usermsg").attr("value", "");
                loadLog;
		return false;
	});

    function loadLog(){
     var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
		$.ajax({
			url: "?controller=chat&action=readAll",
			cache: false,
			success: function(){		
				$("#chatbox").html(); //Insert chat log into the #chatbox div	
				
				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
				$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}					
		  	}
		});
	}
 setInterval (loadLog, 2500); });
 


//$(document).ready(function() {
//    var chatInterval = 250; //refresh interval in ms
//    var $chatOutput = $("#chatbox");
//    var $chatInput = $("#usermsg");
//    var $chatSend = $("#submitmsg");
//
//    function sendMessage() {
//        var userNameString = $user.val();
//        var chatInputString = $chatInput.val();
//
//        $.get("./write.php", {
//            username: userNameString,
//            text: chatInputString
//        });
//
//        $userName.val("");
//        retrieveMessages();
//    }
//
//    function retrieveMessages() {
//        $.get("./read.php", function(data) {
//            $chatOutput.html(data); //Paste content into chat output
//        });
//    }
//
//    $chatSend.click(function() {
//        sendMessage();
//    });
//
//    setInterval(function() {
//        retrieveMessages();
//    }, chatInterval);
//});
//
//$(document).ready(function(){
//    //If user wants to end session
//    $("#exit").click(function(){
//        var exit = confirm("Are you sure you want to end the session?");
//        if(exit===true){window.location = '?controller=chat&action=exitChat';}       
//    });
//});

//function exitChat() {
//        var xmlhttp = new XMLHttpRequest();
//        var exit = confirm("Are you sure you want to end the session?");
//        if(exit===true){
//        xmlhttp.open("GET", "?controller=chat&action=exitChat", true);
//                            xmlhttp.send();
//                            goBackToReadAll();
//    }  
//}

//
//function addMessage() {
//        var xmlhttp = new XMLHttpRequest();
//        xmlhttp.open("GET", "?controller=chat&action=addMessage", true);
//        xmlhttp.send();
//    }

//function viewChatLog() {
//    xhttp= new XMLHttpRequest();
//        xhttp.onreadystatechange = function(){
// // When readyState is 4 and status is 200, the response is ready
//            if(this.readyState===4 && this.status ===200){
////this says we want to send back the result of this function to the element with the ID=comment
//                document.getElementById("chatbox").innerHTML = this.responseText;
//            }
//        };
////this opens the readall comments PHP file in views and sends the blogid to get comments associated with blog
//    xhttp.open("GET", "?controller=chat&action=readAll", true); 
//    xhttp.send();
//            }
            
//
//    function goBackToReadAll() {
//        window.refresh;
//        window.location.href = "index.php?controller=blog&action=readAll";
//}

