<?php

class CommentController {
    public function readAll() {
      // we store all the posts in a variable
      $blogcomments = Comment::allComments($_GET['blogid']);
      require_once('views/blogs/read.php');
    }
}

//    public function read() {
//      // we expect a url of form ?controller=posts&action=show&id=x
//      // without an id we just redirect to the error page as we need the post id to find it in the database
//      if (!isset($_GET['blogid'])){
//        return call('pages', 'error');
//      }
//      try{
//      // we use the given id to get the correct post
//      $comment = Comment::find($_GET['blogid']);
//      require_once('views/comments/read.php');
//      }
// catch (Exception $ex){
//     return call('pages','error');
// }
//    }
//    public function create() {
//      // we expect a url of form ?controller=comment&action=create
//      // if it's a GET request display a blank form for creating a new product
//      // else it's a POST so add to the database and redirect to readAll action
////      if($_SERVER['REQUEST_METHOD'] == 'GET'){
//          require_once('models/comment.php');
////      }
////      else { 
//         $blogcomment = Comment::addComment($_GET['blogid']);
//             
////            $comments = Comment::all(); //$products is used within the view
//            require_once('views/blogs/read.php');
//      }
//    }

//    public function update() {
//        
//      if($_SERVER['REQUEST_METHOD'] == 'GET'){
//          if (!isset($_GET['commentid'])) {
//          return call('pages', 'error');}
//        // we use the given id to get the correct product
//        $comment = Comment::find($_GET['commentid']);
//      
//        require_once('views/comments/update.php');
//        }
//      else
//          { 
//            $commentid = $_GET['blogid'];
//            Comment::update($commentid);
//                        
//            $comments = Comment::all();
//            require_once('views/comments/readAll.php');
//      }
//    }
    
