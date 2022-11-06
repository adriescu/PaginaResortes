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
    <link rel="stylesheet" href="css/index2.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script defer src="js/index.js"></script>
</head>
<body>
    
    <?php
        require 'partials/header.php';
    ?>

    <main class="main">
        <div class="main-div-principal">
            <h1>Resortes lorem ipsum</h1>
            <p>Esto es información importante lorem ipsum</p>
            <?php if(!empty($user)): ?>
                <p class="welcome">Bienvenido <?= $user['name']; ?></p> 
                <p class="welcome">Ya has iniciado sesión</p>
                <a href="logout.php" style="font-size: 2rem;text-decoration: none">
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