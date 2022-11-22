<?php

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /PaginaResortes');
    }

    require 'database.php';

    // if (!empty($_POST['email']) && !empty($_POST['password'])) {
    //     $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    //     $records->bindParam(':email', $_POST['email']);
    //     $records->execute();
    //     $results = $records->fetch(PDO::FETCH_ASSOC);

    //     $message = '';
    
    // if($results){
    //     if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
    //         $_SESSION['user_id'] = $results['id'];
    //         header("Location: /PaginaResortes");
    //     } else {
    //         $message = 'Las credenciales no coinciden!';
    //     }
    // } else {
    //     $message = 'Las credenciales no coinciden!';
    // }
    // }

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $sql = "SELECT id, email, password FROM users WHERE email = '" . $_POST['email'] . "'";
        $records = $conn->query($sql);

        $results = $records->fetch_assoc();

        if($results){
            if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
                $_SESSION['user_id'] = $results['id'];
                header("Location: /PaginaResortes");
            } else {
                $message = 'Las credenciales no coinciden!';
            }
        } else {
            $message = 'Las credenciales no coinciden!';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sesión</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script defer src="js/index.js"></script>
    <style>
.button {
 margin-top: 2rem;
 font-size: 2rem;
 cursor: pointer;
 text-decoration: none;
 background-color: white;
 display: inline-block;
 padding: 12px 24px;
 border: 2px solid #4f4f4f;
 border-radius: 1rem;
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
                        <a href="account.php" class="nav-menu-link nav-link">Cuenta</a>
                    </li>
                <?php else: ?>
                    <li class="nav-menu-item">
                        <a href="login.php" class="nav-menu-link nav-link nav-menu-link_active">Iniciar Sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <?php if(!empty($message)): ?>
        <p class="mensaje"><?= $message ?></p>
    <?php endif; ?>

    <div class="form-main-container">
        <div class="form-container">
            <h3 style="text-align: center; font-size: 2rem">¿No tenés una cuenta? <a href="signup.php">Crear Cuenta</a></h3>
            <form action="login.php" method="POST">
                <label for="username">E-mail</label><br>
                <input type="text" id="username" name="email" class="input"><br>
                <label for="password">Contraseña</label><br>
                <input type="password" name="password" id="password" class="input"><br>
                <button type="submit" value="Iniciar Sesión" id="submit-button" class="button">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <?php
        require 'partials/footer.php';
    ?>

</body>
</html>