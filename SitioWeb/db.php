

<?php
$servername = "localhost";
$username = "samtrax";
$password = "Samuel02.";
$dbname = "productos_2024";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
