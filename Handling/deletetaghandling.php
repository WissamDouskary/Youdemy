<?php
session_start();
require_once '../classes/Tag.php';

if(isset($_GET['id'])){
    try{
        Tag::deleteTag($_GET['id']);

        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'Tag deleted success!'
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
}else{
    $_SESSION['message'] = [
        'type' => 'error',
        'text' => 'please make sure you have tag id'
    ];
    header('Location: ../pages/adminDashboard.php');
    exit();
}

?>