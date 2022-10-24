<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="index2.css">
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
                <a href="index.php" class="nav-menu-link nav-link">Inicio</a>
                </li>
            <li class="nav-menu-item">
                <a href="#" class="nav-menu-link nav-link">Hacer pedido</a>
            </li>
            <li class="nav-menu-item">
                <a href="catalogue.php" class="nav-menu-link nav-link nav-menu-link_active">Catálogo</a>
            </li>
            <li class="nav-menu-item">
                <a href="faq.php" class="nav-menu-link nav-link">Preguntas frecuentes</a>
            </li>
            <li class="nav-menu-item">
                <a href="about.php" class="nav-menu-link nav-link">Acerca de</a>
            </li>
        </ul>
    </nav>
</header>

    <?php
        require 'partials/footer.php';
    ?>

</body>
</html>