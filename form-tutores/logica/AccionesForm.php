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

//buscar por id
$editId = $_GET['id'] ?? '';

if ($editId) {
    $tutor = $tutorLogic->getReadById($editId);
    if ($tutor) {
        echo '<script>
            document.getElementById("id").value = ' . json_encode($tutor->getId()) . ';
            document.getElementById("name").value = ' . json_encode($tutor->getName()) . ';
            document.getElementById("phone").value = ' . json_encode($tutor->getPhone()) . ';
            document.getElementById("is_director").checked = ' . ($tutor->getIsDirector() ? 'true' : 'false') . ';
        </script>';
    }
}

//Conectar con tabla del front y mostrar resultados

foreach ($tutores as $tutor){
    echo '<tr>';
    echo '<td>' . htmlspecialchars($tutor->getId()) . '</td>';
    echo '<td>' . htmlspecialchars($tutor->getName()) . '</td>';
    echo '<td>' . htmlspecialchars($tutor->getPhone()) . '</td>';
    echo '<td>' . ($tutor->getIsDirector() ? 'Si' : 'No') . '</td>';
    echo '<td><a href="TutorForm.php?action=edit&id=' . htmlspecialchars($tutor->getId()) . '">Editar</a></td>';
    echo '</tr>';
}




?>