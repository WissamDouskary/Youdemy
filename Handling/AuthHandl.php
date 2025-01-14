<?php 
require_once '../classes/Etudiant.php';

if(isset($_POST['Createacc'])){
    if($_POST['Roleselect'] == 3){
        Etudiant::signup($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['Roleselect'], $_POST['password']);
        header('Location: ..');
    }
}

if(isset($_POST['signinsubmit'])){
    try {
        Etudiant::signin($_POST['email'], $_POST['password']);
        header('Location: ../index.php');
        exit;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
    }
}

?>