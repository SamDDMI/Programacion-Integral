<?php
include 'conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria = trim($_POST['categoria']);
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);

    // Validación de campos
    if (empty($categoria) || empty($titulo) || empty($descripcion) || empty($_FILES['imagen']['name'])) {
        echo "Todos los campos son obligatorios, incluyendo la imagen.";
        exit;
    }

    // Procesar la imagen
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "imagenes/";
    $target_file = $target_dir . basename($imagen);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validación de la imagen
    if ($_FILES["imagen"]["size"] > 500000) {
        echo "El archivo es demasiado grande.";
        exit;
    }

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
        exit;
    }

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        // Inserción en la base de datos con sentencia preparada
        $stmt = $conn->prepare("INSERT INTO productos (categoria, titulo, descripcion, imagen) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $categoria, $titulo, $descripcion, $target_file);

        if ($stmt->execute()) {
            echo "Producto agregado exitosamente.";
        } else {
            echo "Error al guardar el producto: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al subir la imagen.";
    }

    $conn->close();
}
?>
