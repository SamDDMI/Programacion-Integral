<?php
// Datos de conexión a la base de datos
include 'db.php';

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $nombre_apellido = $_POST['nombre_apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // Verificar que todos los campos estén completos
    if (!empty($nombre_apellido) && !empty($telefono) && !empty($email)) {
        // Preparar la consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO catalogo_descargas (nombre_apellido, telefono, email) VALUES (?, ?, ?)";

        // Preparar la declaración
        if ($stmt = $conn->prepare($sql)) {
            // Enlazar los parámetros
            $stmt->bind_param("sss", $nombre_apellido, $telefono, $email);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Si se ejecuta correctamente, permitir la descarga
                header("Content-Type: application/pdf");
                header("Content-Disposition: attachment; filename=Catalogo_2024.pdf");
                readfile("catalogo/Catalogo_2024.pdf");
                exit;
            } else {
                echo "Error al registrar los datos: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos antes de descargar.');</script>";
    }
}

// Cerrar la conexión
$conn->close();
?>
