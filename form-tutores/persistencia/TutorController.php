<?php
require_once '../logic/TutorLogic.php'; 

$service = new TutorService();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $tutor = $service->getTutorById($_GET['id']);
        echo json_encode($tutor);
    } else {
        $tutors = $service->getAllTutors();
        echo json_encode($tutors);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $service->createTutor($data['name'], $data['phone']);
    echo json_encode(['message' => 'Tutor created successfully']);
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $service->updateTutor($data['id'], $data['name'], $data['phone']);
    echo json_encode(['message' => 'Tutor updated successfully']);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $service->deleteTutor($_GET['id']);
        echo json_encode(['message' => 'Tutor deleted successfully']);
    }
}
?>
