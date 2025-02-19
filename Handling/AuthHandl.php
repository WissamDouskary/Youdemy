<?php
session_start();

require_once '../classes/user.php';

if(isset($_POST['Createacc'])){
try{
    if($_POST['Roleselect'] == 3){
        User::signup($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['Roleselect'], $_POST['password'], 'Active');
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'Account created successfully! You can now login.'
        ];
        header('Location: ../pages/login.php');
        exit();
    } else {
        User::signup($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['Roleselect'], $_POST['password'], 'waiting');
        $_SESSION['message'] = [
            'type' => 'info',
            'text' => 'Account created successfully, but is awaiting approval.'
        ];
        header('Location: ../index.php');
        exit();
    }
} catch (Exception $e) {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => $e->getMessage()
        ];
        header('Location: ../pages/sign_up.php');
        exit();
    }
}

if (isset($_POST['signinsubmit'])) {
    try {
        $user = User::signin($_POST['email'], $_POST['password']);
        
        if ($user->getStatus() === 'waiting') {
            $_SESSION['message'] = [
                'type' => 'info',
                'text' => 'Your account is pending approval. Please contact support.'
            ];
            header('Location: ../pages/status_pending.php');
            exit;
        } elseif ($user->getStatus() === 'active') {
            if($user->getrole() == 1){
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Welcome back Admin!'
                ];
                header('Location: ../pages/adminDashboard.php');
                exit();
            }
            if($user->getrole() == 2){
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Welcome back Instructor!'
                ];
                header('Location: ../pages/prof_dashboard.php');
                exit();
            }
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Welcome back Student!'
            ];
            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Your account is not active. Please contact support.'
            ];
            header('Location: ../pages/status_banned.php');
            exit();
        }

    } catch (Exception $e) {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => $e->getMessage()
        ];
        header('Location: ../pages/login.php');
        exit();
    }
}

user::logOut();
$_SESSION['message'] = [
    'type' => 'success',
    'text' => 'You have successfully logged out.'
];
header('Location: ../index.php');
exit();


?>