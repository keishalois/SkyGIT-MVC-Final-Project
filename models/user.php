<?php

    require_once __DIR__ . "/../connection.php";


class User {
    protected $email;
    protected $username;
    protected $password;
    protected $usertype;
	
        public function __construct($username, $password) {
//                $this->email = $email;
		$this->username = $username;
                $this->password = $password;
	}
        
        public function loginUser() {
        $db = Db::getInstance();        
        $sql = "SELECT Username, Password FROM users WHERE Username= :username AND Password= :psw";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['username'=> $this->username, 'psw'=> $this->password]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION["username"]=$row["Username"];
                    header("Location:../../index.php");}
            
        } catch (PDOException $e) {
            $error = $e->errorInfo();
            die("Login failed sorry ..." . $error . $e->getMessage());
        }
        unset($stmt);
    }
    
            public function createUser() {
        $db = Db::getInstance();        
        $req = $db->prepare( "INSERT INTO users (Email, Username, Password, UserType) VALUES (:email, :username, :password, 'blogger')");
            $req->bindParam(':username', $username);
            $req->bindParam(':password', $password);
            $req->bindParam(':email', $email);
        try {
    if(isset($_POST['username'])&& $_POST['username']!=""){
       $username = $filteredUser = filter_input(INPUT_POST,'username', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if(isset($_POST['password'])&& $_POST['password']!=""){
        $password = $filteredContent = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if(isset($_POST['email'])&& $_POST['email']!=""){
       $email = $filteredEmail = filter_input(INPUT_POST,'email', FILTER_SANITIZE_SPECIAL_CHARS);
    }
$req->execute(); }
        catch (PDOException $e) {
            $error = $e->errorInfo();
            die("Sign up failed sorry ..." . $error . $e->getMessage()); }
        unset($req);
    }
       
        }