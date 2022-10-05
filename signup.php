<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

    <form action="index.php" method="POST">
        <label for="username">Nombre de usuario</label>
        <input type="text" name="username">
        <label for="password">Contraseña</label>
        <input type="password" name="password">
        <label for="password-confirmation">Confirmar contraseña</label>
        <input type="password" name="password-confirmation">
        <input type="submit" value="Crear Cuenta">
    </form>

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