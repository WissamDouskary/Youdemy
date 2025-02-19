<?php
require_once '../classes/enrollement.php';
session_start();

if(isset($_GET['course_id']) && $_SESSION['user_id']){
    $course_id = $_GET['course_id'];
    $user_id = $_SESSION['user_id'];

    try{
    $enroll = new Enrollments($course_id, $user_id);
    $enroll->save();

    $_SESSION['message'] = [
        'type' => 'success',
        'text' => 'enrolled success'
    ];
    header('Location: ../pages/cours.php');
    exit();
    }
    catch(Exception $e){
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => $e->getMessage()
        ];
        header('Location: ../pages/cours.php');
        exit();
    }
}else{
    $_SESSION['Log'] = [
        'type' => 'You need an account!',
        'text' => "Please register or log in to enroll in this course."
    ];
    header('Location: ../pages/cours.php');
    exit();
}

?>