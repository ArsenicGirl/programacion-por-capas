<?php
require_once('TutorLogic.php');

$tutorLogic = new TutorLogic();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST['action'] ?? '';

    switch ($action){
        case 'create':
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $is_director = isset($_POST['is_director']) ? 1 : 0;
            $tutorLogic->createTutor($name, $phone, $is_director);
            break;

        case 'update':
            $id = $_POST['id'] ?? '';
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $is_director = isset($_POST['is_director']) ? 1 : 0;
            $tutorLogic->updateTutor($id, $name, $phone, $is_director);
            break;

        case 'delete':
            $id = $_POST['delete_id'] ?? '';
            $tutorLogic->deleteTutor($id);
            break;

        default:
            echo '<script>
                alert("No se pudo realizar"); 
                window.location.href = TutorForm.php;
                 </script>';
            break;
    }
}

// Obtener todos los tutores para mostrar en la tabla
$tutores = $tutorLogic->getReadTutor();

//Conectar con tabla del front y mostrar resultados

foreach ($tutores as $tutor){
    echo '<tr>';
    echo '<td>' . htmlspecialchars($tutor->getId()) . '</td>';
    echo '<td>' . htmlspecialchars($tutor->getName()) . '</td>';
    echo '<td>' . htmlspecialchars($tutor->getPhone()) . '</td>';
    echo '<td>' . ($tutor->getIsDirector() ? 'Si' : 'No') . '</td>';
    echo '</tr>';
}

?>