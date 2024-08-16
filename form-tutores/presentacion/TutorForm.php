<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../logica/AccionesForm.php"></script>
    <title>Document</title>
</head>
<body>

    <h1>Tutores Crud</h1>

    <!-- Formulario para crear y actualizar -->
     <div class="contenedor-formularios">
        <div class="contenedor-post">
            <form action="TutorForm.php" method="post">
                <input type="hidden" name="id" value=""> <!-- Este campo se debe rellenar solo cuando se actualice -->
                
                <label for="name">Nombre del tutor</label>
                <input type="text" name="name" id="name" required><br>

                <label for="phone">Número de telefono</label>
                <input type="tel" name="phone" id="phone" required><br>

                <label for="is_director">¿Posee el cargo de director?</label>
                <input type="checkbox" name="is_director" id="is_director" value="1"><br>

                <button type="submit" name="action" value="create">Crear tutor</button><br>
                <button type="submit" name="action" value="update">Actualizar tutor</button>

            </form>
        </div>

        <div class="contenedor-delete">
            <form action="TutorForm.php" method="post">
                <label for="delete_id">ID del tutor a Eliminar:</label>
                <input type="number" name="delete_id" id="delete_id" required>

                <button type="submit" name="action" value="delete">Eliminar</button>
            </form>
    
        </div>

    </div>

    <div class="tabla-datos">
        <h2>Lista de tutores</h2>

            <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>¿Es director?</th>
                </tr>
            </thead>
            <tbody>
                <?php include '../logica/AccionesForm.php'; ?>
            </tbody>
        </table>
 
    </div>
    






 <?php/*
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
    mysqli_close($enlace);*/
    ?>

</body>
</html>
