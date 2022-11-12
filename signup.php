<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /PaginaResortes');
    }

require 'database.php';

$message = '';

// if (!empty($_POST['email']) && !empty($_POST['password'])) {
//     $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':name', $_POST['name']);
//     $stmt->bindParam(':email', $_POST['email']);
//     $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
//     $stmt->bindParam(':password', $password);

//     if ($stmt->execute()) {
//         $message = 'Usuario creado satisfactoriamente';
//     } else {
//         $message = 'Hubo un error creando tu cuenta';
//     }
// }
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])) {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $password_confirmation = password_hash($_POST['password-confirmation'], PASSWORD_BCRYPT);

        if (password_verify($_POST['password-confirmation'], $password)) {
            if($stmt->execute()){
                $message = 'Usuario creado satisfactoriamente';
                header('Location: /PaginaResortes/signupSuccess.php');
            } else {
                $message = 'Hubo un error creando tu cuenta';
            }
        }else{
            $message = 'Las contraseñas no coinciden';
        }
    }else if(!empty($_POST['email']) || !empty($_POST['password']) || !empty($_POST['name'])){
        $message = 'Por favor complete todos los datos';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <h3 style="text-align: center; font-size: 2rem">¿Ya tenés una cuenta? <a href="login.php">Iniciar Sesión</a></h3>

    <?php if (!empty($message)) : ?>
        <p class="cuenta-creada"> <?= $message ?></p>
    <?php endif; ?>

    <div class="form-main-container">
        <div class="form-container">
            <form action="signup.php" method="POST">
                <label for="username">Nombre</label><br>
                <input type="text" name="name"><br>
                <label for="email">E-Mail</label><br>
                <input type="text" name="email"><br>
                <label for="password">Contraseña</label><br>
                <input type="password" name="password"><br>
                <label for="password-confirmation">Confirmar contraseña</label><br>
                <input type="password" name="password-confirmation"><br>
                <input type="submit" value="Crear Cuenta" id="submit-button">
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo footer-items">
                <img src="img/resorte.png" alt="" width="30px">
            </div>
            <div class="footer-info footer-items">
                <h3>Info</h3>
                <ul>
                    <li>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam deleniti quam a inventore, voluptates animi consectetur modi, deserunt consequatur assumenda dignissimos esse enim eveniet eius blanditiis aspernatur ipsam non harum.</p>
                    </li>
                    <li>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi quis minima sint placeat laboriosam dicta a tempora optio impedit aperiam ipsum ex doloribus, quod sed maxime numquam repudiandae labore? Rerum?</p>
                    </li>
                </ul>
            </div>
            <div class="footer-redes footer-items">
                <h3>Siguenos</h3>
                <ul>
                    <li>Instagram</li>
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Youtube</li>
                </ul>
            </div>
        </div>
        <div class="footer-copyright">
            <p>©2022 <span style="font-weight: bold;">Resortes</span></p>
        </div>
    </footer>
</body>

</html>