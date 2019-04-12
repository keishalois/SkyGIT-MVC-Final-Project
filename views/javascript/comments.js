function addComment(id) {
            var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function(){
 // When readyState is 4 and status is 200, the response is ready
            if(this.readyState===4 && this.status ===200){
//this says we want to send back the result of this function to the element with the ID=result
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "?controller=comment&action=create&blogid=" + id, true);
        xmlhttp.send();
    }
    
function showComments(id) {
     var xmlhttp = new XMLHttpRequest();
         xmlhttp.open("GET", "?controller=comment&action=readAll&blogid=" + id, true);
        xmlhttp.send();

}