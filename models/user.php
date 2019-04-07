<?php

    require_once __DIR__ . "/../connection.php";


class User {
    protected $email;
    protected $username;
    protected $password;
    protected $usertype;
	
        public function __construct($username, $password) {
		$this->username = $username;
                $this->password = $password;
	}
        
        public function loginUser() {
        $db = Db::getInstance();        
        $sql = "SELECT Username, Password FROM users WHERE Username= :user AND Password= :psw";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['user'=> $this->username, 'psw'=> $this->password]);
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
        $sql = "INSERT INTO users (Email, Username, Password, UserType) VALUES (:email, :user, :psw, 'blogger')";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['email'=> $this->email, 'user'=> $this->username, 'psw'=> $this->password]);
                }

        catch (PDOException $e) {
            $error = $e->errorInfo();
            die("Sign up failed sorry ..." . $error . $e->getMessage());
        }
        unset($stmt);
    }
       
        }