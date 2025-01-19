<?php
require_once '../classes/category.php'; 
session_start();

if(isset($_GET['id'])){
    try{
        Category::deleteCategory($_GET['id']);

        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'you have delete categorie success!'
        ];
        header('Location: ../pages/adminDashboard.php');
        exit();
    }
    catch(Exception $e){
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => "this categorie have courses, try again later!"
        ];
        header('Location: ../pages/adminDashboard.php');
        exit();
    }
}
