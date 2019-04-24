<?php

include __DIR__ . "/../../models/user.php";
//Key value pair json arrays.
if (User::checkUsernameExists($_GET['username'], $_GET['email'])) {
    $response = array('userExists' => true);
} else {
    $response = array('userExists' => false);
}
echo json_encode($response);
?>