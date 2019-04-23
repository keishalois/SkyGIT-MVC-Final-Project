function checkUserExists() {
    var username = $("#usernameInput")[0].value;
    var email = $("#emailInput")[0].value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (JSON.parse(xmlhttp.response)['userExists']) {
                alert("User exists, sorry!");
            } else {
                $('#signUpForm').submit()
            }
        }
    };
    xmlhttp.open("GET", "checkUsernameExists.php?username=" + username + "&email=" + email, true);
    xmlhttp.send();
}


