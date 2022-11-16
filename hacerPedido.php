<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }

    if ($_SESSION['user_id'] == 1) {
        header('Location: pedidos.php');
    }

    $message = '';

    require 'database.php';

    if (!empty($_POST['tipo']) && !empty($_POST['cantidad']) && !empty($_POST['diametroA']) && !empty($_POST['diametroR']) && !empty($_POST['diametroR']) && !empty($_POST['diametroEI']) && !empty($_POST['longitudL']) && !empty($_POST['espacio']) && !empty($_POST['enrollamiento'])){
        $stmt = $conn->prepare("INSERT INTO pedidos (usuario, tipo, cantidad, diametroA, diametroR, diametroEI, longitudL, espacio, enrollamiento, descripcion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiiiiiisss", $usuario, $tipo, $cantidad, $diametroA, $diametroR, $diametroEI, $longitudL, $espacio, $enrollamiento, $descripcion, $estado);

        $usuario = $_SESSION['user_id'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $diametroA = $_POST['diametroA'];
        $diametroR = $_POST['diametroR'];
        $diametroEI = $_POST['diametroEI'];
        $longitudL = $_POST['longitudL'];
        $espacio = $_POST['espacio'];
        $enrollamiento = $_POST['enrollamiento'];
        $descripcion = $_POST['descripcion'];
        $estado = "No listo";
        
        if($stmt->execute()){
            $message = 'Pedido procesado con éxito';
        } else {
            $message = 'Hubo un error procesando tu pedido';
        }
        
    }else if(!empty($_POST['tipo']) || !empty($_POST['cantidad']) || !empty($_POST['diametroA']) || !empty($_POST['diametroR']) || !empty($_POST['diametroR']) || !empty($_POST['diametroEI']) || !empty($_POST['longitudL']) || !empty($_POST['espacio']) || !empty($_POST['enrollamiento'])){
        $message = 'Por favor complete todos los datos';
    }

    $tiposDeResorte = [];

    $sql = "SELECT nombre FROM catalogo";
    $results = $conn->query($sql);
    while($row = $results->fetch_assoc()){
        $tiposDeResorte[] = $row["nombre"];
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
    <link rel="stylesheet" href="css/hacerPedidos.css">
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
                    <a href="hacerPedido.php" class="nav-menu-link nav-link nav-menu-link_active">Hacer pedido</a>
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
                        <a href="login.php" class="nav-menu-link nav-link">Iniciar Sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <?php if (!empty($message)) : ?>
        <p class="mensaje"> <?= $message ?></p>
    <?php endif; ?>


<div class="formularioPedido">
    <form action="hacerPedido.php" method="POST">
        <label for="tipoDeResorte">Tipo</label>
        <select name="tipo" id="tipoDeResorte">
            <?php
                for ($i=0; $i < count($tiposDeResorte); $i++) { 
                    echo '<option value="' . $tiposDeResorte[$i] . '">' . $tiposDeResorte[$i] .'</option>';
                }
            ?>
            <option value="Personalizado">Personalizado</option>
        </select>
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad">
        
        <label for="diametroA">Diametro del alambre</label>
        <input type="number" name="diametroA" id="diametroA">

        <label for="diametroR">Diametro del resorte</label>
        <input type="number" name="diametroR" id="diametroR">

        <label for="diametroEI">Diametro exterior/interior</label>
        <input type="number" name="diametroEI" id="diametroEI">

        <label for="longitudL">Longitud libre</label>
        <input type="number" name="longitudL" id="longitudL">

        <label for="espacio">Espacio entre vueltas</label>
        <input type="number" name="espacio" id="espacio">

        <label for="enrollamiento">Enrollamiento</label>
        <select name="enrollamiento" id="enrollamiento">
            <option value="Derecha">Derecha</option>
            <option value="Izquierda">Izquierda</option>
        </select>

        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion">

        <input type="submit" value="Enviar pedido" id="boton">
    </form>
</div>

    <?php
        require 'partials/footer.php';
    ?>

</body>
</html>