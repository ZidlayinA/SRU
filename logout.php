<?php
session_start();
session_destroy();

// Redireccionar a la página de inicio después de cerrar sesión
header('Location: index.php');
exit();
?>
