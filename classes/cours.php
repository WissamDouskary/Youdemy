<?php 
require_once '../classes/conn.php';

abstract class Cours {
    protected $title;
    protected $description;
    protected $price;
    protected $category_id;
    protected $teacher_id;

    public function __construct($title, $description, $price, $category_id, $teacher_id) {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->teacher_id = $teacher_id;
    }

    abstract public function ajouterCours();

    static abstract public function afficherCours();
}

class VideoCours extends Cours {
    private $videoUrl;

    public function __construct($title, $description, $videoUrl, $price, $category_id, $teacher_id) {
        parent::__construct($title, $description, $price, $category_id, $teacher_id);
        $this->videoUrl = $videoUrl;
    }

    public function ajouterCours() {
        $db = Dbconnection::getInstance()->getConnection();

        try{
            $sql = "INSERT INTO courses (title, description, course_type, video_url, price, category_id, teacher_id)
                    VALUES (:title, :description, 'video', :video_url, :price, :category_id, :teacher_id)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':video_url', $this->videoUrl);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':teacher_id', $this->teacher_id);

            $stmt->execute();
        }
        catch(PDOException $e){
            throw new Exception("There is an error while create Course with video!");
        }
    }

    static public function afficherCours() {
        $db = Dbconnection::getInstance()->getConnection();

        
    }
}

class DocumentCours extends Cours {
    private $documentText;

    public function __construct($title, $description, $documentText, $price, $category_id, $teacher_id) {
        parent::__construct($title, $description, $price, $category_id, $teacher_id);
        $this->documentText = $documentText;
    }

    public function ajouterCours() {
        $db = Dbconnection::getInstance()->getConnection();

        try{
            $sql = "INSERT INTO courses (title, description, course_type, document_content, price, category_id, teacher_id)
                    VALUES (:title, :description, 'document', :document_content, :price, :category_id, :teacher_id)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':document_content', $this->documentText);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':teacher_id', $this->teacher_id);

            $stmt->execute();
        }
        catch(PDOException $e){
            throw new Exception("There is an error while create Course with doc text!");
        }
    }

    static public function afficherCours() {
        
    }
}
?>