<?php
// Conectar a la base de datos y otras configuraciones
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Verificar si el correo electrónico está registrado en la base de datos
    $sql = "SELECT id, nombre FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $usuario_id = $row["id"];
        $usuario_nombre = $row["nombre"];

        // Generar un token aleatorio y establecer la expiración del token
        $token = bin2hex(random_bytes(32));
        $token_expiracion = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Guardar el token y su expiración en la base de datos
        $sql_update = "UPDATE usuarios SET token = '$token', token_expiracion = '$token_expiracion' WHERE id = $usuario_id";
        $conn->query($sql_update);

        // Enviar el correo electrónico con el enlace para restablecer la contraseña
        $mensaje = "Hola $usuario_nombre,\n\nPara restablecer tu contraseña, haz clic en el siguiente enlace:\n\n";
        $mensaje .= "http://tudominio.com/restablecer_contrasena.php?token=$token\n\n";
        $mensaje .= "Este enlace expirará en 1 hora.\n\n";
        $mensaje .= "Si no solicitaste restablecer tu contraseña, ignora este mensaje.\n\n";
        $mensaje .= "¡Gracias!";
        mail($email, "Recuperar Contraseña", $mensaje);

        echo "Se ha enviado un enlace al correo electrónico proporcionado. Por favor, revisa tu bandeja de entrada.";
    } else {
        echo "El correo electrónico ingresado no está registrado en el sistema.";
    }
}
?>
