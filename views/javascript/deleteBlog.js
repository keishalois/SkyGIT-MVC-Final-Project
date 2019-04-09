  function deleteBlog(id) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "?controller=blog&action=delete&blogid=" + id, true);
        xmlhttp.send();
        goBackToReadAll();
    }
    function goBackToReadAll() {
        window.refresh;
        window.location.href = "http://localhost:8080/FinalProject/index.php?controller=blog&action=readAll";
}


