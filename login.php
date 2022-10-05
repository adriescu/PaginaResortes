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

    <header class="header">
        <nav class="nav">
            <a href="index.php" class="logo nav-link">Resortes</a>
        </nav>
    </header>

    <div class="form-main-container">
        <div class="form-container">
            <form action="index.php" method="POST">
                <label for="username">Nombre de usuario</label><br>
                <input type="text" name="username"><br>
                <label for="password">Contraseña</label><br>
                <input type="password" name="password"><br>
                <input type="submit" value="Iniciar Sesión" id="submit-button">
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
                    <li><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam deleniti quam a inventore, voluptates animi consectetur modi, deserunt consequatur assumenda dignissimos esse enim eveniet eius blanditiis aspernatur ipsam non harum.</p></li>
                    <li><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi quis minima sint placeat laboriosam dicta a tempora optio impedit aperiam ipsum ex doloribus, quod sed maxime numquam repudiandae labore? Rerum?</p></li>
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