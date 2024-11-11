<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $imagen = trim($_POST['imagen']);

    if (empty($nombre) || empty($descripcion) || empty($imagen)) {
        echo "Todos los campos son obligatorios.";
    } else {
        $stmt = $conn->prepare("UPDATE productos SET nombre=?, descripcion=?, imagen=? WHERE id=?");
        $stmt->bind_param("sssi", $nombre, $descripcion, $imagen, $id);

        if ($stmt->execute()) {
            echo "Producto actualizado con éxito";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
}
?>
