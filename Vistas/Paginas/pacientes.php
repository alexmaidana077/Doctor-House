<?php
session_start();

// Verificar que el usuario esté autenticado y sea un médico
if (!isset($_SESSION['email']) || $_SESSION['rol'] !== 'medicos') {
    header("Location: ../../Vistas/Paginas/login.html");
    exit();
}

// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contra = "";
$DbNombre = "cinica";

$conn = new mysqli($servidor, $usuario, $contra, $DbNombre);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del médico desde la base de datos usando su email
$email_medico = $_SESSION['email'];
$query_medico = "SELECT dni FROM medicos WHERE email = ?";
$stmt_medico = $conn->prepare($query_medico);
$stmt_medico->bind_param("s", $email_medico);
$stmt_medico->execute();
$stmt_medico->bind_result($medico_id);
$stmt_medico->fetch();
$stmt_medico->close();

if (!$medico_id) {
    die("No se pudo identificar al médico.");
}

// Procesar la fecha seleccionada (por defecto, hoy)
$fecha = isset($_GET['fecha']) ? filter_var($_GET['fecha'], FILTER_SANITIZE_STRING) : date('Y-m-d');

// Consulta para obtener los turnos del médico en la fecha especificada
$query_turnos = "
    SELECT 
        t.paciente_dni,
        u.nombre AS nombre_paciente,
        u.apellido AS apellido_paciente,
        t.hora,
        t.especialidad
    FROM turnos t
    JOIN paciente u ON t.paciente_dni = u.dni
    WHERE t.medico_id = ? AND t.fecha = ?
    ORDER BY t.hora ASC
";

$stmt_turnos = $conn->prepare($query_turnos);
$stmt_turnos->bind_param("is", $medico_id, $fecha);
$stmt_turnos->execute();
$result = $stmt_turnos->get_result();

// Mostrar los resultados en un listado
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Pacientes a cargo para el día: <?= htmlspecialchars($fecha) ?></h1>
        <form method="get" class="mb-4">
            <label for="fecha">Seleccionar fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars($fecha) ?>" required>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Hora</th>
                        <th>Especialidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['paciente_dni']) ?></td>
                            <td><?= htmlspecialchars($row['nombre_paciente']) ?></td>
                            <td><?= htmlspecialchars($row['apellido_paciente']) ?></td>
                            <td><?= htmlspecialchars($row['hora']) ?></td>
                            <td><?= htmlspecialchars($row['especialidad']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-warning">No hay pacientes registrados para esta fecha.</p>
        <?php endif; ?>

        <a href="../../index.php" class="btn btn-secondary">Volver al inicio</a>
    </div>
</body>

</html>
<?php
$stmt_turnos->close();
$conn->close();
?>
