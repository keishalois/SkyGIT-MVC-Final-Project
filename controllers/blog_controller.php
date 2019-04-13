<?php
include_once __DIR__ . '/../models/comment.php';

class BlogController {
    public function readAll() {
      // we store all the posts in a variable
      $blogposts = BlogPost::all();
      require_once('views/blogs/readAll.php');
    }

    public function read() {
       $blogid = $_GET['blogid'];
      // we expect a url of form ?controller=posts&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($blogid)){
        return call('pages', 'error');
      }
      try{
      // we use the given id to get the correct post
            $blogpost = BlogPost::find($blogid);
            require_once('views/blogs/read.php');
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            require_once('views/blogs/read.php');
            }       
        else {  $blogcomment = Comment::addComment($blogid);
                    }
      }
      catch (Exception $ex){
            return call('pages','error');
        }         
    }
           
    public function create() {
      // we expect a url of form ?controller=products&action=create
      // if it's a GET request display a blank form for creating a new product
      // else it's a POST so add to the database and redirect to readAll action
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
          require_once('views/blogs/create.php');
      }
      else { 
          BlogPost::add();
             
            $blogposts = BlogPost::all(); //$blogposts is used within the view
            require_once('views/blogs/readAll.php');
      }
    }

    public function update() {     
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
          if (!isset($_GET['blogid'])) {
          return call('pages', 'error');}
        // we use the given id to get the correct product
        $blogpost = BlogPost::find($_GET['blogid']);
      
        require_once('views/blogs/update.php');
        }
      else
          { 
            $blogid = $_GET['blogid'];
            BlogPost::update($blogid);       
            $blogposts = BlogPost::all();
            require_once('views/blogs/readAll.php');
      }
    }
    
     
     public function delete() {
      BlogPost::remove($_GET['blogid']);
      $blogposts = BlogPost::all();
      require_once('views/blogs/readAll.php');
  }
    }
 
