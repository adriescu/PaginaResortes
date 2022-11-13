<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }

    if ($_SESSION['user_id'] == 1) {
        header('Location: index.php');
    }

    $message = '';

    require 'database.php';

    if (!empty($_POST['tipo']) && !empty($_POST['cantidad']) && !empty($_POST['medida']) && !empty($_POST['vueltas'])) {
        $stmt = $conn->prepare("INSERT INTO pedidos (usuario, tipo, cantidad, medida, vueltas, descripcion, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiiiss", $usuario, $tipo, $cantidad, $medida, $vueltas, $descripcion, $estado);

        $usuario = $_SESSION['user_id'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $medida = $_POST['medida'];
        $vueltas = $_POST['vueltas'];
        $descripcion = $_POST['descripcion'];
        $estado = "No listo";
        
        if($stmt->execute()){
            $message = 'Pedido procesado con éxito';
        } else {
            $message = 'Hubo un error procesando tu pedido';
        }
        
    }else if(!empty($_POST['tipo']) || !empty($_POST['cantidad']) || !empty($_POST['medida']) || !empty($_POST['vueltas'])){
        $message = 'Por favor complete todos los datos';
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
                    <a href="hacerPedido.php" class="nav-menu-link nav-link nav-menu-link_active">Hacer pedido</a>
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

    <?php if (!empty($message)) : ?>
        <p class="mensaje"> <?= $message ?></p>
    <?php endif; ?>


<div class="formularioPedido">
    <form action="hacerPedido.php" method="POST">
        <label for="tipoDeResorte">Tipo</label>
        <select name="tipo" id="tipoDeResorte">
            <?php
                //acá va el código :)
            ?>
            <option value="personalizado">Personalizado</option>
        </select>
        <label for="cantidad">Canatidad</label>
        <input type="number" name="cantidad" id="cantidad">
        <label for="medida">Medida</label>
        <input type="number" name="medida" id="medida">
        <label for="vueltas">Número de vueltas</label>
        <input type="number" name="vueltas" id="vueltas">
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