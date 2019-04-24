<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ChatController {
    

public function readAll() {
    // we store all the posts in a variable and get the blogid from the url to only display relevant comments
      $chatmessages = Chatbox::viewChatLog();
    //this brings up the html to display the list of comments
      require_once('views/chatbox/chat.php');
    }

public function addMessage() {
	Chatbox::addChatMessage($_GET['text']);
        require('models/chat.php');

}

public function exitChat() {
	Chatbox::exitChat($_SESSION["username"]);
}

}