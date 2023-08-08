<?php
session_start();
include('config.php');

if (isset($_POST['enviar'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT id, password, rol FROM usuarios WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["password"];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['usuario_id'] = $row["id"];
                $_SESSION['rol'] = $row["rol"];

                if ($_SESSION['rol'] === 'administrador') {
                    header('Location: dashboard_admin.php');
                } else {
                    header('Location: dashboard_usuario.php');
                }
                exit();
            } else {
                $error_message = "Credenciales inválidas";
            }
        } else {
            $error_message = "Credenciales inválidas";
        }
    }
}
?>

<?php
include('config.php');

if (isset($_POST['registrar'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $modelo_carro = $_POST["modelo_carro"];
        $marca = $_POST["marca"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $rol = $_POST["rol"];

        $sql = "INSERT INTO usuarios (nombre, email, modelo_carro, marca, password, rol) 
                VALUES ('$nombre', '$email', '$modelo_carro', '$marca', '$password', '$rol')";
        if ($conn->query($sql) === TRUE) {
            header('Location: login.php');
            exit();
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
        <main>

            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                        <button id="btn__registrarse">Regístrarse</button>
                    </div>
                </div>

                <!--Formulario de Login y registro-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <?php
                    if (isset($error_message)) {
                        echo '<div class="alert alert-danger">' . $error_message . '</div>';
                    }
                    ?>
                    <form method="post" action="" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="email" placeholder="Correo Electrónico" name="email" id="email">
                        <input type="password" placeholder="Contraseña" name="password" id="contrasena">
                        <button type="submit" class="btn btn-primary" id="enviar" name="enviar">Entrar</button>
                    </form>

                    <p class="mt-3">¿Olvidaste tu contraseña?<a href="recuperar_contrasena.php" class="btn btn-link">Recuperar Contraseña</a></p>

                    <!--Register-->
                    <form method="post" action="" class="formulario__register">
                        <h2>Regístrarse</h2>
                        <input type="text" placeholder="Nombre completo" name="nombre" id="nombre">
                        <input type="email" placeholder="Correo Electrónico" name="email" id="email">
                        <input type="text" placeholder="Modelo de Carro" name="modelo_carro" id="modelo_carro">
                        <input type="text" placeholder="Marca" name="marca" id="marca">
                        <input type="password" placeholder="Contraseña" name="password" id="password">
                        <br>
                        <br>
                        <select class="form-control" name="rol">
                            <option selected>Rol</option>
                            <option value="usuario">Usuario</option>
                            <option value="administrador">Administrador</option>
                        </select>
                        <button type="submit" name="registrar" id="registrar"> Regístrarse</button>
                    </form>
                </div>
            </div>

        </main>
        <script src="assets/js/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>