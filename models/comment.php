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
    public function getCommentID(){
        return $this->commentid;
    }    
    public function getUsername(){
        return $this->username;
    }
    public function getDate(){
        return $this->date;
    }
    
    public function getContent() {
        return $this->content;
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
      $req = $db->prepare('SELECT comments.CommentID, comments.BlogID, comments.Comment, comments.DateAdded, users.Username FROM comments '
               . 'INNER JOIN users ON comments.UserID = users.UserID '
            . 'INNER JOIN blogposts ON comments.BlogID = blogposts.BlogID' 
              . '  WHERE comments.BlogID = :blogid ORDER BY CommentID desc;');      
      $req->execute(['blogid'=> ($_GET['blogid'])]);
      $viewblogcomments = $req->fetchAll();
      // we create a list of Product objects from the database results
      foreach($viewblogcomments as $comment) {
        $list[] = new Comment($comment['CommentID'], $comment['BlogID'],$comment['Comment'],
                $comment['Username'], $comment['DateAdded']);
      }
      return $list;    
        }
public static function deleteComment($commentid) {
      $db = Db::getInstance();
      //make sure $id is an integer
      $comment = intval($commentid);
      $req = $db->prepare('delete FROM comments WHERE CommentID = :commentid');
      // the query was prepared, now replace :id with the actual $id value
      $req->execute(array('commentid' => $comment));
}
        
public static function userCanChange($username, $commentid) {
      $db = Db::getInstance();
      $req = $db->prepare('SELECT comments.CommentID, users.Username
                        FROM comments
                        INNER JOIN users ON comments.UserID = users.UserID WHERE CommentID = :commentid AND users.Username = :username;');
      //the query was prepared, now replace :id with the actual $id value
      $req->execute(array('username' => $_SESSION["username"], 'commentid' => $commentid));
      $returnuser = $req->fetch();
      return $returnuser;
  }
  
  
}