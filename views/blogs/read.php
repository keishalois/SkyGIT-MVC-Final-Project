//<?php
//$file = 'views/images/' . $blogpost->title . '.jpeg';
//if(file_exists($file)){
//    $img = "<img src='$file' width='150' />";
//    echo $img;
//}
//else
//{
//echo "<img src='views/images/standard/_noproductimage.png' width='150' />";
//}
//
//
//
?>
<html>
    <head>
        <script src="/FinalProject/views/javascript/deleteBlog.js"></script>
    </head>
    <body>
        <p>This is the requested blog:</p>

        <p>Blog ID: <?php echo $blogpost->blogid; ?></p>
        <p>Blog Name: <?php echo $blogpost->title; ?></p>
        <p>Blog: <?php echo $blogpost->content; ?></p>
        <button class="w3-gray" onclick="deleteBlog(<?php echo $blogpost->blogid; ?>)">Delete Blog Post</button> 
        <p></p>
    </body>
</html>