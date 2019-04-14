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
    
//these functions let us access the protected attributes from outside the class
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

    //function to add a comment to a blogpost
    public static function addComment($blogid) {
            $db = Db::getInstance();
        // check blogid is integer
                $blogid = intval($blogid);
        //since this is inserting to the database, we need to prepare the sql rather than query
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

    //function to see all comments associated with a particular blog post
    public static function allComments($blogid) {
        //make an empty array called list to hold all comments
            $list = [];
            $db = Db::getInstance();
        // check blogid is an integer
            $blogid = intval($blogid);
        //since this is taking blogid as a parameter, we need to prepare the statement
            //checks the comments belong to the blog and orders by newest first
            $req = $db->prepare('SELECT comments.CommentID, comments.BlogID, comments.Comment, comments.DateAdded, users.Username FROM comments '
               . 'INNER JOIN users ON comments.UserID = users.UserID '
            . 'INNER JOIN blogposts ON comments.BlogID = blogposts.BlogID' 
              . '  WHERE comments.BlogID = :blogid ORDER BY CommentID desc;'); 
        //uses a get request for blogid - comes from the url
            $req->execute(['blogid'=> ($_GET['blogid'])]);
            $viewblogcomments = $req->fetchAll();
      // we create a list of comment objects from the database results
            foreach($viewblogcomments as $comment) {
                $list[] = new Comment($comment['CommentID'], $comment['BlogID'],$comment['Comment'],
                $comment['Username'], $comment['DateAdded']);
                }
            return $list;    
        }
    //this function lets a user delete a particular comment - used in views/comments/readwithcomments.php
    public static function deleteComment($commentid) {
            $db = Db::getInstance();
            //make sure $commentid is an integer
            $comment = intval($commentid);
            $req = $db->prepare('delete FROM comments WHERE CommentID = :commentid');
            // execute query, replacing :commentid with the actual $commentid value
            $req->execute(array('commentid' => $comment));
        }
    
    //this function determines if the logged in user wrote the comment so can edit/delete
    public static function userCanChange($username, $commentid) {
            $db = Db::getInstance();
            //since we are using a couple of parameters, this needs to be prepared rather than queryed
            $req = $db->prepare('SELECT comments.CommentID, users.Username
                        FROM comments
                        INNER JOIN users ON comments.UserID = users.UserID WHERE CommentID = :commentid AND users.Username = :username;');
      //execute but replace :commentid with the actual $commentid value
            $req->execute(array('username' => $_SESSION["username"], 'commentid' => $commentid));
            $returnuser = $req->fetch();
            return $returnuser;
            }
}