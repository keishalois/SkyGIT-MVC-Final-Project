  function deleteBlog(id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "?controller=blog&action=delete&blogid=" + id, true);
        xmlhttp.send();
        goBackToReadAll();
    }
    function goBackToReadAll() {
        window.refresh;
        window.location.href = "http://localhost/FinalProject/index.php?controller=blog&action=readAll";
}

  function deleteBlogonUserPage(id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "?controller=blog&action=delete&blogid=" + id, true);
        xmlhttp.send();
        goBackToUserHome();
    }

    function goBackToUserHome() {
        window.refresh;
        window.location.href = "http://localhost/FinalProject/index.php?controller=pages&action=home";
}










