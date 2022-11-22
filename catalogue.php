<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        $sesion = 0;
    }else{
        $sesion = $_SESSION['user_id'];
    }

    require 'database.php';

    if(isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["foto"]) && ($_POST["foto"] != "") && isset($_POST["diametroA"]) && isset($_POST["diametroR"]) && isset($_POST["diametroEI"]) && isset($_POST["espacio"]) && isset($_POST["enrollamiento"]) && $sesion == 1){
        $sql = "INSERT INTO catalogo (nombre, descripcion, diametroA, diametroR, diametroEI, espacio, enrollamiento, foto) VALUES ('" . $_POST["nombre"] . "','" . $_POST["descripcion"] . "','" . $_POST["diametroA"] . "','" . $_POST["diametroR"] . "','" . $_POST["diametroEI"] . "','" . $_POST["espacio"] . "','" . $_POST["enrollamiento"] . "','" . $_POST["foto"] . "')";
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Item creado satisfactoriamente";
        }else{
            $mensaje = "Hubo un error creando el item";
        }
    }else if(isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["diametroA"]) && isset($_POST["diametroR"]) && isset($_POST["diametroEI"]) && isset($_POST["espacio"]) && isset($_POST["enrollamiento"]) && $sesion == 1){
        $sql = "INSERT INTO catalogo (nombre, descripcion, diametroA, diametroR, diametroEI, espacio, enrollamiento, foto) VALUES ('" . $_POST["nombre"] . "','" . $_POST["descripcion"] . "','" . $_POST["diametroA"] . "','" . $_POST["diametroR"] . "','" . $_POST["diametroEI"] . "','" . $_POST["espacio"] . "','" . $_POST["enrollamiento"] . "','" . "img/catalogo/default.png')";
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Item creado satisfactoriamente";
        }else{
            $mensaje = "Hubo un error creando el item";
        }
    }

    if(isset($_POST["eliminar"]) && $sesion == 1){
        $sql = "DELETE FROM catalogo WHERE id=" . $_POST["eliminar"];
        if($conn->query($sql) === TRUE){
            $mensaje = "Item eliminado satisfactoriamente";
        }else{
            $mensaje = "Hubo un error al eliminar el item";
        }
    }

    $sql = "SELECT id, nombre, descripcion, diametroA, diametroR, diametroEI, espacio, enrollamiento, foto FROM catalogo";
    
    $results = $conn->query($sql);

    $idArr = [];
    $nombreArr = [];
    $descripcionArr = [];
    $diametroAArr = [];
    $diametroRArr = [];
    $diametroEIArr = [];
    $espacioArr = [];
    $enrollamientoArr = [];
    $fotoArr = [];

    while($row = $results->fetch_assoc()){
        $idArr[] = $row["id"];
        $nombreArr[] = $row["nombre"];
        $descripcionArr[] = $row["descripcion"];
        $diametroAArr [] = $row["diametroA"];
        $diametroRArr [] = $row["diametroR"];
        $diametroEIArr [] = $row["diametroEI"];
        $espacioArr [] = $row["espacio"];
        $enrollamientoArr [] = $row["enrollamiento"];
        $fotoArr[] = $row["foto"];
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
    <link rel="stylesheet" href="css/catalogo.css">
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
                    <a href="catalogue.php" class="nav-menu-link nav-link nav-menu-link_active">Catálogo</a>
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
<div class="catalogo-container">
    <?php
    if(isset($mensaje)){
        echo "<p class='catalogo-vacio'>" . $mensaje ."</p>";
    }
        if($sesion == 1){
            echo '
            <form action="catalogue.php" method="post" class="catalogo-form">
                <label for="">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="input">

                <label for="">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion" class="input">

                <label for="diametroA">Diametro del alambre</label>
                <input type="number" name="diametroA" id="diametroA" class="input">

                <label for="diametroR">Diametro del resorte</label>
                <input type="number" name="diametroR" id="diametroR" class="input">

                <label for="diametroEI">Diametro interior</label>
                <input type="number" name="diametroEI" id="diametroEI" class="input">

                <label for="espacio">Espacio entre vueltas</label>
                <input type="number" name="espacio" id="espacio" class="input">

                <label for="enrollamiento">Enrollamiento</label>
                <select name="enrollamiento" id="enrollamiento" class="input">
                    <option value="Derecha">Derecha</option>
                    <option value="Izquierda">Izquierda</option>
                </select>

                <label for="">Link de la foto:</label>
                <input type="text" name="foto" id="foto" class="input">

                <button type="submit" class="button" style="margin-bottom:2rem;">Enviar</button>
            </form>
            ';
        }
        
    if ($results->num_rows <= 0) {
        echo "<p class='catalogo-vacio'>No hay nada en el catálogo todavía...</p>";
    }else{

        if ($sesion != 1) {
            for ($i=0; $i < count($idArr); $i++) { 
                echo '
                <div class="card">
                    <img src="' . $fotoArr[$i] . '" alt="imagen" class="catalogo-img">
                    <p class="catalogo-p-nombre">' . $nombreArr[$i] . '</p>
                    <p class="catalogo-p-nombre">' . $descripcionArr[$i] . '</p>
                    <p class="catalogo-p">Diametro del alambre: ' . $diametroAArr[$i] . '</p>
                    <p class="catalogo-p">Diametro del resorte: ' . $diametroRArr[$i] . '</p>
                    <p class="catalogo-p">Diametro interior: ' . $diametroEIArr[$i] . '</p>
                    <p class="catalogo-p">Espacio entre vueltas: ' . $espacioArr[$i] . '</p>
                    <p class="catalogo-p">Enrollamiento: ' . $enrollamientoArr[$i] . '</p>
                </div>
                ';
            }
        }else{
            for ($i=0; $i < count($idArr); $i++) { 
                echo '
                <div class="card">
                <form action="catalogue.php" method="post">
                    <img src="' . $fotoArr[$i] . '" alt="imagen" class="catalogo-img">
                    <p class="catalogo-p-nombre">' . $nombreArr[$i] . '</p>
                    <p class="catalogo-p-nombre">' . $descripcionArr[$i] . '</p>
                    <p class="catalogo-p">Diametro del alambre: ' . $diametroAArr[$i] . '</p>
                    <p class="catalogo-p">Diametro del resorte: ' . $diametroRArr[$i] . '</p>
                    <p class="catalogo-p">Diametro interior: ' . $diametroEIArr[$i] . '</p>
                    <p class="catalogo-p">Espacio entre vueltas: ' . $espacioArr[$i] . '</p>
                    <p class="catalogo-p">Enrollamiento: ' . $enrollamientoArr[$i] . '</p>
                    <button type="submit" name="eliminar" value="' . $idArr[$i] . '" class="button card-button">Eliminar</button>
                </form>
                </div>
                ';
            }
            
        }
        
    }
    ?>
</div>

    <?php
        require 'partials/footer.php';
    ?>

</body>
</html>