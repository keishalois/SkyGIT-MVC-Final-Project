<?php

class CommentController {
    //function to tell the page where to get the data to display when readall comments is used
    public function readAll() {
    // we store all the posts in a variable and get the blogid from the url to only display relevant comments
      $viewblogcomments = Comment::allComments($_GET['blogid']);
    //this brings up the html to display the list of comments
      require_once('views/comments/readwithcomments.php');
    }
    
    //function to tell the page what to do when we want to create a new comment
    public function create() {
      // we expect a url of form ?controller=comment&action=create
      // if it's a GET request display a blank form for creating a new comment
      // else it's a POST so add to the database using models/comment.php
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
            require_once('views/blogs/read.php');
      }
      else { 
         $blogcomment = Comment::addComment($_GET['blogid']);
              require('models/comment.php');
      }
    }
    
    //function to tell page what to do when we want to delete a comment
    public function delete() {
     $commentid = $_GET['commentid'];
     Comment::deleteComment($commentid);
     
     //note to self: might be a solution to redirect after deleting?
//           require_once('views/comments/readwithcomments.php');
    }
}
    
