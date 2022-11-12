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
            <a href="" class="logo nav-link">Resortes</a>
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
                    <a href="catalogue.php" class="nav-menu-link nav-link nav-menu-link_active">Catálogo</a>
                </li>
                <li class="nav-menu-item">
                    <a href="faq.php" class="nav-menu-link nav-link">Preguntas frecuentes</a>
                </li>
                <li class="nav-menu-item">
                    <a href="about.php" class="nav-menu-link nav-link">Acerca de</a>
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

    <?php
        require 'partials/footer.php';
    ?>

</body>
</html>