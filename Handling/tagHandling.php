<?php 
require_once '../classes/Tag.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $tags = explode(',', $_POST['tag_name']);

    try{
        Tag::addMultipleTags($tags);
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'tags created success!'
        ];
        header('Location: ../pages/adminDashboard.php');
        exit();
    }
    catch(Exception $e){
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => $e->getMessage()
        ];
        header('Location: ../pages/adminDashboard.php');
        exit();
    }
    
}

?>