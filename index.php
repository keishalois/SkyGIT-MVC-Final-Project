<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fork My Life</title>
<!--        <link rel="icon" type="image/png" href="views/images/standard/header-fml.png">-->
    </head>
    <body>
        <?php
    require_once('connection.php');
        
    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
  } else {
        $controller = 'pages';
        $action     = 'profile';
  }
  //this is checking if the controller is comment with action readall as comment readall
  // is what gives us the data for the read all comments on a blogpost and we don't want a nav bar or fotter
    if (!($controller === 'comment' && $action === 'readAll') || ($controller === 'chat' && $action === 'readAll')) {
        //if it is anything but comment-readall, then use layout.php as a template html layout
            require_once('views/layout.php'); }
    else {
        //commentlayout.php is only used in comment_controller readall in the view/blogs/read.php
        //file when you click on the button to see the blog comments and it loads commentlayout.php
        require_once('views/commentlayout.php'); 
        }
        ?>
    </body>
</html>

