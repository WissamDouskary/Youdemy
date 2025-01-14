<?php 
require_once '../classes/conn.php';

abstract class User {
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $role;
    protected $hashedPassword;


    abstract public function getId();
    abstract public function getNom();
    abstract public function getPrenom();
    abstract public function getEmail();

        // $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    abstract public function insertUser();

    abstract static function signup($nom, $prenom, $email, $role, $password);
}


?>