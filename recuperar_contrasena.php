<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Recuperar Contraseña</h5>
                        <form action="enviar_correo.php" method="post">
                            <div class="form-group">
                                <label for="email">Correo Electrónico:</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Recuperar Contraseña</button>
                        </form>
                        <p class="mt-3 mb-0 text-center">¿Recordaste tu contraseña? <a href="login.php">Inicia Sesión</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
