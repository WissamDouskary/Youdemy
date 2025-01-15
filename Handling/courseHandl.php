<?php
session_start();

require_once '../classes/cours.php';

if(isset($_POST['CreateCourseSub'])){
    $course_title = $_POST['course_title'];
    $course_description = $_POST['course_description'];
    $tags = explode(',', $_POST['tags']);
    $categories_select = $_POST['categories_select'];
    $course_price = $_POST['course_price'];
    $course_type = $_POST['course_type'];



    if ($course_type === 'video') {
    if (isset($_FILES['video_file'])) {
        
        $uploadDir = __DIR__ . '/../uploads/videos/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $videoFile = $_FILES['video_file'];
        $videoPath = $uploadDir . basename($videoFile['name']);
        
        if (move_uploaded_file($videoFile['tmp_name'], $videoPath)) {
            $course = new VideoCours($course_title, $course_description, $videoPath, $course_price, $categories_select, $_SESSION['user_id']);
            try {
                $course->ajouterCours();
                
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Course created successfully!'
                ];
                header('Location: ../profdashboard/createCours.php');
                exit();
            } catch (Exception $e) {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => $e->getMessage()
                ];
                header('Location: ../profdashboard/createCours.php');
                exit();
            }
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Failed to upload the video. Please check the directory permissions.'
            ];
            header('Location: ../profdashboard/createCours.php');
            exit();
        }
    }

    } else if ($course_type === 'document') {
        $content = $_POST['document_content'];
        try{
        $course = new DocumentCours($course_title, $course_description, $content, $course_price, $categories_select, $_SESSION['user_id']);
        $course->ajouterCours();

        $_SESSION['message'] = [
            'type' => 'success',
            'text' => "Course created successfully!"
        ];
        header('Location: ../profdashboard/createCours.php');
        exit();
        }
        catch(Exception $e){
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => $e->getMessage()
            ];
            header('Location: ../profdashboard/createCours.php');
            exit();
        }
    } else {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'Invalid course type. Video upload is required.'
        ];
        header('Location: ../profdashboard/createCours.php');
        exit();
    }
}


?>