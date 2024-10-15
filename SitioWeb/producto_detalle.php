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

// Obtener el ID del producto de la URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Consultar el producto por ID
$sql = "SELECT * FROM productos WHERE id = $id";
$result = $conn->query($sql);

// Verificar si se encontró el producto
if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
} else {
    echo "Producto no encontrado.";
    exit;
}

// Obtener productos aleatorios
$sql_random = "SELECT * FROM productos WHERE id != $id ORDER BY RAND() LIMIT 4"; // Limitar a 4 productos
$result_random = $conn->query($sql_random);

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre']; ?> - Detalles del Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <style>
        .product-details img {
            max-width: 100%;
            height: auto;
        }
        .product-specs {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
        .footer-custom {
            background-color: #343a40;
            color: white;
            padding: 2rem 0;
            margin-top: 50px;
        }
        .random-products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 30px;
        }
        .card {
            width: 18rem; /* Ancho fijo para todas las tarjetas */
            margin-bottom: 20px; /* Espaciado entre tarjetas */
        }
        .card img {
            height: 200px; /* Altura fija para las imágenes */
            object-fit: cover; /* Cubrir el espacio sin distorsionar */
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="product-details">
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <h1><?php echo $producto['nombre']; ?></h1>
                <p><?php echo $producto['descripcion']; ?></p>
                <div class="product-specs">
                    <h4>Especificaciones</h4>
                    <p><?php echo nl2br($producto['especificaciones']); ?></p>
                </div>
            </div>
        </div>

        <!-- Sección de productos aleatorios -->
        <div class="random-products">
            <?php while ($random_product = $result_random->fetch_assoc()) { ?>
                <div class="card">
                    <img src="<?php echo $random_product['imagen']; ?>" class="card-img-top" alt="<?php echo $random_product['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $random_product['nombre']; ?></h5>
                        <p class="card-text"><?php echo $random_product['descripcion']; ?></p>
                        <a href="productos.php?id=<?php echo $random_product['id']; ?>" class="btn btn-primary">Ver Producto</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<footer class="footer-custom">
    <div class="container text-center">
        <p>&copy; 2024 Ergotech. Todos los derechos reservados.</p>
        <p>Tu socio en soluciones ergonómicas y diseño innovador.</p>
        <p>Síguenos en <a href="#" class="text-light">Facebook</a> | <a href="#" class="text-light">Twitter</a> |
            <a href="#" class="text-light">LinkedIn</a></p>
        <button class="btn btn-warning"><a href="crud.php">Agregar Producto</a></button>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i1ZIJnpori0IrEYG7JoSTl56A5n" crossorigin="anonymous">
</script>
</body>

</html>
