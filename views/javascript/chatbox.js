$(document).ready(function(){
    
    	$("#exit").click(function(){
		var exit = confirm("Sure you want to leave this session?");
		if(exit===true){
            $.get("?controller=chat&action=exitChat");				
            window.location.href = 'index.php?controller=blog&action=readAll';}		
	});  }); 
    
$(document).ready(function() {
//    var chatInterval = 150; //refresh interval in ms
//     var $chatOutput = $("#chatbox");
    var $chatInput = $("#usermsg");
    var $chatSend = $("#submitmsg");
    
    function sendMessage() {
        var chatInputString = $chatInput.val();
        $.post("?controller=chat&action=addMessage", {
            text: chatInputString
        });
//         retrieveMessages();
    }

//     function retrieveMessages() {
//         $.get("?controller=chat&action=readLog", function() {
//             $chatOutput.html(); //Paste content into chat output
//         });
//     }

function loadLog() {
    xhttp= new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
 // When readyState is 4 and status is 200, the response is ready
            if(this.readyState===4 && this.status ===200){
//this says we want to send back the result of this function to the element with the ID=comment
                document.getElementById("chatbox").innerHTML = this.responseText;
            }
        };
//this opens the readall comments PHP file in views and sends the blogid to get comments associated with blog
    xhttp.open("GET", "?controller=chat&action=readLog", true); 
    xhttp.send();
            }
	
$chatSend.click(function() {
        sendMessage();
    });
	
 setInterval (loadLog, 1500); });



