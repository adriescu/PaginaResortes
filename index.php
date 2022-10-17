<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/index2.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script defer src="js/index.js"></script>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a href="" class="logo nav-link">Resortes</a>
            <button class="nav-toggle">
            <i class="material-icons">menu</i>
            </button>
            <ul class="nav-menu">
                <li class="nav-menu-item">
                    <a href="#" class="nav-menu-link nav-link nav-menu-link_active">Inicio</a>
                </li>
                <li class="nav-menu-item">
                    <a href="#" class="nav-menu-link nav-link">Hacer pedido</a>
                </li>
                <li class="nav-menu-item">
                    <a href="#" class="nav-menu-link nav-link">Catálogo</a>
                </li>
                <li class="nav-menu-item">
                    <a href="#" class="nav-menu-link nav-link">Preguntas frecuentes</a>
                </li>
                <li class="nav-menu-item">
                    <a href="#" class="nav-menu-link nav-link">Acerca de</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="main">
        <div class="main-div-principal">
            <h1>Resortes lorem ipsum</h1>
            <p>Esto es información importante lorem ipsum</p>
            <a href="login.php" class="boton-estilo bg-secundario">Iniciar Sesión</a>
        </div>
    </main>

    <?php
    require 'partials/footer.php';
    ?>
</body>
</html>