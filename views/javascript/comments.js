function showComments(id) {
    xhttp= new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
 // When readyState is 4 and status is 200, the response is ready
            if(this.readyState===4 && this.status ===200){
//this says we want to send back the result of this function to the element with the ID=result
                document.getElementById("comment").innerHTML = this.responseText;
            }
        };
//this opens the Game Functions PHP file and sends the RPS - Rock, Paper or Scissors as 'choice'
    xhttp.open("GET", "?controller=comment&action=readAll&blogid="+ id, true); 
    xhttp.send();
            }
            
function addComment(id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "?controller=comment&action=create&blogid=" + id, true);
        xmlhttp.send();
    }
    
function deleteComment(id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "?controller=comment&action=delete&commentid=" + id, true);
        xmlhttp.send();
    }