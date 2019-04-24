<?php

include __DIR__ . '/../models/blog.php';
include __DIR__ . '/../models/comment.php';


//this is used after the user is logged in/is a guest from the landing page goes to index.php
//index.php looks to the layout.php files and they call on the routes.php where a class called
//pagescontroller is established
class PagesController {
   //this function will direct the user to the home page after logging in
        public function profile() {
   //this starts a session on the homepage and redirects to landing page is the user is not logged in
            if(!empty($_SESSION)){
                $username = $_SESSION["username"];
            } else {header("Location:landingpage.php");} 
            try {
     // this is the logic to show the user blogposts on the home page after they have logged in
                $blogposts = BlogPost::allUserBlogs($username);
                $comments = Comment::allUserComments($username);
                } catch (Exception $ex) {
                    return call('pages', 'error');
                }
      //this brings up the html to be used in the profile page
      require_once('views/pages/profile.php');
    }
    
    //this function takes us to the error page is something goes wrong
    public function error() {
      require_once('views/pages/error.php');
    }
    
        public function addadmin() {
      require_once('views/pages/addadmin.php');
    }
    
      public function aboutus() {
      require_once('views/pages/aboutus.php');
    }
    
}
