<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "productos_2024";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Capturar datos del formulario
$nombre_apellido = $_POST['nombre_apellido'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null; // Capturar "empresa" si se ingresó

// Insertar los datos en la base de datos
$sql = "INSERT INTO tabla_contactos (nombre_apellido, telefono, email, empresa) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nombre_apellido, $telefono, $email, $empresa);

// Inicializar la variable para la respuesta
$respuesta = "";

if ($stmt->execute()) {
    // Si la inserción fue exitosa
    $respuesta = "Formulario enviado correctamente.";
} else {
    // Si hubo un error
    $respuesta = "Error al enviar el formulario: " . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Redirigir de nuevo al formulario con la respuesta como parámetro GET
header("Location: ergoformulario.html?respuesta=" . urlencode($respuesta));
exit();
?>
