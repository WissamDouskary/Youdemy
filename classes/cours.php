<?php 
require_once '../classes/conn.php';

abstract class Cours {
    protected $id;
    protected $title;
    protected $description;
    protected $course_image;
    protected $price;
    protected $category_id;
    protected $teacher_id;
    public $personName;
    public $creationdate;
    public $cours_type;

    public function __construct($title, $description, $course_image, $price, $category_id, $teacher_id) {
        $this->title = $title;
        $this->description = $description;
        $this->course_image = $course_image;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->teacher_id = $teacher_id;
    }

    function getId(){ return $this->id;}
    function gettitle(){ return $this->title;}
    function getdescription(){ return $this->description;}
    function getcourseImage(){ return $this->course_image;}
    function getprice(){ return $this->price;}
    function getcategory_id(){ return $this->category_id;}
    function getteacher_id(){ return $this->teacher_id;}

    abstract public function ajouterCours();

    static abstract public function afficherCours();
    
    static public function showAllCours() {
        $db = Dbconnection::getInstance()->getConnection();

        try {
            $sql = "SELECT c.*, u.prenom, u.nom, u.user_id 
                    FROM courses c
                    LEFT JOIN users u ON c.teacher_id = u.user_id";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $courseData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $courses = [];

            foreach ($courseData as $cours) {
                if ($cours['course_type'] === 'video') {
                    $course = new VideoCours(
                        $cours['title'], 
                        $cours['description'],
                        $cours['course_image'],
                        $cours['video_url'],
                        $cours['price'],
                        $cours['category_id'], 
                        $cours['teacher_id']
                    );
                } elseif ($cours['course_type'] === 'document') {
                    $course = new DocumentCours(
                        $cours['title'], 
                        $cours['description'],
                        $cours['course_image'],
                        $cours['document_content'],
                        $cours['price'],
                        $cours['category_id'], 
                        $cours['teacher_id']
                    );
                } else {
                    continue;
                }

                $course->id = $cours['course_id'];
                $course->personName = $cours['prenom'] . " " . $cours['nom'];
                $course->creationdate = $cours['date_creation'];
                $course->cours_type = $cours['course_type'];
                $courses[] = $course;
            }

            return $courses;
        } catch (PDOException $e) {
            throw new Exception("Error while fetching all courses: " . $e->getMessage());
        }
    }

    static public function showspecificsCours($teacher_id) {
        $db = Dbconnection::getInstance()->getConnection();

        try {
            $sql = "SELECT c.*, u.prenom, u.nom, u.user_id 
                    FROM courses c
                    LEFT JOIN users u ON c.teacher_id = u.user_id
                    WHERE c.teacher_id = :teacher_id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("teacher_id", $teacher_id);
            $stmt->execute();

            $courseData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $courses = [];

            foreach ($courseData as $cours) {
                if ($cours['course_type'] === 'video') {
                    $course = new VideoCours(
                        $cours['title'], 
                        $cours['description'],
                        $cours['course_image'],
                        $cours['video_url'],
                        $cours['price'],
                        $cours['category_id'], 
                        $cours['teacher_id']
                    );
                } elseif ($cours['course_type'] === 'document') {
                    $course = new DocumentCours(
                        $cours['title'], 
                        $cours['description'],
                        $cours['course_image'],
                        $cours['document_content'],
                        $cours['price'],
                        $cours['category_id'], 
                        $cours['teacher_id']
                    );
                } else {
                    continue;
                }

                $course->id = $cours['course_id'];
                $course->personName = $cours['prenom'] . " " . $cours['nom'];
                $course->creationdate = $cours['date_creation'];
                $courses[] = $course;
            }

            return $courses;
        } catch (PDOException $e) {
            throw new Exception("Error while fetching all courses: " . $e->getMessage());
        }
    }

    static function getCourseById($course_id) {
        $db = Dbconnection::getInstance()->getConnection();
    
        try {
            $sql = "SELECT c.*, u.prenom, u.nom, u.user_id
                    FROM courses c
                    LEFT JOIN users u ON c.teacher_id = u.user_id
                    WHERE c.course_id = :course_id";
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":course_id", $course_id);
            $stmt->execute();
    
            $courseData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$courseData) {
                return null;
            }
    
            if ($courseData['course_type'] === 'video') {
                $course = new VideoCours(
                    $courseData['title'],
                    $courseData['description'],
                    $courseData['course_image'],
                    $courseData['video_url'],
                    $courseData['price'],
                    $courseData['category_id'],
                    $courseData['teacher_id']
                );
            } elseif ($courseData['course_type'] === 'document') {
                $course = new DocumentCours(
                    $courseData['title'],
                    $courseData['description'],
                    $courseData['course_image'],
                    $courseData['document_content'],
                    $courseData['price'],
                    $courseData['category_id'],
                    $courseData['teacher_id']
                );
            } else {
                throw new Exception("Unknown course type: " . $courseData['course_type']);
            }
    
            $course->id = $courseData['course_id'];
            $course->personName = $courseData['prenom'] . " " . $courseData['nom'];
            $course->creationdate = $courseData['date_creation'];
            $course->cours_type = $courseData['course_type'];
    
            return $course;
        } catch (PDOException $e) {
            throw new Exception("Error while fetching the course: " . $e->getMessage());
        }
    }
}

class VideoCours extends Cours {
    private $videoUrl;
    public $course_type;

    public function __construct($title, $description, $course_image, $videoUrl, $price, $category_id, $teacher_id) {
        parent::__construct($title, $description, $course_image, $price, $category_id, $teacher_id);
        $this->videoUrl = $videoUrl;
    }

    function getvedioUrl(){ return $this->videoUrl;}

    public function ajouterCours() {
        $db = Dbconnection::getInstance()->getConnection();

        try{
            $sql = "INSERT INTO courses (title, description, course_image, course_type, video_url, price, category_id, teacher_id)
                    VALUES (:title, :description, :course_image, 'video', :video_url, :price, :category_id, :teacher_id)";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':course_image', $this->course_image);
            $stmt->bindParam(':video_url', $this->videoUrl);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':teacher_id', $this->teacher_id);

            $stmt->execute();

            $this->id = $db->lastInsertId();
            return $this->id;
        }
        catch(PDOException $e){
            throw new Exception("There is an error while create Course with video!" . $e->getMessage());
        }
    }

    static public function afficherCours() {
        $db = Dbconnection::getInstance()->getConnection();
    
        try {
            $sql = "SELECT c.*, u.*
                    FROM courses c
                    LEFT JOIN users u ON c.teacher_id = u.user_id
                    WHERE course_type = 'video'";

            $stmt = $db->prepare($sql);
            $stmt->execute();
    
            $courseData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $courses = [];

            foreach ($courseData as $cours) {
                $videoCourse = new VideoCours(
                    $cours['title'], 
                    $cours['description'],
                    $cours['course_image'],
                    $cours['video_url'],
                    $cours['price'],
                    $cours['category_id'], 
                    $cours['teacher_id']
                );
                $videoCourse->id = $cours['course_id'];
                $videoCourse->personName = $cours['prenom'] . " " . $cours['nom'];
                $videoCourse->creationdate = $cours['date_creation'];
                $videoCourse->course_type = $cours['course_type'];
                $courses[] = $videoCourse;
            }

            return $courses;
            
        } catch (PDOException $e) {
            throw new Exception("Error while fetching video courses: " . $e->getMessage());
            return [];
        }
    }

    static function getCourseById($course_id) {
        $db = Dbconnection::getInstance()->getConnection();
    
        try {
            $sql = "SELECT c.*, u.*
                    FROM courses c
                    LEFT JOIN users u ON c.teacher_id = u.user_id
                    WHERE c.course_id = :course_id AND c.course_type = 'video'";
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':course_id', $course_id);
            $stmt->execute();
    
            $courseData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($courseData) {
                $videoCourse = new VideoCours(
                    $courseData['title'],
                    $courseData['description'],
                    $courseData['course_image'],
                    $courseData['video_url'],
                    $courseData['price'],
                    $courseData['category_id'],
                    $courseData['teacher_id']
                );
    
                $videoCourse->id = $courseData['course_id'];
                $videoCourse->personName = $courseData['prenom'] . " " . $courseData['nom'];
                $videoCourse->creationdate = $courseData['date_creation'];
    
                return $videoCourse;
            } else {
                throw new Exception("No course found with ID: $course_id");
            }
    
        } catch (PDOException $e) {
            throw new Exception("Error while fetching course by ID: " . $e->getMessage());
        }
    }
    
}

class DocumentCours extends Cours {
    private $documentText;

    public function __construct($title, $description, $course_image, $documentText, $price, $category_id, $teacher_id) {
        parent::__construct($title, $description, $course_image, $price, $category_id, $teacher_id);
        $this->documentText = $documentText;
    }

    function getdocumentText(){ return $this->documentText;}

    public function ajouterCours() {
        $db = Dbconnection::getInstance()->getConnection();

        try{
            $sql = "INSERT INTO courses (title, description, course_image, course_type, document_content, price, category_id, teacher_id)
                    VALUES (:title, :description, :course_image, 'document', :document_content, :price, :category_id, :teacher_id)";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':course_image', $this->course_image);
            $stmt->bindParam(':document_content', $this->documentText);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':teacher_id', $this->teacher_id);

            $stmt->execute();

            $this->id = $db->lastInsertId();
            return $this->id;
        }
        catch(PDOException $e){
            throw new Exception("There is an error while create Course with doc text!" . $e->getMessage());
        }
    }

    static public function afficherCours() {
        $db = Dbconnection::getInstance()->getConnection();
    
        try {
            $sql = "SELECT c.*, u.*
                    FROM courses c
                    LEFT JOIN users u ON c.teacher_id = u.user_id
                    WHERE course_type = 'document'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
    
            $courseData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $courses = [];

            foreach ($courseData as $cours) {
                $videoCourse = new DocumentCours(
                    $cours['title'], 
                    $cours['description'],
                    $cours['course_image'],
                    $cours['document_content'],
                    $cours['price'], 
                    $cours['category_id'], 
                    $cours['teacher_id']
                );
                $videoCourse->id = $cours['course_id'];
                $videoCourse->personName = $cours['prenom'] . " " . $cours['nom'];
                $videoCourse->creationdate = $cours['date_creation'];
                $courses[] = $videoCourse;
            }

            return $courses;
            
        } catch (PDOException $e) {
            throw new Exception("Error while fetching video courses: " . $e->getMessage());
            return [];
        }
    }
}
?>