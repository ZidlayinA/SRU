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

if ($usuario['rol'] !== 'usuario') {
    header('Location: dashboard_admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard del Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style type="text/css">
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

header, main, footer {
  padding: 20px;
}

header {
  background-color: #333;
  color: #fff;
  text-align: center;
}

h1 {
  margin: 0;
}

nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

nav li {
  display: inline-block;
  margin-right: 20px;
}

nav a {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
}

main {
  max-width: 800px;
  margin: 0 auto;
}

section {
  margin-bottom: 20px;
}

ul {
  list-style-type: disc;
  padding-left: 20px;
}

button {
  cursor: pointer;
}

footer {
  background-color: #f2f2f2;
  text-align: center;
  position: fixed;
  bottom: 0;
  width: 100%;
}

/* Estilos para testimonios */
.testimonial {
  border: 1px solid #ddd;
  padding: 10px;
  margin-bottom: 20px;
}

.testimonial p {
  margin: 0;
}

.testimonial em {
  font-style: italic;
}

</style>
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
                <h1>Bienvenido Usuario</h1>
                <!-- Aquí puedes agregar contenido específico para el usuario -->
            </div>
        </div>
        <!DOCTYPE html>
<html>
<head>
  <title>Aseguradora de Autos</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Bienvenido a nuestra aseguradora de autos</h1>
    <nav>
      <ul>
        <li><a href="#cotizacion">Cotización</a></li>
        <li><a href="#tipos-seguros">Tipos de Seguros</a></li>
        <li><a href="#descuentos">Descuentos</a></li>
        <li><a href="#testimonios">Testimonios</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="cotizacion">
      <h2>Cotización de Seguro de Auto</h2>
      <p>Completa el siguiente formulario para obtener una cotización personalizada:</p>
      <form>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="modelo">Modelo de Auto:</label>
        <input type="text" id="modelo" name="modelo" required>
        
        <label for="anio">Año del Auto:</label>
        <input type="number" id="anio" name="anio" min="1900" max="2023" required>
        
        <!-- Otros campos del formulario -->
        
        <button type="submit" class="btn btn-primary">Obtener Cotización</button>
      </form>
    </section>

    <section id="tipos-seguros">
      <h2>Tipos de Seguros de Auto</h2>
      <p>Descubre nuestras diferentes opciones de cobertura:</p>
      <ul>
        <li>Responsabilidad Civil: Cobertura básica para daños a terceros.</li>
        <li>Cobertura contra Daños Propios: Cubre los daños a tu vehículo en caso de accidente.</li>
        <li>Cobertura contra Robo: Protege tu auto ante el robo o hurto.</li>
        <li>Cobertura de Daños a Terceros Ampliada: Amplía la responsabilidad civil a daños materiales y lesiones.</li>
        <!-- Otros tipos de seguros disponibles -->
      </ul>
    </section>

    <section id="descuentos">
      <h2>Descuentos y Promociones</h2>
      <p>Aprovecha nuestros descuentos para ahorrar en tu seguro de auto:</p>
      <ul>
        <li>Descuento por Buen Conductor: Si no has tenido accidentes en los últimos años.</li>
        <li>Descuento por Pólizas Múltiples: Si aseguras más de un vehículo con nosotros.</li>
        <li>Descuento por Pago Anual: Obtén un descuento adicional al pagar tu póliza anualmente.</li>
        <!-- Otros descuentos disponibles -->
      </ul>
    </section>

    <section id="testimonios">
      <h2>Testimonios de Clientes</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="testimonial">
            <p>"Estoy muy satisfecho con el servicio de la aseguradora. Resolvieron mi reclamación rápidamente y sin complicaciones."</p>
            <p><em>- Juan Pérez</em></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="testimonial">
            <p>"La cobertura contra robo me ha salvado en dos ocasiones. Recomiendo esta aseguradora a todos mis amigos."</p>
            <p><em>- María Gómez</em></p>
          </div>
        </div>
      </div>
      <!-- Otros testimonios de clientes -->
    </section>

    <section id="conversor">
      <h2>Conversor de Dólar a Peso</h2>
      <p>Ingresa el monto en dólares para convertirlo a pesos:</p>
      <label for="monto-dolar">Monto en Dólar:</label>
      <input type="number" id="monto-dolar" min="0" step="0.01" required>
      <button type="button" class="btn btn-primary" onclick="convertirADolar()">Convertir</button>
      <p id="resultado-conversion"></p>
    </section>

    <section id="reloj">
      <h2>Reloj en tiempo real</h2>
      <p id="hora-actual"></p>
    </section>
  </main>

  <footer id="contacto">
    <p>Contacto: 1-800-SEG-AUTO | Correo: info@aseguradoradeautos.com</p>
  </footer>

  <script src="scripts.js"></script>
</body>
</html>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
