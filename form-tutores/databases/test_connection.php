<?php
//Este codigo lo creo solo para comprobar la conexion en otros pc
//recordar quitar la espeficicacion del puerto en otros xampp que usen el puerto 3306 normal
require './Database.php';

try {
    $db = Database::getInstance();
    $pdo = $db->getPDO();
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "Falló la conexión: " . $e->getMessage();
}
?>
