<?php
  class BlogPost {

    // we define 5 attributes - we could make these protected like comments class?
    public $blogid;
    public $title;
    public $content;
    public $username;
    public $date;
    
    //the functions below only need to be used if we make the attributes protected/private
    //otherwise just ignore them
    public function getBlogId() {
        return $this->blogid;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function getDate() {
        return $this->date;
    }

    public function __construct($blogid, $title, $content, $username, $date) {
      $this->blogid    = $blogid;
      $this->title  = $title;
      $this->content = $content;
      $this->username = $username;
      $this->date = $date;
    }
    
    //function to add a new blog post
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
        if(isset($_POST['title'])&& $_POST['title']!=""){
            $filteredTitle = filter_input(INPUT_POST,'title', FILTER_SANITIZE_SPECIAL_CHARS);
            }
        if(isset($_POST['content'])&& $_POST['content']!=""){
            $filteredContent = filter_input(INPUT_POST,'content', FILTER_SANITIZE_SPECIAL_CHARS);
        }
            $title = $filteredTitle;
            $content = $filteredContent;
            $req->execute();
            $blogid = $db->lastInsertId();
        //upload blog image
        BlogPost::uploadFile($blogid);
    }
    
    //function to bring up all blogposts with newest first
    public static function all() {
        //first make an empty list array to hold blogs returned from sql query
      $list = [];
        //connect to database
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM blogposts ORDER BY blogid desc;');
      //get a list of BlogPost objects from the database results
      foreach($req->fetchAll() as $blogpost) {
        $list[] = new BlogPost($blogpost['BlogID'], $blogpost['BlogTitle'], $blogpost['BlogContent'], $blogpost['UserID'], $blogpost['DateAdded']);
      }
      //return this list variable so it can be seen outside of the function
      return $list;
    }
    
    //function to show all blog post by user
    public static function allUserBlogs($username) {
        //first make an empty list array to hold blogs returned from sql query
      $list = [];
        //connect to database
      $db = Db::getInstance();
        //since this is taking a username parameter, we need to prepare the sql rather than query
      $req = $db->prepare('SELECT blogposts.BlogID, blogposts.BlogTitle, blogposts.BlogContent, blogposts.DateAdded, users.Username
                        FROM blogposts
                        INNER JOIN users ON blogposts.UserID = users.UserID WHERE users.Username = :username ORDER BY blogid asc;');
        //execute sql statement specifying what the username parameter value is
    $req->execute(array('username' =>  $_SESSION["username"]));
    $blogposts = $req->fetchAll();
      // we create a list of blogpost objects from the database results
      foreach($blogposts as $blogpost) {
        $list[] = new BlogPost($blogpost['BlogID'], $blogpost['BlogTitle'], $blogpost['BlogContent'], $blogpost['Username'], $blogpost['DateAdded']);
      }
      return $list;
    }
    
    // function to bring up a specific blog page
    public static function find($blogid) {
      $db = Db::getInstance();
      //use intval to make sure $id is an integer
      $blogid = intval($blogid);
      //since this is taking a blogid parameter, we need to prepare the sql rather than query
      $req = $db->prepare('SELECT blogposts.BlogID, blogposts.BlogTitle, blogposts.BlogContent, users.Username, blogposts.DateAdded 
                        FROM blogposts
                        INNER JOIN users ON blogposts.UserID=users.UserID WHERE blogid = :blogid;');
      //on executing, replace :blogid with $blogid value
      $req->execute(array('blogid' => $blogid));
      $blogpost = $req->fetch();
      // if we do get a match to blogid, return values otherwise throw an error
      if($blogpost){
      return new BlogPost($blogpost['BlogID'], $blogpost['BlogTitle'], $blogpost['BlogContent'], $blogpost['Username'], $blogpost['DateAdded']);
    } else {
        //replace with a more meaningful exception
        throw new Exception('finding blog failed...');
    }
    }
    
    //function to update blog post
    public static function update($blogid) {
        $db = Db::getInstance();
          //since this is taking a couple of parameters, we need to prepare the sql rather than query
        $req = $db->prepare("Update blogposts set BlogTitle=:title, BlogContent=:content, DateAdded = CURRENT_DATE  WHERE (SELECT UserID from users WHERE Username = :username) AND BlogID = :blogid");
                $req->bindParam(':username', $username);
                $req->bindParam(':title', $title);
                $req->bindParam(':content', $content);
                $req->bindParam(':blogid', $blogid);
        // set parameters and execute
        //check user is logged in and use that username
        if(!empty($_SESSION)){
            $username = $_SESSION["username"];
        }
        //checks blog title is not empty and filters 
        if(isset($_POST['title'])&& $_POST['title']!=""){
            $filteredTitle = filter_input(INPUT_POST,'title', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        //checks blog content is not empty and filters 
        if(isset($_POST['content'])&& $_POST['content']!=""){
            $filteredContent = filter_input(INPUT_POST,'content', FILTER_SANITIZE_SPECIAL_CHARS);
        }
            $title = $filteredTitle;
            $content = $filteredContent;
            $req->execute();
        //upload blog image if it exists
        if (!empty($_FILES[self::InputKey]['blogid'])) {
            BlogPost::uploadFile($blogid);
	}
    }

    //these belong to the upload file function to specify what we are allowed to upload
const AllowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
const InputKey = 'myUploader';
        //die() function calls replaced with trigger_error() calls
        //replace with structured exception handling
public static function uploadFile($blogid) {
    //trigger errors
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
        $path =   join(DIRECTORY_SEPARATOR, array(__DIR__,'..','views','images'));
	$destinationFile = $path . $blogid . '.jpeg';
        echo DIRECTORY_SEPARATOR;
        echo "destination file " . $destinationFile;
        echo "file path " . $path;
        echo "temp file " . $tempFile;
        try { 
	if (!move_uploaded_file($tempFile, $destinationFile)) {
		trigger_error("cannot upload");
                
        } if (file_exists($tempFile)) {
		unlink($tempFile); 
	}
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            echo $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];}
	//Clean up the temp file
	
}
    
    //function to remove a blogpost
    public static function remove($blogid) {
        $db = Db::getInstance();
            //make sure $blogid is an integer
                $blog = intval($blogid);
            //call remove blog comments function first to delete comments associated with the blog post
                BlogPost::removeAllBlogComments($blog);
        $req = $db->prepare('delete FROM blogposts WHERE BlogID = :blogid');
      // execute query, replacing :blogid with the actual $blogid value
      $req->execute(array('blogid' => $blog));
//                $title = $this->title;
                BlogPost::deleteBlogImage($blog);
    }
    
    //attempt to write method to delete blog image so image folder doesn't get clogged up
    public static function deleteBlogImage($blogid) {
        if($blogid == ($_GET['blogid'])) {
    $path =   join(DIRECTORY_SEPARATOR, array(__DIR__,'..','views','images', $blogid));
    $blogfile = $path . '.jpeg';
    	if (file_exists($blogfile)) {
		unlink($blogfile); 
	}  
    } 
    }
    
    //function to remove all comments associated with a particular blogpost - to be used in remove method
    public static function removeAllBlogComments($blogid) {
        $db = Db::getInstance();
        //make sure $blogid is an integer
        $blogid = intval($blogid);
        $req = $db->prepare('delete FROM comments WHERE comments.BlogID = :blogid');
        // execute query, replacing :blogid with the actual $blogid value
        $req->execute(array('blogid' => $blogid));
    }
    
    
    //this is a function to count the number of comments on a blogpost
    public static function blogComments($blogid) {
        $db = Db::getInstance();
        $blogid = intval($blogid);
   //since this is taking a blogid parameter, we need to prepare the sql rather than query
        $req = $db->prepare('SELECT count(BlogID) as countcomments FROM comments WHERE BlogID = :blogid');
        $req->execute(array('blogid' => $blogid));
        $num = $req->fetch();
        echo $num['countcomments'];
    }
    
    //function to say whether the logged in user owns a particular blogpost and so is 
    //allowed to edit or delete their own post
    public static function userCanChange($username, $blogid) {
        $db = Db::getInstance();
    //since this is taking a couple of parameters, we need to prepare the sql rather than query
        $req = $db->prepare('SELECT blogposts.BlogID, users.Username
                        FROM blogposts
                        INNER JOIN users ON blogposts.UserID = users.UserID WHERE BlogID = :blogid AND users.Username = :username;');
      //execute query, specifying the parameters 
      $req->execute(array('username' => $_SESSION["username"], 'blogid' => $blogid));
      $returnuser = $req->fetch();
      return $returnuser;
  }
  }
