<?php
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        // $records = $conn->prepare('SELECT id, name, email, password FROM users WHERE id = :id');
        // $records->bind_param(':id', $_SESSION['user_id']);
        // $records->execute();
        // $results = $records->fetch(PDO::FETCH_ASSOC);
        
        // $user = null;
        
        // if (count($results) > 0) {
        //     $user = $results;
        // }

        $sql = "SELECT id, name, email FROM users WHERE id = '" . $_SESSION['user_id'] . "'";
        $records = $conn->query($sql);

        $results = $records->fetch_assoc();

        $user = null;

        if (count($results) > 0) {
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script defer src="js/index.js"></script>
</head>
<body class="body-index">
    
    <header class="header">
        <nav class="nav">
            <a href="index.php" class="logo nav-link">Resortes</a>
            <button class="nav-toggle">
            <i class="material-icons">menu</i>
            </button>
            <ul class="nav-menu">
                <li class="nav-menu-item">
                    <a href="index.php" class="nav-menu-link nav-link nav-menu-link_active">Inicio</a>
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

    <main class="main">
        <div class="main-div-principal">
            <h1>Resortes Lorem Ipsum</h1>
            <p>Todos los resortes que estabas buscando</p>
            <?php if(!empty($user)): ?>
                <p class="welcome">Bienvenido <?= $user['name']; ?></p> 
                <p class="welcome">Ya has iniciado sesión</p>
                <a href="logout.php" class="boton-estilo">
                    Cerrar Sesión
                </a>
            <?php else: ?>
                <a href="login.php" class="boton-estilo bg-secundario">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </main>

    

    <?php
    require 'partials/footer.php';
    ?>
</body>
</html>