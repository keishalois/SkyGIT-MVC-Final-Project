<?php
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

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
    
    require_once 'vendor/autoload.php';
    $AccountKey = getenv('storageaccountkey');
    $connectionString = "DefaultEndpointsProtocol=https;AccountName=fmlblogimages;AccountKey=$AccountKey";
    $fileToUpload = $_FILES['myUploader']["tmp_name"];
     // Create blob client.
    $blobClient = BlobRestProxy::createBlobService($connectionString);
    
    try {
        // Create container options object.
//        $blob = New Blob($_SESSION['username']);
//        $blobClient->createContainerIfNotExists();
//        $blobClient->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

        $createContainerOptions = new CreateContainerOptions();
        $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
                # Create the BlobService that represents the Blob service for the storage account
        $containerName = "fmlimages" . $blogid;
        $blobClient->createContainer($containerName, $createContainerOptions);

                # Upload file as a block blob
            if (strcmp($fileToUpload, "")==0){
                 echo "Enter valid image path <br />";
            }
            else{
        // Getting local file so that we can upload it to Azure
        $myfile = fopen($_FILES["myUploader"]["tmp_name"] . '', "w") or die("Unable to open file!");
        fclose($myfile);

        # Upload file as a block blob
        echo "Uploading BlockBlob: ".PHP_EOL;
        echo $fileToUpload;
        echo "<br />";
//        $content = fopen($fileToUpload, "r");
        $blobName = "images/" . $blogid . ".jpeg";
        // $blob = new BlobStorage;
        $blob->AddBlob('fmlimages', $blobName, $myfile);
         //Upload blob
//        $blobClient->createBlockBlob($containerName, $fileToUpload, $content);
//                echo "Image uploaded successfully! <br />";
    } }
catch (ServiceException $e) {
                $error = $e->errorInfo();
                die("adding file failed sorry " . $error . $e->getMessage());
            }
    }
    
public function AddBlob($containerName, $fileName, $fileToUpload)
{
//Upload blob
$this->blobClient->createBlockBlob($containerName, $fileName, $fileToUpload);
}
//public static function uploadFile($blogid) {
//    //trigger errors
//	if (empty($_FILES[self::InputKey])) {
//		//die("File Missing!");
//                trigger_error("File Missing!");
//	}
//	if ($_FILES[self::InputKey]['error'] > 0) {
//		trigger_error("Handle the error! " . $_FILES[InputKey]['error']);
//	}
//	if (!in_array($_FILES[self::InputKey]['type'], self::AllowedTypes)) {
//		trigger_error("Handle File Type Not Allowed: " . $_FILES[self::InputKey]['type']);
//	}
//        ini_set("upload_tmp_dir", "D:\home\site\wwwroot\models\views\images");        
//	$tempFile = $_FILES[self::InputKey]['tmp_name'];
//        $path = join(DIRECTORY_SEPARATOR, array(__DIR__,'..','views','images', $blogid));
//	$destinationFile = $path . '.jpeg';
//            $error = $_FILES[self::InputKey]['error'];
//
//        if($error === 0) {
//            
//	if (!move_uploaded_file($tempFile, $destinationFile)) {
//            $trace = $e->getTrace();
//            echo $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
//		trigger_error("cannot upload");
//                
//        } 
//        if (file_exists($tempFile)) {
//		unlink($tempFile); 
//	}
//}     else {
//        $error = $_FILES['myfile']['error'];
//        checkError($error);   
//            }
//}

        function checkError($error) {
            switch ($error) {
        //error throws 1 means uploaded file exceeds the upload_max_filesize directive in php.ini   
            //UPLOAD_ERR_INI_SIZE
        //error throws 2 means uploaded file exceeds the MAX_FILE_SIZE directive in HTML form
            //UPLOAD_ERR_FORM_SIZE
                case 1: case 2: $fileError = "Your file is too big."; break;
        //error 3 means uploaded file was only partially uploaded
            //UPLOAD_ERR_PARTIAL
                case 3: $fileError = "File was only partially uploaded"; break;
        //error 4 means no file uploaded
            //UPLOAD_ERR_NO_FILE
                case 4: $fileError = 'No file uploaded.'; break;
        //error 6 means no temp directory specified
            //UPLOAD_ERR_NO_TMP_DIR
                case 6: $fileError = 'No temp directory specified.'; break;
    // error 7 means failed to write file to disk
            //UPLOAD_ERR_CANT_WRITE
                case 7: $fileError = 'Cannot write to disk.'; break;
        //error 8 means PHP extension stopped the file upload
                case 8: $fileError = 'A PHP extension stopped the file upload'; break;
                default : $fileError = 'Unknown error - try again';
            }
            return $fileError;
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
