<?php
require_once('../TutorDAO.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        Client__get_all_clients();
    }
?>