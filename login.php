<?php

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /PaginaResortes');
    }

    // require 'database.php';

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
</head>
<body>

    <?php
        require 'partials/header-empty.php';
    ?>

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