<?php 
session_start();
require_once '../classes/admin.php';

if(isset($_POST['user_id']) && isset($_POST['action'])){
    Admin::changeEnseignant($_POST['user_id'], $_POST['action']);
    if($_POST['action'] == 'active'){
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'you have approve user where user id = ' . $_POST['user_id']
        ];
        header('Location: ../pages/adminDashboard.php');
        exit();
    }else if ($_POST['action'] == 'suspended'){
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'you have banned user where user id = ' . $_POST['user_id']
        ];
        header('Location: ../pages/adminDashboard.php');
        exit();
    }
}
