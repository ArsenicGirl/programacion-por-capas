<?php
require_once('Database.php');

class TutorDAO {
    public static function CreateTutor($name, $phone, $is_director) {
       
        $database = Database::getInstance();
        $conn = $database->getPDO();

        $stmt = $conn->prepare('INSERT INTO tutor (name, phone, is_director) VALUES (:name, :phone, :is_director)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':is_director', $is_director);

        if ($stmt->execute()) {
            header('HTTP/1.1 201 Tutor creado correctamente');
        } else {
            header('HTTP/1.1 404 No se creó');
        }
    }
}
?>
