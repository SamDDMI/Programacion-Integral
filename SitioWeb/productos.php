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

// Leer categorías
$categoriaSql = "SELECT DISTINCT categoria FROM productos";
$categoriaResult = $conn->query($categoriaSql);
$categorias = [];

if ($categoriaResult->num_rows > 0) {
    while ($row = $categoriaResult->fetch_assoc()) {
        $categorias[] = $row['categoria'];
    }
}

// Filtrar productos por categoría
$productos = [];
$selected_categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

if ($selected_categoria) {
    $sql = "SELECT * FROM productos WHERE categoria = '$selected_categoria'";
} else {
    $sql = "SELECT * FROM productos";
}

$result = $conn->query($sql);

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
    <title>Productos</title>
    <!-- Enlace al CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Enlace a tus estilos personalizados -->
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .card {
            height: 400px; /* Altura fija para las tarjetas */
            overflow: hidden; /* Ocultar el desbordamiento */
        }
        .card-img-top {
            height: 250px; /* Altura fija para la imagen */
            object-fit: cover; /* Mantener la relación de aspecto y cubrir el área */
        }
        .footer-custom {
            background-color: #343a40; /* Color de fondo del footer */
            color: white; /* Color del texto del footer */
            padding: 2rem 0; /* Espaciado del footer */
        }
    </style>
</head>

<body>
<header>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a href="/" class="navbar-brand">
                <img class="logo" src="Imagenes/ERGOTECHLOGO.png" alt="Logo" style="max-width: 120px;">
            </a>
            <!-- Botón para móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="index.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="productos.php" class="nav-link active" aria-current="page">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a href="servicios.html" class="nav-link">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Software</a>
                    </li>
                    <li class="nav-item">
                            <a href="ergocatalogo.html" class="nav-link">Catálogo</a>
                        </li>
                    <li class="nav-item">
                        <a href="ergoformulario.html" class="nav-link">Contacto</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

    <main>
        <h1 class="text-center mt-5">Nuestros Productos</h1>
        <div class="container mt-4">
            <!-- Menú de categorías -->
            <div class="row mb-4">
                <div class="col text-center">
                    <h4>Filtrar por categoría:</h4>
                    <?php foreach ($categorias as $categoria): ?>
                        <a href="productos.php?categoria=<?php echo $categoria; ?>" class="btn btn-outline-primary me-2">
                            <?php echo $categoria; ?>
                        </a>
                    <?php endforeach; ?>
                    <a href="productos.php" class="btn btn-outline-secondary">Ver Todo</a>
                </div>
            </div>
            <div class="row">
                <?php foreach ($productos as $producto): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="<?php echo $producto['imagen']; ?>" class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                            <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                            <a href="producto_detalle.php?id=<?php echo $producto['id']; ?>" class="btn btn-primary">Ver detalles</a>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container text-center">
            <p>&copy; 2024 Ergotech. Todos los derechos reservados.</p>
            <p>Tu socio en soluciones ergonómicas y diseño innovador.</p>
            <p>Síguenos en <a href="#" class="text-light">Facebook</a> | <a href="#" class="text-light">Twitter</a> |
                <a href="#" class="text-light">LinkedIn</a></p>
            <button class="btn" ><a href="crud.php">Agregar Producto</a></button> <!-- Botón oculto -->
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i1ZIJnpori0IrEYG7JoSTl56A5n" crossorigin="anonymous">
    </script>
</body>

</html>
