<?php
    session_start();

    require 'database.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }

    // if($_SESSION['user_id'] == 1){
    //     header('Location: pedidosAdmin.php');
    // }

//Eliminar pedido
    if(isset($_POST["eliminar"]) && $_SESSION['user_id'] != 1){
        $sql = "DELETE FROM pedidos WHERE id=" . $_POST["eliminar"] . " AND usuario=" . $_SESSION['user_id'];
        if ($conn->query($sql) === TRUE) {
            $message = 'Pedido eliminado satisfactoriamente';
        } else {
            $message = 'Hubo un error eliminando el pedido';
        }

    }else if(isset($_POST["eliminar"]) && $_SESSION['user_id'] == 1){
        $sql = "DELETE FROM pedidos WHERE id=" . $_POST["eliminar"];

        if ($conn->query($sql) === TRUE) {
            $message = 'Pedido eliminado satisfactoriamente';
        } else {
            $message = 'Hubo un error eliminando el pedido';
        }
        
    }

//Actualizar estado de los pedidos
    if(isset($_POST["cambiar-estado"]) && $_SESSION['user_id'] == 1){
        $sql4 = "SELECT estado FROM pedidos WHERE id=" . $_POST["cambiar-estado"];
        $result2 = $conn->query($sql4);
        $row2 = $result2->fetch_assoc();

        if($row2["estado"] == "No listo"){
            $estado = "Listo";
        }else{
            $estado = "No listo";
        }

        $sql2 = "UPDATE pedidos SET estado='" . $estado . "' WHERE id=" . $_POST["cambiar-estado"];
        if ($conn->query($sql2) === TRUE) {
            $message2 = "Se ha cambiado el estado del pedido";
        }else{
            $message2 = "Hubo un error cambiando el estado del pedido";
        }
    }

//Mostrar los pedidos
    if($_SESSION['user_id'] != 1){
        $sql3 = "SELECT id, tipo, cantidad, diametroA, diametroR, diametroEI, longitudL, espacio, enrollamiento, descripcion, estado FROM pedidos WHERE usuario=" . $_SESSION['user_id'];
    }else{
        $sql3 = "SELECT id, tipo, cantidad, diametroA, diametroR, diametroEI, longitudL, espacio, enrollamiento, descripcion, estado FROM pedidos";
    }
    
    $result = $conn->query($sql3);
    
    $id = $_SESSION['user_id'];

    $idArr = [];
    $tipoArr = [];
    $cantidadArr = [];
    $diametroAArr = [];
    $diametroRArr = [];
    $diametroEIArr = [];
    $longitudLArr = [];
    $espacioArr = [];
    $enrollamientoArr = [];
    $descripcionArr = [];
    $estadoArr = [];
    
    while ($row = $result->fetch_assoc()) {
        $idArr[] = $row["id"];
        $tipoArr[] = $row["tipo"];
        $cantidadArr[] = $row["cantidad"];
        $diametroAArr [] = $row["diametroA"];
        $diametroRArr [] = $row["diametroR"];
        $diametroEIArr [] = $row["diametroEI"];
        $longitudLArr [] = $row["longitudL"];
        $espacioArr [] = $row["espacio"];
        $enrollamientoArr [] = $row["enrollamiento"];
        $descripcionArr[] = $row["descripcion"];
        $estadoArr[] = $row["estado"];
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
    <link rel="stylesheet" href="css/pedidos.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script defer src="js/index.js"></script>
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
                        <a href="pedidos.php" class="nav-menu-link nav-link nav-menu-link_active">Pedidos</a>
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
    <!-- <div class="pedido-div">
        <p class="pedido-atributo">Tipo: </p>
        <p class="pedido-atributo">Cantidad: </p>
        <p class="pedido-atributo">Medida: </p>
        <p class="pedido-atributo">Vueltas: </p>
        <p class="pedido-atributo">Descripción: </p>
        <p class="pedido-atributo">Estado: </p>
    </div> -->
    
    <div class="pedido-container">
    <?php

    if (isset($message)) {
        echo '<p class="pedido-mensaje">' . $message . '</p>';
    }

    if (isset($message2)) {
        echo '<p class="pedido-mensaje">' . $message2 . '</p>';
    }

if ($_SESSION['user_id'] != 1) {
 
    if($result->num_rows > 0){
        for ($i=0; $i < count($tipoArr); $i++) { 
            echo '
            <div class="card">
            <form action="pedidos.php" method="post">
                <p class="pedido-atributo">Tipo: '. $tipoArr[$i] .'</p>
                <p class="pedido-atributo">Cantidad: '. $cantidadArr[$i] .'</p>
                <p class="pedido-atributo">Diametro del alambre: '. $diametroAArr[$i] .'</p>
                <p class="pedido-atributo">Diametro del resorte: '. $diametroRArr[$i] .'</p>
                <p class="pedido-atributo">Diametro exterior/interior: '. $diametroEIArr[$i] .'</p>
                <p class="pedido-atributo">Longitud libre: '. $longitudLArr[$i] .'</p>
                <p class="pedido-atributo">Espacio entre vueltas: '. $espacioArr[$i] .'</p>
                <p class="pedido-atributo">Enrollamiento: '. $enrollamientoArr[$i] .'</p>
                <p class="pedido-atributo">Descripción: '. $descripcionArr[$i] .'</p>
                <p class="pedido-atributo">Estado: '. $estadoArr[$i] .'</p>
                <button type="submit" value="'. $idArr[$i] .'" name="eliminar" class="button card-button">Eliminar</button>
            </form>
            </div>';
        }
    }else{
        echo "
        <div class='pedido-div2'>
        <p class='pedidos-p'>No tenés ningún pedido todavía</p>
        <a href='hacerPedido.php' class='pedidos-a'>Hacer pedido</a>
        </div>
        ";
    }
}else{
    if($result->num_rows > 0){
        for ($i=0; $i < count($tipoArr); $i++) { 
            echo '
            <div class="card">
            <form action="pedidos.php" method="post">
                <p class="pedido-atributo">Tipo: '. $tipoArr[$i] .'</p>
                <p class="pedido-atributo">Cantidad: '. $cantidadArr[$i] .'</p>
                <p class="pedido-atributo">Diametro del alambre: '. $diametroAArr[$i] .'</p>
                <p class="pedido-atributo">Diametro del resorte: '. $diametroRArr[$i] .'</p>
                <p class="pedido-atributo">Diametro exterior/interior: '. $diametroEIArr[$i] .'</p>
                <p class="pedido-atributo">Longitud libre: '. $longitudLArr[$i] .'</p>
                <p class="pedido-atributo">Espacio entre vueltas: '. $espacioArr[$i] .'</p>
                <p class="pedido-atributo">Enrollamiento: '. $enrollamientoArr[$i] .'</p>
                <p class="pedido-atributo">Descripción: '. $descripcionArr[$i] .'</p>
                <p class="pedido-atributo">Estado: '. $estadoArr[$i] .'</p>
                <div class="card-button">
                    <button type="submit" value="'. $idArr[$i] .'" name="eliminar" class="button">Eliminar</button>
                    <button type="submit" value="'. $idArr[$i] .'" name="cambiar-estado" class="button">Cambiar estado</button>
                </div>
                
            </form>
            </div>';
        }
    }else{
        echo "
        <div class='pedido-div2'>
        <p class='pedidos-p'>No hay ningún pedido todavía</p>
        </div>
        ";
    }
}
    ?>
    
</div>
    <?php
        require 'partials/footer.php';
    ?>
</body>
</html>