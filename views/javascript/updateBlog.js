function updateBlog(id) {
            var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "?controller=blog&action=update&blogid=" + id, true);
        xmlhttp.send();
        goToUpdate(id);
    }
    function goToUpdate(id) {
        window.refresh;
        window.location.href = "http://localhost/FinalProject/index.php?controller=blog&action=update&blogid="+id;
}