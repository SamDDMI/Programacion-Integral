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
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
    margin-left: 250px; /* Establece margen izquierdo para el contenedor principal */
    flex-grow: 1; /* Permite que el main ocupe el espacio restante */
    padding: 20px; /* Agrega un poco de espacio interno */
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

        @media (max-width: 768px) {
    #sidebar {
        transform: translateX(-100%); /* Ocultar menú lateral en pantallas pequeñas */
    }

    #sidebar.active {
        transform: translateX(0); /* Mostrar menú lateral */
    }

    main {
        margin-left: 0; /* Sin margen en pantallas pequeñas */
    }
}
    </style>
</head>

<body>
    <!-- Sidebar -->

<nav id="sidebar" class="bg-dark">
    <div class="nav flex-column">
        <div class="navbar navbar-dark mt-auto">
            <a href="index2.html" class="navbar-brand d-flex justify-content-center">
                <img class="logo" src="Imagenes/ERGOTECHLOGO.png" alt="Logo">
            </a>
        </div>
        <a href="index2.html" class="nav-link">
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

    <header>

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
        </div>
    </footer>

    <!-- Enlace a los scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybQ5b3r2GTqDbs0KX+49YgIs4QK0Z1D8ZBxdHGXbg8h1OoErw"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-JC7Dd8z0RBLwF7tT2Q6Yra5XgDLnGuF7gQQ6A3P/tdg9gT5Qu5UOaBPlYyoyWgE9"
        crossorigin="anonymous"></script>
    
    <script>
        // Script para mostrar/ocultar el menú lateral
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('main').classList.toggle('active');
        });
    </script>
</body>

</html>