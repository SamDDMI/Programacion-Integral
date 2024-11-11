<?php 
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $imagen = trim($_POST['imagen']);

    // Validación de campos vacíos
    if (empty($nombre) || empty($descripcion) || empty($imagen)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Uso de consultas preparadas para evitar inyección SQL
        $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, imagen) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $descripcion, $imagen);

        if ($stmt->execute()) {
            echo "Nuevo producto creado con éxito";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
}
?>
