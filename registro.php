<?php
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

// Datos del usuario
$username = 'ergoadmin';
$password = 'Gatos2024!';

// Hashear la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL para insertar el usuario
$sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario creado correctamente.";
} else {
    echo "Error al crear el usuario: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
