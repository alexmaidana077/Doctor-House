<?php

$servidor = "localhost";
$usuario = "root";
$contra = "";
$DbNombre = "cinica";

$conn = new mysqli($servidor, $usuario, $contra, $DbNombre);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_GET['medico_id']) && isset($_GET['fecha'])) {
    $medico_id = $_GET['medico_id'];
    $fecha = $_GET['fecha'];

    // Horarios posibles
    $todosHorarios = ['09:00:00', '09:30:00', '10:00:00', '10:30:00', '11:00:00', '11:30:00', '12:00:00', '12:30:00', '13:00:00', '13:30:00','14:00:00','14:30:00','15:00:00'];

    $query = "SELECT hora FROM turnos WHERE medico_id = ? AND fecha = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $medico_id, $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    $horariosOcupados = [];
    while ($row = $result->fetch_assoc()) {
        $horariosOcupados[] = $row['hora'];
    }

    // Filtrar horarios disponibles
    $horariosDisponibles = array_diff($todosHorarios, $horariosOcupados);

    echo json_encode(array_values($horariosDisponibles));
    $stmt->close();
    $conn->close();
}
?>
