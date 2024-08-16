<?php
require_once('Database.php');
require_once('TutorDTO.php');


class TutorDAO extends Database{
    
    //Leer todos lso tutores
    public function readTutor() {
        
        $sql = "SELECT id, name, phone, is_director FROM tutor";

        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute();

        $tutor = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tutor[] = new TutorDTO(
                $row['id'],
                $row['name'],
                $row['phone'],
                (bool)$row['is_director']
            );
        }

        return $tutores;

    }

    public function readById($id){
        $sql = "SELECT id, name, phone, is_director FROM tutor WHERE id = :id";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindParam(':id', PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row){
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
    public function createTutor(TutorDTO $tutorDTO){
        $sql = "INSERT INTO tutor (name, phone, is_director) VALUES (:name, :phone, :is_director)";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindParam(':name', $tutorDTO->getName());
        $stmt->bindParam(':phone', $tutorDTO->getPhone());
        $stmt->bindParam('is_director', $tutorDTO->getIsDirector(), PDO::PARAM_BOOL);
        $stmt->execute();
    }
    public function updateTutor(TutorDTO $tutorDTO){
        $sql = "UPDATE tutor SET name = :name, phone = :phone, is_director = :is_director WHERE id = :id";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindParam(':id', $tutorDTO->getId(), PDO::PARAM_INT);
        $stmt->bindParam(':name', $tutorDTO->getName());
        $stmt->bindParam(':phone', $tutorDTO->getPhone());
        $stmt->bindParam(':is_director', $tutorDTO->getIsDirector(), PDO::PARAM_BOOL);
        $stmt->execute();
    }
    public function deleteTutor($id){
        $sql = "DELETE FROM tutor WHERE id = :id";
        $stmt = $this->getPDO()->prepare($sql);
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
