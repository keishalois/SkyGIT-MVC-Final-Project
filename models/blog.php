<?php
  class BlogPost {

    // we define 5 attributes
    public $blogid;
    public $title;
    public $content;
    public $username;
    public $date;

    public function __construct($blogid, $title, $content, $username, $date) {
      $this->blogid    = $blogid;
      $this->title  = $title;
      $this->content = $content;
      $this->username = $username;
      $this->date = $date;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM blogposts');
      // we create a list of Product objects from the database results
      foreach($req->fetchAll() as $blogpost) {
        $list[] = new BlogPost($blogpost['BlogID'], $blogpost['BlogTitle'], $blogpost['BlogContent'], $blogpost['UserID'], $blogpost['DateAdded']);
      }
      return $list;
    }

    public static function find($blogid) {
      $db = Db::getInstance();
      //use intval to make sure $id is an integer
      $blogid = intval($blogid);
      $req = $db->prepare('SELECT blogposts.BlogID, blogposts.BlogTitle, blogposts.BlogContent, users.Username, blogposts.DateAdded 
                        FROM blogposts
                        INNER JOIN users ON blogposts.UserID=users.UserID;');
      //the query was prepared, now replace :id with the actual $id value
      $req->execute(array('blogid' => $blogid));
      $blogpost = $req->fetch();
if($blogpost){
      return new BlogPost($blogpost['BlogID'], $blogpost['BlogTitle'], $blogpost['BlogContent'], $blogpost['Username'], $blogpost['DateAdded']);
    }
    else
    {
        //replace with a more meaningful exception
        throw new Exception('A real exception should go here');
    }
    }
    

public static function update($blogid, $title, $content, $username, $date) {
    $db = Db::getInstance();
    $req = $db->prepare("Update blogposts set BlogTitle=:title, BlogContent=:content WHERE (SELECT UserID from users WHERE Username = :username) AND BlogID = :blogid");
    $req->bindParam(':blogid', $blogid);
    $req->bindParam(':title', $title);
    $req->bindParam(':content', $content);
    $req->bindParam(':username', $username);
    $req->bindParam(':date', $date);


// set name and price parameters and execute
    if(isset($_POST['title'])&& $_POST['title']!=""){
        $filteredTitle = filter_input(INPUT_POST,'title', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if(isset($_POST['content'])&& $_POST['content']!=""){
        $filteredContent = filter_input(INPUT_POST,'content', FILTER_SANITIZE_SPECIAL_CHARS);
    }
$title = $filteredTitle;
$content = $filteredContent;
$req->execute();

//upload product image if it exists
        if (!empty($_FILES[self::InputKey]['title'])) {
            BlogPost::uploadFile($title);
	}

    }
    
    public static function add() {
    $db = Db::getInstance();
    $req = $db->prepare("Insert into blogposts(UserID, BlogTitle, BlogContent, DateAdded) values ((SELECT UserID from users WHERE Username = :username), :title, :content, CURRENT_DATE)");
    $req->bindParam(':username', $username);
    $req->bindParam(':title', $title);
    $req->bindParam(':content', $content);

// set parameters and execute
        if(!empty($_SESSION)){
            $username = $_SESSION["username"];
    }
    else {header("Location:landingpage.php");}
    
    if(isset($_POST['title'])&& $_POST['title']!=""){
        $filteredTitle = filter_input(INPUT_POST,'title', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if(isset($_POST['content'])&& $_POST['content']!=""){
        $filteredContent = filter_input(INPUT_POST,'content', FILTER_SANITIZE_SPECIAL_CHARS);
    }
$title = $filteredTitle;
$content = $filteredContent;
$req->execute();

//upload product image
BlogPost::uploadFile($title);
    }

const AllowedTypes = ['image/jpeg', 'image/jpg'];
const InputKey = 'myUploader';

//die() function calls replaced with trigger_error() calls
//replace with structured exception handling
public static function uploadFile(string $title) {

	if (empty($_FILES[self::InputKey])) {
		//die("File Missing!");
                trigger_error("File Missing!");
	}

	if ($_FILES[self::InputKey]['error'] > 0) {
		trigger_error("Handle the error! " . $_FILES[InputKey]['error']);
	}


	if (!in_array($_FILES[self::InputKey]['type'], self::AllowedTypes)) {
		trigger_error("Handle File Type Not Allowed: " . $_FILES[self::InputKey]['type']);
	}

	$tempFile = $_FILES[self::InputKey]['tmp_name'];
        $path = "C:/xampp/htdocs/FinalProject/views/images/";
	$destinationFile = $path . $title . '.jpeg';

	if (!move_uploaded_file($tempFile, $destinationFile)) {
		trigger_error("Handle Error");
	}
		
	//Clean up the temp file
	if (file_exists($tempFile)) {
		unlink($tempFile); 
	}
}
public static function remove($blogid) {
      $db = Db::getInstance();
      //make sure $id is an integer
      $blog = intval($blogid);
      $req = $db->prepare('delete FROM blogposts WHERE BlogID = :blogid');
      // the query was prepared, now replace :id with the actual $id value
      $req->execute(array('blogid' => $blog));
  }
  
}
