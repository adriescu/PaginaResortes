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
 border-radius: 4px;
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
                <button type="submit" value="Crear Cuenta" id="submit-button" class="button">Crear cuenta</button>
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