<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $contrasena = $_POST["contrasena"];

    // Verificar si el token existe y no ha expirado
    $sql = "SELECT id FROM usuarios WHERE token = '$token' AND token_expiracion > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $usuario_id = $result->fetch_assoc()["id"];

        // Actualizar la contraseña en la base de datos
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql_update = "UPDATE usuarios SET password = '$hashed_password', token = NULL, token_expiracion = NULL WHERE id = $usuario_id";
        $conn->query($sql_update);

        echo "Contraseña actualizada exitosamente. Ahora puedes iniciar sesión con tu nueva contraseña.";
    } else {
        echo "El enlace para restablecer la contraseña ha expirado o no es válido. Por favor, solicita uno nuevo.";
    }
}
?>
