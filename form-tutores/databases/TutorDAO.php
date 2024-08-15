<?php
require_once('Database.php');
require_once('TutorDTO.php');


class TutorDAO extends Database{
    
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
            header('HTTP/1.1 404 No se pudo crear el tutor');
        }
    }

    public static function ReadTutor() {
        $database = Database::getInstance();
        $conn = $database->getPDO();

        $stmt = $conn->prepare('SELECT * FROM tutor');
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('HTTP/1.1 200 Tutores encontrados');
            echo json_encode($result);
        } else {
            header('HTTP/1.1 404 No se encontraron tutores');
        }
    }
}
?>
