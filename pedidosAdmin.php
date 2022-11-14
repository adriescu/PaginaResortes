<?php
    session_start();

    require 'database.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }

    if($_SESSION['user_id'] != 1){
        header('Location: pedidos.php');
    }
    
    $sql = "SELECT id, tipo, cantidad, medida, vueltas, descripcion, estado FROM pedidos";
    // $sql = "SELECT tipo, cantidad, medida, vueltas, descripcion, estado FROM pedidos WHERE usuario=?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("i", $id);
    // $stmt->execute();
    // $result = $stmt->get_result();
    $result = $conn->query($sql);
    
    $id = $_SESSION['user_id'];
    echo $result->num_rows;
    $idArr = [];
    $tipoArr = [];
    $cantidadArr = [];
    $medidaArr = [];
    $vueltasArr = [];
    $descripcionArr = [];
    $estadoArr = [];
    

    


    while ($row = $result->fetch_assoc()) {
        $idArr[] = $row["id"];
        $tipoArr[] = $row["tipo"];
        $cantidadArr[] = $row["cantidad"];
        $medidaArr[] = $row["medida"];
        $vueltasArr[] = $row["vueltas"];
        $descripcionArr[] = $row["descripcion"];
        $estadoArr[] = $row["estado"];
    }
    

    // if ($result->num_rows > 0) {
    //   // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    //     }
    // } else {
    //   echo "0 results";
    // }
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
    for ($i=0; $i < count($tipoArr); $i++) { 
        echo '
        <div class="pedido-div">
        <form action="" method="post">
            <p class="pedido-atributo">Tipo: '. $tipoArr[$i] .'</p>
            <p class="pedido-atributo">Cantidad: '. $cantidadArr[$i] .'</p>
            <p class="pedido-atributo">Medida: '. $medidaArr[$i] .'</p>
            <p class="pedido-atributo">Vueltas: '. $vueltasArr[$i] .'</p>
            <p class="pedido-atributo">Descripción: '. $descripcionArr[$i] .'</p>
            <p class="pedido-atributo">Estado: '. $estadoArr[$i] .'</p>
            <button type="submit" value="'. $idArr[$i] .'" name="eliminar">Eliminar</button>
        </form>
        </div>';
    }
    ?>
</div>
    <?php
        require 'partials/footer.php';
    ?>
</body>
</html>