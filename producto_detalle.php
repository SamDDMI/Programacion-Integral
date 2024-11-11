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

    <style>
        
        /* El main debe crecer para ocupar todo el espacio disponible */
        main {
            flex-grow: 1;
            margin-left: 250px; /* Margen para el menú lateral */
            transition: margin-left .3s; /* Animación de deslizamiento */
        }

        #sidebar {
    min-width: 250px;
    max-width: 250px;
    background-color: #343a40;
    color: white;
    height: 100vh;
    position: fixed;
    display: flex;
    flex-direction: column;
    top: 0;
    left: 0;
}

  
#sidebar .nav-link {
    color: white;
    padding: 1rem 1.5rem;
}
#sidebar .navbar-brand {
    padding: 1rem 0;
}

    #sidebar .nav-link:hover {
        color: #007bff; /* Cambia el color del texto a azul */
        background-color: #495057;
    }

    #sidebar .navbar-brand img {
        width: 80%;
        padding: 1rem;
    }
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
           /* Estilos para pantallas pequeñas */
           @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            #content {
                margin-left: 0;
                width: 100%;
            }

            .offcanvas-backdrop {
                display: none;
            }

            .offcanvas-active #sidebar {
                transform: translateX(0);
            }

            /* Botón hamburguesa */
            .menu-btn {
                position: absolute;
                top: 15px;
                left: 15px;
                z-index: 1000;
                display: inline-block;
                background-color: #343a40;
                color: white;
                border: none;
                padding: 10px 15px;
                cursor: pointer;
                border-radius: 3px;
            }

            .menu-btn:hover {
                background-color: #495057;
            }
             /* Sección de empleados */
  
            
        }
    </style>
</head>

<body>

  <!-- Sidebar -->

  <nav id="sidebar" class="bg-dark">
    <div class="nav flex-column">
        <div class="navbar navbar-dark mt-auto">
            <a href="/" class="navbar-brand d-flex justify-content-center">
                <img class="logo" src="Imagenes/ERGOTECHLOGO.png" alt="Logo">
            </a>
        </div>
        <a href="index.html" class="nav-link">
            <i class="bi bi-house-door-fill"></i> Home
        </a>
        <a href="productos.php" class="nav-link">
            <i class="bi bi-box-fill"></i> Productos
        </a>
        <a href="servicios.html" class="nav-link">
            <i class="bi bi-tools"></i> Servicios
        </a>
        <a href="ergocatalogo.html" class="nav-link">
            <i class="bi bi-file-earmark-text"></i> Catálogo
        </a>
        <a href="software.html" class="nav-link">
            <i class="bi bi-laptop-fill"></i> Software
        </a>
        <a href="ergoformulario.html" class="nav-link">
            <i class="bi bi-envelope-fill"></i> Contacto
        </a>
    </div>
</nav>
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
