<?php
session_start();

// Redirigir si no ha iniciado sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "productos_2024";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Variables para almacenar valores en caso de editar un producto
$id_editar = $nombre_editar = $descripcion_editar = $imagen_editar = $categoria_editar = $especificaciones_editar = "";

// Operación: Crear o Editar Producto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crear o actualizar producto
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $especificaciones = $_POST['especificaciones'];
    $imagen = ""; // Inicializar la imagen

    // Manejo de archivo subido
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $archivo_tmp = $_FILES['imagen']['tmp_name'];
        $nombre_archivo = $_FILES['imagen']['name'];
        $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
        
        // Validar extensiones permitidas (jpg, png, jpeg)
        $ext_permitidas = ['jpg', 'jpeg', 'png'];
        if (in_array($ext, $ext_permitidas)) {
            $ruta_destino = 'uploads/' . uniqid() . "." . $ext; // Guardar con un nombre único
            if (move_uploaded_file($archivo_tmp, $ruta_destino)) {
                $imagen = $ruta_destino; // Asignar la ruta de la imagen
            } else {
                echo "Error al subir el archivo.";
            }
        } else {
            echo "Formato de imagen no permitido. Solo se permiten jpg, jpeg y png.";
        }
    }

    // Verificar si es edición o creación
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Editar producto
        $id = $_POST['id'];
        $sql = "UPDATE productos SET nombre=?, descripcion=?, imagen=?, categoria=?, especificaciones=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nombre, $descripcion, $imagen, $categoria, $especificaciones, $id);
        
        if ($stmt->execute()) {
            echo "Producto actualizado correctamente";
        } else {
            echo "Error al actualizar el producto: " . $stmt->error;
        }
    } else {
        // Crear nuevo producto
        $sql = "INSERT INTO productos (nombre, descripcion, imagen, categoria, especificaciones) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $descripcion, $imagen, $categoria, $especificaciones);
        
        if ($stmt->execute()) {
            echo "Producto creado correctamente";
        } else {
            echo "Error al crear el producto: " . $stmt->error;
        }
    }
    $stmt->close();
}

// Operación: Eliminar producto
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM productos WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Producto eliminado correctamente";
    } else {
        echo "Error al eliminar el producto: " . $stmt->error;
    }
    $stmt->close();
}

// Operación: Cargar producto para editar
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id_editar = $_POST['id'];
    $sql = "SELECT * FROM productos WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_editar);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_editar = $row['nombre'];
        $descripcion_editar = $row['descripcion'];
        $imagen_editar = $row['imagen'];
        $categoria_editar = $row['categoria'];
        $especificaciones_editar = $row['especificaciones'];
    }
    $stmt->close();
}

// Leer productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
$productos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Gestión de Productos</h1>

    <!-- Formulario para crear o editar productos -->
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id_editar; ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre_editar; ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" required><?php echo $descripcion_editar; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Subir Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen" <?php echo $id_editar ? '' : 'required'; ?>>
            <?php if ($id_editar): ?>
                <img src="<?php echo $imagen_editar; ?>" alt="<?php echo $nombre_editar; ?>" style="max-height: 100px;" class="mt-2">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select class="form-select" name="categoria" id="categoria" required>
                <option value="Antropometría" <?php echo ($categoria_editar == 'Antropometría') ? 'selected' : ''; ?>>Antropometría</option>
                <option value="Biomecánica" <?php echo ($categoria_editar == 'Biomecánica') ? 'selected' : ''; ?>>Biomecánica</option>
                <option value="Fisiología" <?php echo ($categoria_editar == 'Fisiología') ? 'selected' : ''; ?>>Fisiología</option>
                <option value="Ambiental" <?php echo ($categoria_editar == 'Ambiental') ? 'selected' : ''; ?>>Ambiental</option>
                <option value="Impresión 3D" <?php echo ($categoria_editar == 'Impresión 3D') ? 'selected' : ''; ?>>Impresión 3D</option>
                <option value="Bitalino" <?php echo ($categoria_editar == 'Bitalino') ? 'selected' : ''; ?>>Bitalino</option>
                <option value="Software" <?php echo ($categoria_editar == 'Software') ? 'selected' : ''; ?>>Software</option>
                <option value="Manuales" <?php echo ($categoria_editar == 'Manuales') ? 'selected' : ''; ?>>Manuales</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="especificaciones" class="form-label">Especificaciones del Producto</label>
          
            <textarea class="form-control" name="especificaciones" id="especificaciones" required><?php echo $especificaciones_editar; ?></textarea>
            </div>
    <button type="submit" class="btn btn-primary"><?php echo $id_editar ? 'Actualizar Producto' : 'Crear Producto'; ?></button>
</form>

<!-- Tabla de productos -->
<h2 class="mt-5">Lista de Productos</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Categoría</th>
            <th>Especificaciones</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" style="max-height: 100px;"></td>
                <td><?php echo $producto['categoria']; ?></td>
                <td><?php echo $producto['especificaciones']; ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                        <button type="submit" name="action" value="edit" class="btn btn-warning">Editar</button>
                    </form>
                    <form method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                        <button type="submit" name="action" value="delete" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
