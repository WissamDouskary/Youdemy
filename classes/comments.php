<?php
require_once '../classes/conn.php';

class comments {
    private $comment_id;
    private $content;
    private $user_id;
    private $course_id;

    // getters
    public function getCommentId(){return $this->comment_id;}
    public function getContent(){return $this->content;}
    public function getUserId(){return $this->user_id;}
    public function getCourseId(){return $this->course_id;}

    //setters
    public function setUserId($user_id) : void {$this->user_id = $user_id;}
    public function setCommentId($comment_id) : void {$this->comment_id = $comment_id;}
    public function setCourseId($course_id) : void  {$this->course_id = $course_id;}
    public function setContent($content) : void {$this->content = $content;}


    function __construct($comment_id, $content, $user_id, $course_id){
        $this->setCommentId($comment_id);
        $this->setContent($content);
        $this->setCourseId($course_id);
        $this->setUserId($user_id);
    }

    function save(){
        $db = Dbconnection::getInstance()->getConnection();
        try {
            if ($this->getCommentId() == null) {
                $sql = "INSERT INTO comments (content, user_id, course_id)
                        VALUES (:content, :user_id, :course_id)";
                $stmt = $db->prepare($sql);
                $content = $this->getContent();
                $user_id = $this->getUserId();
                $course_id = $this->getCourseId();

                $stmt->bindParam(":content", $content);
                $stmt->bindParam(":user_id", $user_id);
                $stmt->bindParam(":course_id", $course_id);
                $stmt->execute();
                $this->setCommentId($db->lastInsertId());
            }
        } catch (PDOException $e) {
            throw new Exception('there is an error while adding comment to db' . $e->getMessage());
        }
    }

}
