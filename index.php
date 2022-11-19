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
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">

<style>

.button {
 font-size: 3rem;
 cursor: pointer;
 text-decoration: none;
 background-color: white;
 display: inline-block;
 padding: 12px 24px;
 border: 2px solid #4f4f4f;
 border-radius: 1.5rem;
 transition: all 0.2s ease-in;
 position: relative;
 overflow: hidden;
 color: black;
 z-index: 1;
}

.button:before {
 content: "";
 position: absolute;
 left: 50%;
 transform: translateX(-50%) scaleY(1) scaleX(1.25);
 top: 100%;
 width: 140%;
 height: 180%;
 background-color: rgba(0, 0, 0, 0.05);
 border-radius: 50%;
 display: block;
 transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
 z-index: -1;
}

.button:after {
 content: "";
 position: absolute;
 left: 55%;
 transform: translateX(-50%) scaleY(1) scaleX(1.45);
 top: 180%;
 width: 160%;
 height: 190%;
 background-color: rgb(0, 69, 69);
 border-radius: 50%;
 display: block;
 transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
 z-index: -1;
}

.button:hover {
 color: #ffffff;
 border: 2px solid #39bda7;
}

.button:hover:before {
 top: -35%;
 background-color: #39bda7;
 transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}

.button:hover:after {
 top: -45%;
 background-color: darkcyan;
 transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}
</style>

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
                <a class="button" href="logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a class="button" href="login.php">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </main>

    

    <?php
    require 'partials/footer.php';
    ?>
</body>
</html>