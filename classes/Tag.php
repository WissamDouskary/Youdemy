<?php 
require_once '../classes/conn.php';

Class Tag {
    private $id;
    private $name;

    function __construct($name){
        $this->name = $name;
    }

    static function addMultipleTags($tags) {
        $db = Dbconnection::getInstance()->getConnection();
        try{
        $stmt_check = $db->prepare("SELECT tag_id FROM tags WHERE name = :tag_name");
        $stmt_insert = $db->prepare("INSERT INTO tags (name) VALUES (:tag_name)");
    
        $lastInsertIds = [];
    
        foreach ($tags as $tag) {
            $stmt_check->bindParam(':tag_name', $tag);
            $stmt_check->execute();
    
            if ($stmt_check->rowCount() == 0) {
                $stmt_insert->bindParam(':tag_name', $tag);
                $stmt_insert->execute();
                $lastInsertIds[] = $db->lastInsertId();
            } else {
                $existingTag = $stmt_check->fetch(PDO::FETCH_ASSOC);
                $lastInsertIds[] = $existingTag['tag_id'];
            }
        }
        return $lastInsertIds;
        }
        catch(PDOException $e){
            throw new Exception('There is an error while adding tags');
        }
    }
}
?>