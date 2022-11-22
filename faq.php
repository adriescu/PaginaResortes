<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/index2.css">
    <script defer src="js/index.js"></script>
</head>
<body>
<header class="header">
        <nav class="nav">
            <a href="index.php" class="logo nav-link">Resortes</a>
            <button class="nav-toggle">
            <i class="material-icons">menu</i>
            </button>
            <ul class="nav-menu">
                <li class="nav-menu-item">
                    <a href="index.php" class="nav-menu-link nav-link">Inicio</a>
                </li>
                <li class="nav-menu-item">
                    <a href="hacerPedido.php" class="nav-menu-link nav-link">Hacer pedido</a>
                </li>
                <li class="nav-menu-item">
                    <a href="catalogue.php" class="nav-menu-link nav-link">Catálogo</a>
                </li>
                <li class="nav-menu-item">
                    <a href="faq.php" class="nav-menu-link nav-link nav-menu-link_active">Preguntas frecuentes</a>
                </li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-menu-item">
                        <a href="pedidos.php" class="nav-menu-link nav-link">Pedidos</a>
                    </li>
                    <li class="nav-menu-item">
                        <a href="account.php" class="nav-menu-link nav-link">Cuenta</a>
                    </li>
                <?php else: ?>
                    <li class="nav-menu-item">
                        <a href="login.php" class="nav-menu-link nav-link">Iniciar Sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="preguntas-main">
        <div class="preguntas-div">
            <h2>Prguntas frecuentes</h2>
            <h3>¿Qué es un resorte?</h3>
            <p>Es una pieza elástica dispuesta en espiral, generalmente de metal, que se usa en ciertos mecanismos por la fuerza que desarrolla al recobrar su posición natural después de haber sido deformada (estirada, comprimida, doblada, etc.).</p>
            <h3>¿Para qué sirven?</h3>
            <p>El objetivo principal del resorte es que se adapta a las situaciones en las que se requiere aplicar una fuerza y que esta sea retornada en forma de energía.</p>
            <h3>¿Cómo funciona esta página?</h3>
            <p>Una vez iniciada sesión se pueden hacer pedidos; en la sección de pedidos se pueden ver todos los pedidos realizados y si están listos o no.</p>
            <h3>¿Son necesarios los resortes?</h3>
            <p>Totalmente. La Oranización Mundial de la Salud recomienda tener por lo menos 10 resortes.</p>
        </div>
    </main>

    <?php
        require 'partials/footer.php';
    ?>

</body>
</html>