<?php
include('config.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token existe y no ha expirado
    $sql = "SELECT id FROM usuarios WHERE token = '$token' AND token_expiracion > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $usuario_id = $result->fetch_assoc()["id"];

        // Mostrar el formulario para cambiar la contraseña
        echo "<h1>Restablecer Contraseña</h1>";
        echo "<form method='post' action='actualizar_contrasena.php'>";
        echo "<input type='hidden' name='token' value='$token'>";
        echo "<label for='contrasena'>Nueva Contraseña:</label>";
        echo "<input type='password' name='contrasena' required>";
        echo "<button type='submit'>Cambiar Contraseña</button>";
        echo "</form>";
    } else {
        echo "El enlace para restablecer la contraseña ha expirado o no es válido. Por favor, solicita uno nuevo.";
    }
} else {
    echo "No se ha proporcionado un token válido para restablecer la contraseña.";
}
?>
