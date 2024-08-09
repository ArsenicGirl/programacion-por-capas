<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Configuración de la conexión
    $host = "localhost";
    $user = "root";
    $password = ""; // Cambia si tienes una contraseña
    $dbname = "tallercamphouse";
    $port = 3307; // Puerto personalizado

    // Conectar a la base de datos
    $enlace = mysqli_connect($host, $user, $password, $dbname, $port);

    // Verificar la conexión
    if (!$enlace) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    echo "Conexión exitosa";

    // Cerrar la conexión
    mysqli_close($enlace);
    ?>
</body>
</html>
