<?php

class PagesController {
   
    public function home() {
       //this starts a session on the homepage and lets us display the username
    if(!empty($_SESSION)){
            $username = $_SESSION["username"];
    }
    else {header("Location:landingpage.php");} 
    
      //example data to use in the home page
      require_once('views/pages/home.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
    
}
