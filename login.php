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
                    <a href="catalogue.php" class="nav-menu-link nav-link">Catálogo</a>
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
                        <a href="login.php" class="nav-menu-link nav-link nav-menu-link_active">Iniciar Sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <h3 style="text-align: center; font-size: 2rem">¿No tenés una cuenta? <a href="signup.php">Crear Cuenta</a></h3>

    <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <div class="form-main-container">
        <div class="form-container">
            <form action="login.php" method="POST">
                <label for="username">E-mail</label><br>
                <input type="text" name="email"><br>
                <label for="password">Contraseña</label><br>
                <input type="password" name="password"><br>
                <input type="submit" value="Iniciar Sesión" id="submit-button">
            </form>
        </div>
    </div>

    <?php
        require 'partials/footer.php';
    ?>

</body>
</html>