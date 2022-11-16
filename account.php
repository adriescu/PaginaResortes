<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }

    require 'database.php';

    $sql = "SELECT name, email FROM users WHERE id=" . $_SESSION['user_id'];
    $results = $conn->query($sql);

    $row = $results->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cuenta.css">
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
                    <a href="faq.php" class="nav-menu-link nav-link">Preguntas frecuentes</a>
                </li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-menu-item">
                        <a href="pedidos.php" class="nav-menu-link nav-link">Pedidos</a>
                    </li>
                    <li class="nav-menu-item">
                        <a href="account.php" class="nav-menu-link nav-link nav-menu-link_active">Cuenta</a>
                    </li>
                <?php else: ?>
                    <li class="nav-menu-item">
                        <a href="login.php" class="nav-menu-link nav-link">Iniciar Sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
<!--  
    <p>Nombre:</p>
    <p>Email:</p>
    <a href="pedidos.php">Ver pedidos</a>
-->
    <div class="cuenta-container">
    <?php
        echo "
        <div class='cuenta-div'>
            <p>Nombre: " . $row["name"] . "</p>
            <p>Email: " . $row["email"] . "</p>
            <a href='pedidos.php' class='cuenta-boton'>Ver pedidos</a>
            <a href='logout.php' class='cuenta-boton'>Cerrar Sesión</a>
        </div>
        ";
    ?>
    </div>
    <?php
        require 'partials/footer.php';
    ?>
</body>
</html>