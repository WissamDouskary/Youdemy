<?php 
require_once '../classes/user.php';

class Etudiant extends User{

    function __construct($id, $nom, $prenom, $email, $role, $hashedPassword = null){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
        $this->role = $role;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->email; }


    private function hashPass($password){
        return $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    public function insertUser(){
        $db = Dbconnection::getInstance()->getConnection();

        try{
            if($this->id){
                $sql = "UPDATE users
                        SET nom = :nom, prenom = :prenom, email = :email, password = :password, status = :status
                        WHERE id = :id";

                $stmt = $db->prepare($sql);

                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':nom', $this->nom);
                $stmt->bindParam(':prenom', $this->prenom);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':password', $this->hashedPassword);
                $stmt->bindParam(':status', 'Active');

                $stmt->execute();
            } else {
                $sql = "INSERT INTO users (nom, prenom, email, password, role)
                        VALUES :nom, :prenom, :email, :password, :role";                
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':nom', $this->nom);
                $stmt->bindParam(':prenom', $this->prenom);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':password', $this->hashedPassword);
                $stmt->bindParam(':role', $this->role);

                $stmt->execute();

                $this->id = $db->lastInsertId();
            }

            return $this->id;
        }
        catch(PDOException $e){
            throw new Exception('you have err in insert or update user data' . $e);
        }
    }

    static function findbyemail($email){
        $db = Dbconnection::getInstance()->getConnection();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            return new Etudiant(
                $result['user_id'],
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['role'],
                $result['status'],
                $result['password']
            );
        }

        return null;
    }

    static function signup($nom, $prenom, $email, $role, $password){
        if(self::findbyemail($email)){
            throw new Exception('email is been regestred before!');
        }

        if(strlen($password) < 8){
            throw new Exception('password must be more than 8 caracters!');
        }

        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);

        $etudiant = new Etudiant(null, $nom, $prenom, $email, $role);
        $etudiant->hashPass($password);
        $etudiant->insertUser();
    }
}

?>