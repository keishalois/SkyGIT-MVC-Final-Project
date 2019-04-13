<?php

class CommentController {
    public function readAll() {
      // we store all the posts in a variable
      $viewblogcomments = Comment::allComments($_GET['blogid']);
      require_once('views/comments/readwithcomments.php');
    }

    public function create() {
      // we expect a url of form ?controller=comment&action=create
      // if it's a GET request display a blank form for creating a new product
      // else it's a POST so add to the database and redirect to readAll action
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
            require_once('views/blogs/read.php');
      }
      else { 
         $blogcomment = Comment::addComment($_GET['blogid']);
              require('models/comment.php');
      }
    }
    
    public function delete() {
     $commentid = $_GET['commentid'];
     Comment::deleteComment($commentid);
    }
}
    
