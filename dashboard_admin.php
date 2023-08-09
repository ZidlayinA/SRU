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

// Obtener lista de usuarios
$sql = "SELECT id, nombre, email, modelo_carro, marca FROM usuarios WHERE rol='usuario'";
$resultado = $conn->query($sql);

// Eliminar usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $id_usuario = $_POST["id_usuario"];

    $sql_eliminar = "DELETE FROM usuarios WHERE id='$id_usuario'";
    if ($conn->query($sql_eliminar) === TRUE) {
        header('Location: dashboard_admin.php');
        exit();
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }
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
    <title>Dashboard del Administrador</title>
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
                    <a class="nav-link" href="logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

   <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Lista de Usuarios</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Modelo de Carro</th>
                        <th>Marca</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $fila['nombre'] . '</td>';
                        echo '<td>' . $fila['email'] . '</td>';
                        echo '<td>' . $fila['modelo_carro'] . '</td>';
                        echo '<td>' . $fila['marca'] . '</td>';
                        echo '<td>';
                        echo '<a href="editar_usuario.php?id=' . $fila['id'] . '" class="btn btn-sm btn-primary">Actualizar</a>';
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="id_usuario" value="' . $fila['id'] . '">';
                        echo '<button type="submit" name="eliminar" class="btn btn-sm btn-danger">Eliminar</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
