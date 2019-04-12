<?php

class Comment {
		protected $commentid;
		protected $blogid;
		protected $content;
		protected $username;
		protected $date;

    public function __construct($commentid, $blogid, $content, $username, $date) {
      $this->commentid    = $commentid;
      $this->blogid    = $blogid;
      $this->content = $content;
      $this->username = $username;
      $this->date = $date;
    }

public static function addComment($blogid) {
    $db = Db::getInstance();
    $blogid = intval($blogid);
    $req = $db->prepare("Insert into comments(BlogID, UserID, Comment, DateAdded) values ((SELECT BlogID from blogposts WHERE BlogID = :blogid), (SELECT UserID from users WHERE Username = :username), :comment, CURRENT_DATE)");
    $req->bindParam(':blogid', $blogid);
    $req->bindParam(':username', $username);
    $req->bindParam(':comment', $comment);
// set parameters and execute                
       if(!empty($_SESSION)){
            $username = $_SESSION["username"];
    		}
    	if(isset($_POST['comment'])&& $_POST['comment']!=""){
        	$comment = $filteredComment = filter_input(INPUT_POST,'comment', FILTER_SANITIZE_SPECIAL_CHARS);
    	}
	$req->execute();
    }

    
 public static function allComments($blogid) {
      $list = [];
      $db = Db::getInstance();
      $blogid = intval($blogid);
      $req = $db->prepare('SELECT * FROM comments WHERE (SELECT BlogID from blogposts WHERE BlogID = :blogid)');
      $req->execute(['blogid'=> $blogid]);
      $blogcomments = $req->fetchAll();
      // we create a list of Product objects from the database results
      foreach($blogcomments as $comment) {
        $list[] = new Comment($comment['CommentID'], $comment['BlogID'], $comment['UserID'], $comment['Comment'], $comment['DateAdded']);
      }
      return $list;    
        }


//    public static function add($blogid) {
//    $db = Db::getInstance();
//    $req = $db->prepare("Insert into comments(BlogID, UserID, Comment, DateAdded) values ((SELECT BlogID from blogposts WHERE BlogID = :blogid), (SELECT UserID from users WHERE Username = :username), :comment, CURRENT_DATE)");
//    $req->bindParam(':blogid', $blogid);
//    $req->bindParam(':username', $username);
//    $req->bindParam(':comment', $content);
//// set parameters and execute
//        if(!empty($_GET['blogid'])){
//            $blogid = $_GET['blogid'];
//    		}
//                
//       if(!empty($_SESSION)){
//            $username = $_SESSION["username"];
//    		}
//    	if(isset($_POST['content'])&& $_POST['content']!=""){
//        	$filteredContent = filter_input(INPUT_POST,'content', FILTER_SANITIZE_SPECIAL_CHARS);
//    	}
//		$content = $filteredContent;
//	$req->execute();
//    }

//        public static function all() {
//      $list = [];
//      $db = Db::getInstance();
//      $req = $db->query('SELECT * FROM comments WHERE BlogID = :blogid');
//      $req->bindParam(':blogid', $blogid);
//      // we create a list of Product objects from the database results
//      foreach($req->fetchAll() as $comment) {
//        $list[] = new Comment($comment['CommentID'], $comment['BlogID'], $comment['UserID'], $comment['Comment'], $comment['DateAdded']);
//      }
//        }
}