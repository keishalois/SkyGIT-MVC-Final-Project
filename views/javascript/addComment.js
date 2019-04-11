function addComment(id) {
            var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "?controller=comment&action=create&blogid=" + id, true);
        xmlhttp.send();
    }