<?php

require_once '../classes/Etudiant.php';

if(isset($_POST['Createacc'])){
    if($_POST['Roleselect'] == 3){
        User::signup($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['Roleselect'], $_POST['password'], 'Active');
        header('Location: ../pages/login.php');
        exit();
    } else {
        User::signup($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['Roleselect'], $_POST['password'], 'waiting');
        header('Location: ../index.php');
        exit();
    }
}

if (isset($_POST['signinsubmit'])) {
    try {
        $user = User::signin($_POST['email'], $_POST['password']);
        
        if ($user->getStatus() === 'waiting') {
            header('Location: ../pages/status_pending.php');
            exit;
        } elseif ($user->getStatus() === 'active') {
            header('Location: ../index.php');
            exit;
        } else {
            $error_message = 'Your account is not active. Please contact support.';
        }
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}

user::logOut();
header('Location: ../index.php');
exit();


?>