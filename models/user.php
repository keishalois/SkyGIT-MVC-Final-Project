<?php

require_once __DIR__ . "/../connection.php";
 function userExists($username) {
    $alertmsgexists = "$username already exists";
'<script type="text/javascript">alert("$alertmsgexists")</script>';
}

function userAdded($username) {
    $userForAlert = $_POST['username'];
    $alertmsgadded = "$username - welcome to our blog";
//    echo '<script type="text/javascript">alert("$alertmsgadded");document.location="index.php?controller=blog&action=readAll"</script>';
    echo '<script type="text/javascript">alert("$alertmsgadded");document.location="index.php?controller=blog&action=readAll"</script>';

}

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

    public function getUsername() {
        return $this->username;
    }
    
    public function getAdmin(){
            return $this->usertype;
        }
        
    public function verifyUser() {
        $db = Db::getInstance();
        $sql = "SELECT Password FROM users WHERE Username= :username";
        $req = $db->prepare($sql);
        $req->execute(['username' => $this->username]);
        $result = $req->fetch();
        return password_verify($this->password, $result['Password']);
    }
    public function loginUser() {
        $isVerified = User::verifyUser();
        if ($isVerified) {
            $_SESSION["username"] = $this->username;
            header("Location:../../index.php?controller=blog&action=readAll");
        } else {
            die("Uh oh, your username isn't right. Try again?");
        }
    }

    public function checkUserExists() {
        $db = Db::getInstance();
        $username = $_POST['username'];
        $email = $_POST['email'];
        $checkAccount = $db->prepare("SELECT * from users WHERE Email = :email OR Username = :username");
        $checkAccount->bindParam(':username', $username);
        $checkAccount->bindParam(':email', $email);
        $checkAccount->execute();

        $rows = $checkAccount->fetchAll();
        $num_rows = count($rows);
        return $num_rows;
    }

    static public function checkUsernameExists($username, $email) {
        $db = Db::getInstance();
        $checkAccount = $db->prepare("SELECT * from users WHERE Email = :email OR Username = :username");
        $checkAccount->bindParam(':username', $username);
        $checkAccount->bindParam(':email', $email);

        $checkAccount->execute();

        $rows = $checkAccount->fetchAll();
        $num_rows = count($rows);
        if ($num_rows == 0) {
            return false;
        } else {
            return true;
        }
    }

    
    public function hashPassword($password) {
        $psw = $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        return $psw;
    }
    public function createUser() {
        $db = Db::getInstance();
        $num_rows = User::checkUserExists();
        echo $num_rows;
        if ($num_rows == 0) {
            $req = $db->prepare("INSERT INTO users (Email, Username, Password, UserType) VALUES (:email, :username, :password, 'blogger')");
            $req->bindParam(':username', $username);
            $req->bindParam(':password', $pswHash);
            $req->bindParam(':email', $email);
            try {
                if (isset($_POST['username']) && $_POST['username'] != "") {
                    $username = $filteredUser = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
                }
                if (isset($_POST['password']) && $_POST['password'] != "") {
                    $password = $filteredContent = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
                    $pswHash = User::hashPassword($password);
                }
                if (isset($_POST['email']) && $_POST['email'] != "") {
                    $email = $filteredEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
                }
                $req->execute();
                $_SESSION["username"] = $_POST['username'];
                header("Location:../../index.php");
//        return userAdded($username);
            } catch (PDOException $e) {
                $error = $e->errorInfo();
                die("Eek, sorry, we couldn't sign you up. Try again?" . $error . $e->getMessage());
            }
            unset($req);
        }   else {
            return userExists($username);
        }
       
        }
        
        //allows admin log in using recently added admin account
                public function loginAdmin() {
        $db = Db::getInstance();  
        $row = null; 
        $sql = "SELECT Username, Password, UserType FROM users WHERE Username= :username AND Password= :psw AND UserType= :usertype";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['username'=> $this->username, 'psw'=> $this->password, 'usertype'=>$this->usertype]);
            if($row["usertype"] =='admin'){
                    echo $row["usertype"];
                    header("Location:?controller=pages&action=addadmin");
                }
        } catch (PDOException $e) {
            $error = $e->errorInfo();
            die("Uh oh, something's not right. Try again?" . $error . $e->getMessage());
        }
        unset($stmt);
    }
        //allows admin to add other admins
     public function addAdmin() {
        $db = Db::getInstance();
        $num_rows = User::getAdmin();
        echo $num_rows;
        if ($num_rows == 0) {         
        $req = $db->prepare( "INSERT INTO users (Email, Username, Password, UserType) VALUES (:email, :username, :password, 'admin')");
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
        $req->execute(); 
//        return getAdmin($usertype);
    }
        catch (PDOException $e) {
            $error = $e->errorInfo();
            die("Eek, sorry, we couldn't sign you up. Try again?" . $error . $e->getMessage()); }
        unset($req);
    }     else {
            return userExists($username);
        }
       
        }
}