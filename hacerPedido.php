<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacer Pedido</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php
        require 'partials/header-empty.php';
    ?>

    <form action="hacerPedido.php" submit="POST">
        <label for="">Tipo</label>
        <input type="text" name="" id="">
        <label for="">Cantidad</label>
        <input type="text" name="" id="">
    </form>

    <?php
        require 'partials/footer.php';
    ?>
</body>
</html>