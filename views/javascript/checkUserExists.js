//Ensure username and email fields don't contain spaces before and after string. Trim if so. Variables match ids used in labels on the HTML Signup.php form.
function checkUserExists() {
    var username = $("#usernameInput")[0].value;
    var email = $("#emailInput")[0].value;

    //Ajax to check everything's okay and refresh the page. Script also handles the response from the below...
    //...ajax open request, evoking the php to check whether the user exists in the database...
    // If true, the alert pops up to tell them it's in use; if not, the form is submitted (to register the user).
    //Due to time constraints, admittedly had to get dev help (Charlotte) and quickly use json (array) to handle the response.

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (JSON.parse(xmlhttp.response)['userExists']) {
                alert("Sorry, that username's taken! Try another?");
            } else {
                $('#signUpForm').submit()
            }
        }
    };
    // Validation to check fields aren't blank. If not, run the php, appending the user's username and email within the URL.
    if (username == "" || email == "") {
        alert("Uh oh, please enter an email address and a username.")
    } else {
        xmlhttp.open("GET", "checkUsernameExists.php?username=" + username + "&email=" + email, true);
        xmlhttp.send();
    }
}


