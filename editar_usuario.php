<?php
include('config.php');
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT rol FROM usuarios WHERE id='$usuario_id' LIMIT 1";
$result = mysqli_query($conn, $query);
$usuario = mysqli_fetch_assoc($result);

if ($usuario['rol'] !== 'administrador') {
    header('Location: dashboard_usuario.php');
    exit();
}

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    $sql = "SELECT id, nombre, email, modelo_carro, marca FROM usuarios WHERE id='$id_usuario'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit();
    }
} else {
    echo "ID de usuario no especificado.";
    exit();
}

// Actualizar usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    $id_usuario = $_POST["id_usuario"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $modelo_carro = $_POST["modelo_carro"];
    $marca = $_POST["marca"];

    $sql_actualizar = "UPDATE usuarios SET nombre='$nombre', email='$email', modelo_carro='$modelo_carro', marca='$marca' WHERE id='$id_usuario'";
    if ($conn->query($sql_actualizar) === TRUE) {
        header('Location: dashboard_admin.php');
        exit();
    } else {
        echo "Error al actualizar el usuario: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Seguro Autos</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_admin.php">Volver al Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Editar Usuario</h1>
                <form method="post" action="">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id']; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $usuario['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="modelo_carro">Modelo de Carro:</label>
                        <input type="text" class="form-control" name="modelo_carro" value="<?php echo $usuario['modelo_carro']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="marca">Marca:</label>
                        <input type="text" class="form-control" name="marca" value="<?php echo $usuario['marca']; ?>" required>
                    </div>
                    <button type="submit" name="actualizar" class="btn btn-primary">Actualizar Usuario</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
