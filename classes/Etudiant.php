<?php 
require_once '../classes/user.php';
require_once '../classes/cours.php';

class Etudiant extends User{

    static function getEnrolledCourses($student_id){
        $db = Dbconnection::getInstance()->getConnection();
        try{
            $sql = "SELECT e.*, c.*, CONCAT(n.prenom , ' ' , n.nom) AS teacher_name, u.prenom, u.nom, u.user_id
                    FROM enrollments e
                    LEFT JOIN courses c ON c.course_id = e.course_id
                    LEFT JOIN users u ON e.student_id = u.user_id
                    LEFT JOIN users n ON c.teacher_id = n.user_id
                    WHERE e.student_id = :student_id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':student_id', $student_id);

            $stmt->execute();

            $eCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $courses = [];

            foreach($eCourses as $cour){
                if($cour['course_type'] === 'video'){
                    $course = new VideoCours(
                        $cour['title'],
                        $cour['description'],
                        $cour['course_image'],
                        $cour['video_url'],
                        $cour['price'],
                        $cour['category_id'],
                        $cour['teacher_id']
                    );
                } else if ($cour['course_type'] === 'document'){
                    $course = new DocumentCours(
                        $cour['title'],
                        $cour['description'],
                        $cour['course_image'],
                        $cour['document_content'],
                        $cour['price'],
                        $cour['category_id'],
                        $cour['teacher_id']
                    );
                }else{
                    continue;
                }
                
                $course->setId($cour['course_id']);
                $course->personName = $cour['teacher_name'];
                $course->creationdate = $cour['inscription_date'];
                $course->cours_type = $cour['course_type'];
                $courses[] = $course;
            }
            return $courses;
        }
        catch(PDOException $e){
            throw new Exception ('there is an error while get enrolled courses for student '. $e->getMessage());
            return [];
        }
    }
}

?>