<?php
require_once '../../bbdd/bbdd.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="post">
            <h1>Registra un local</h1>
            <div class="form-control">
                <!--Nombre:  <input type="text" name="nombre" <br>-->
                <label>Nombre: </label> <input type="text" name="nombre">
            </div>
            <div>Email: <input type="email" name="email"></div>
            <div>Usuario: <input type="text" name="usuario"></div>
            <div>Contraseña: <input type="password" name="contraseña"></div>
            <div>Ubicacion: <input type="text" name="ubicacion"></div>
            <div>Aforo: <input type="number" name="aforo"></div>
            <div>Imagen: <input type="text" name="imagen"></div>
            <input type="submit" name="register" value="Register"><br>
            <?php
            if (isset($_POST["register"])) {
                $nombre = $_POST["nombre"];
                $email = $_POST["email"];
                $usuario = $_POST["usuario"];
                $contraseña = $_POST["contraseña"];
                $ubicacion = $_POST["ubicacion"];
                $aforo = $_POST["aforo"];
                $imagen = $_POST["imagen"];

                $resultado1 = insertar_localusuario($nombre, $email, $usuario, $contraseña);

                $resultado = insertar_datoslocal($ubicacion, $aforo, $imagen);
                if ($resultado == "ok" && $resultado1 == "ok") {
                    echo "Usuario registrado correctamente";
                    echo "<br><br>";
                } else {
                    echo "Este usuario ya existe, pruebe con otro.";
                }
            }
            ?>
        </form>
    </body>
</html>
