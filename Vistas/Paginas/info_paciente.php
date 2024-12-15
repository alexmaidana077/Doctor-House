<?php
// Configuración de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinica";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar información del paciente (puedes filtrar por DNI o mostrar todos)
$dni = isset($_GET['dni']) ? intval($_GET['dni']) : null;
$sql = $dni ? "SELECT * FROM paciente WHERE dni = $dni" : "SELECT * FROM paciente LIMIT 1";
$result = $conn->query($sql);

// Verificar si se encontró algún resultado
$paciente = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información del Paciente</title>
  <link rel="shortcut icon" type="image/x-icon" href="../Estilos/log.png">
  <link rel="stylesheet" href="../Estilos/info.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="../Estilos/log.png" alt="Logo">
    </div>
    <nav>
      <ul>
        <li><a href="#">Turnos</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="container">
      <h1>Información del Paciente</h1>
      <div class="info">
        <?php if ($paciente): ?>
          <div class="column">
            <p><strong>Nombre/s:</strong> <?= htmlspecialchars($paciente['nombre']) ?></p>
            <p><strong>Apellido/s:</strong> <?= htmlspecialchars($paciente['apellido']) ?></p>
            <p><strong>N° DNI:</strong> <?= htmlspecialchars($paciente['dni']) ?></p>
          </div>
          <div class="column">
            <p><strong>Email:</strong> <?= htmlspecialchars($paciente['email']) ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($paciente['telefono']) ?></p>
          </div>
        <?php else: ?>
          <p>No se encontró información del paciente.</p>
        <?php endif; ?>
      </div>
      <div class="button-container">
        <button class="btn">Modificar</button>
      </div>
    </div>
  </main>
</body>
</html>
<?php
$conn->close();
?>
