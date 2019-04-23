<?php

class Chatbox {
	
private $user;
private $message;
private $timestamp;

    public function getUser() {
        return $this->user;
    }
    
    public function getMessage() {
        return $this->message;
    }
    
    public function getTimestamp() {
        return $this->timestamp;
    }

    public function __construct($user, $message, $timestamp) {
      $this->user    = $user;
      $this->message  = $message;
      $this->timestamp = $timestamp;
    }

    public function loginChat($username) {
            $db = Db::getInstance();
            $req = $db->prepare("Insert into Chatbox(UserID, Message) values ((SELECT UserID from users WHERE Username = :username), ' has entered the chat...')");
                $req->bindParam(':username', $username);
        // set parameters and execute
        if(!empty($_SESSION)){
            $username = $_SESSION["username"];
            }
            $req->execute();
    }

    public function exitChat($username) {
                    $db = Db::getInstance();
            $req = $db->prepare("Insert into Chatbox(UserID, Message, Timestamp) values ((SELECT UserID from users WHERE Username = :username), ' has left the chat!', CURRENT_TIMESTAMP)");
                $req->bindParam(':username', $username);
        // set parameters and execute
        if(!empty($_SESSION)){
            $username = $_SESSION["username"];
            }
            $req->execute();
    }

    public function addChatMessage() {
            $db = Db::getInstance();
            $req = $db->prepare("Insert into Chatbox(UserID, Message, Timestamp) values ((SELECT UserID from users WHERE Username = :username), :message, CURRENT_TIMESTAMP)");
                $req->bindParam(':username', $username);
                $req->bindParam(':message', $message);
        // set parameters and execute
        if(!empty($_SESSION)){
            $username = $_SESSION["username"];
            }
        if(isset($_POST['usermsg'])&& $_POST['usermsg']!=""){
            $filteredMessage = filter_input(INPUT_POST,'usermsg', FILTER_SANITIZE_SPECIAL_CHARS);
        }
            $message = $filteredMessage;
            $req->execute();
    }

    public function viewChatLog() {
    //first make an empty list array to hold chats returned from sql query
      $list = [];
        //connect to database
      $db = Db::getInstance();
      $req = $db->query('SELECT users.Username, chatbox.Message, chatbox.Timestamp FROM chatbox INNER JOIN users ON chatbox.UserID = users.UserID  ORDER BY Timestamp asc;');
      $chatmessages = $req->fetchAll();
      //get a list of chat objects from the database results
      foreach($chatmessages as $chatmessage) {
        $list[] = new Chatbox($chatmessage['Username'], $chatmessage['Message'], $chatmessage['Timestamp']);
      }
      return $list;
    }
    

}