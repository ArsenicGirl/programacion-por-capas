<?php
require_once('Database.php');
require_once('TutorDTO.php');

class TutorDAO extends Database {

    public function __construct() {
        $this->pdo = Database::getInstance()->getPDO();
    }


    //Leer todos lso tutores
    public function readTutor() {
        $sql = "SELECT id, name, phone, is_director FROM tutor";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $tutors = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tutors[] = new TutorDTO(
                $row['id'],
                $row['name'],
                $row['phone'],
                (bool)$row['is_director']
            );
        }

        return $tutors;
    }

    public function readById($id) {
        $sql = "SELECT id, name, phone, is_director FROM tutor WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new TutorDTO(
                $row['id'],
                $row['name'],
                $row['phone'],
                (bool)$row['is_director']
            );
        } else {
            return null;
        }
    }

    public function createTutor(TutorDTO $tutorDTO) {
        $sql = "INSERT INTO tutor (name, phone, is_director) VALUES (:name, :phone, :is_director)";
        $stmt = $this->pdo->prepare($sql);
        
        // Definir variables temporales
        $name = $tutorDTO->getName();
        $phone = $tutorDTO->getPhone();
        $is_director = $tutorDTO->getIsDirector();

        // Pasar las variables temporales a bindParam (aqui no acepta valores directos sino que solo acepta variables)
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':is_director', $is_director, PDO::PARAM_BOOL);
        $stmt->execute();
    }

    public function updateTutor(TutorDTO $tutorDTO) {
        $sql = "UPDATE tutor SET name = :name, phone = :phone, is_director = :is_director WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        
        //igual variables temporales
        $id = $tutorDTO->getId();
        $name = $tutorDTO->getName();
        $phone = $tutorDTO->getPhone();
        $is_director = $tutorDTO->getIsDirector();
    
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':is_director', $is_director, PDO::PARAM_BOOL);
        $stmt->execute();
    }

    public function deleteTutor($id) {
        $sql = "DELETE FROM tutor WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    /*public static function CreateTutor($name, $phone, $is_director) {
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
    }*/
}
?>
