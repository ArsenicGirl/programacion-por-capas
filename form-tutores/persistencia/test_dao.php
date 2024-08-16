<?php
require_once('Database.php');
require_once('TutorDAO.php');
require_once('TutorDTO.php');

// Crear una instancia de TutorDAO
$tutorDAO = new TutorDAO();

// Crear un nuevo tutor para prueba
$newTutor = new TutorDTO(null, 'Carlos Gómez', '111223344', false);

// Función para mostrar todos los tutores
function displayTutors($tutors) {
    echo "<h2>Lista de Tutores</h2>";
    echo "<table border='1'>";
    echo "<thead><tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Es Director</th></tr></thead>";
    echo "<tbody>";
    foreach ($tutors as $tutor) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($tutor->getId()) . "</td>";
        echo "<td>" . htmlspecialchars($tutor->getName()) . "</td>";
        echo "<td>" . htmlspecialchars($tutor->getPhone()) . "</td>";
        echo "<td>" . ($tutor->getIsDirector() ? 'Sí' : 'No') . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

// Probar creación de tutor
$tutorDAO->createTutor($newTutor);
echo "<p>Tutor creado.</p>";

// Leer todos los tutores
$tutors = $tutorDAO->readTutor();
displayTutors($tutors);

// Probar actualización de tutor específico
// Encontrar el tutor con ID 21
$tutorToUpdate = null;
foreach ($tutors as $tutor) {
    if ($tutor->getId() == 33) {
        $tutorToUpdate = $tutor;
        break;
    }
}

if ($tutorToUpdate) {
    $tutorToUpdate->setName('Luisa Fernández');
    $tutorToUpdate->setPhone('555667788');
    $tutorToUpdate->setIsDirector(true);
    $tutorDAO->updateTutor($tutorToUpdate);
    echo "<p>Tutor fue actualizado.</p>";
} else {
    echo "<p>No se encontró el tutor con ID 21 para actualizar.</p>";
}

// Leer todos los tutores después de la actualización
$tutors = $tutorDAO->readTutor();
displayTutors($tutors);

// Probar eliminación de tutor específico
// Encontrar el tutor con ID 31
$tutorToDelete = null;
foreach ($tutors as $tutor) {
    if ($tutor->getId() == 31) {
        $tutorToDelete = $tutor;
        break;
    }
}

if ($tutorToDelete) {
    $tutorDAO->deleteTutor($tutorToDelete->getId());
    echo "<p>Tutor con ID 31 eliminado.</p>";
} else {
    echo "<p>No se encontró el tutor con ID 31 para eliminar.</p>";
}

// Leer todos los tutores después de la eliminación
$tutors = $tutorDAO->readTutor();
displayTutors($tutors);
?>


<?php/*

CON VARIABLES RELATIVAS

require_once('Database.php');
require_once('TutorDTO.php');

class TutorDAO extends Database {

    public function __construct() {
        $this->pdo = Database::getInstance()->getPDO();
    }

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
        
        $name = $tutorDTO->getName();
        $phone = $tutorDTO->getPhone();
        $isDirector = $tutorDTO->getIsDirector();
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':is_director', $isDirector, PDO::PARAM_BOOL);
        
        $stmt->execute();
    }

    public function updateTutor(TutorDTO $tutorDTO) {
        $sql = "UPDATE tutor SET name = :name, phone = :phone, is_director = :is_director WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        
        $id = $tutorDTO->getId();
        $name = $tutorDTO->getName();
        $phone = $tutorDTO->getPhone();
        $isDirector = $tutorDTO->getIsDirector();
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':is_director', $isDirector, PDO::PARAM_BOOL);
        
        $stmt->execute();
    }

    public function deleteTutor($id) {
        $sql = "DELETE FROM tutor WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}*/
?>
