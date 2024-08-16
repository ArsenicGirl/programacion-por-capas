<?php
require_once('../TutorDAO.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' 
    && isset($_GET['name']) 
    && isset($_GET['phone']) 
    && isset($_GET['is_director'])) {
    
    TutorDAO::CreateTutor($_GET['name'], $_GET['phone'], $_GET['is_director']);
}
?>
