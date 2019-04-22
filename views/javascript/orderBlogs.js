function orderBlogs(selectObject) {
            var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "?controller=blog&action=readAll&order=" + selectObject.value, true);
        xmlhttp.send();
        goToAll(selectObject);
    }
    function goToAll(selectObject) {
        window.refresh;
        window.location.href = "index.php?controller=blog&action=readAll&order=" + selectObject.value;
    }
