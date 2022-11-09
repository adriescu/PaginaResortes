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
    <link rel="stylesheet" href="css/pedidos.css">
</head>
<body>
    <?php
        require 'partials/header-empty.php';
    ?>
<div class="formularioPedido">
    <form action="hacerPedido.php" submit="POST">
        <label for="tipoDeResorte">Tipo</label>
        <select name="" id="tipoDeResorte">
            <?php
                //acá va el código :)
            ?>
            <option value="personalizado">Personalizado</option>
        </select>
        <label for="">Canatidad</label>
        <input type="text" name="" id="">
        <label for="">Medida</label>
        <input type="number" name="" id="">
        <label for="">Número de vueltas</label>
        <input type="number" name="" id="">
        <label for="">Descripción</label>
        <input type="text" name="" id="">
        <input type="submit" value="Enviar pedido" id="boton">
    </form>
</div>

    <?php
        require 'partials/footer.php';
    ?>
</body>
</html>