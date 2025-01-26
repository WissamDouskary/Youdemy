<?php
require_once '../classes/comments.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course_id = $_POST['course_id'];
    $user_id = $_SESSION['user_id'];
    $content = $_POST['typedcomment'];

    try {
        $comment = new comments(null, $content, $user_id, $course_id);
        $comment->save();

        $_SESSION['message'] = [
            'type' => 'success',
            'text' => "Comment created successfully!"
        ];
        header('Location: ../pages/CoursePreview.php?course_id='.$course_id);
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => $e->getMessage()
        ];
        header('Location: ../pages/CoursePreview.php?course_id='.$course_id);
        exit();
    }
}else{
    header('Location: ../index.php');
    exit();
}
