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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar entradas
    $medico_id = filter_var($_POST['medico_id'], FILTER_VALIDATE_INT);
    $fecha = filter_var($_POST['fecha'], FILTER_SANITIZE_STRING);
    $horario = filter_var($_POST['horario'], FILTER_SANITIZE_STRING);
    $paciente_dni = filter_var($_POST['dni'], FILTER_VALIDATE_INT);
    $especialidad = filter_var($_POST['especialidad'], FILTER_SANITIZE_STRING);

    if (!$medico_id || !$fecha || !$horario || !$paciente_dni || !$especialidad) {
        die("Datos inválidos o incompletos.");
    }

    // Verificar si el paciente ya tiene un turno en la misma fecha
    $query = "SELECT * FROM turnos WHERE paciente_dni = ? AND fecha = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $paciente_dni, $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Ya tienes un turno reservado para esta fecha. No puedes pedir otro turno el mismo día.";
    } else {
        // Verificar si el médico ya tiene 10 turnos en la misma fecha
        $query = "SELECT COUNT(*) AS total_turnos FROM turnos WHERE medico_id = ? AND fecha = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $medico_id, $fecha);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['total_turnos'] >= 10) {
            echo "Ya no tiene turnos disponibles para ese dia.";
        } else {
            // Verificar si el horario está ocupado para el médico
            $query = "SELECT * FROM turnos WHERE medico_id = ? AND fecha = ? AND hora = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iss", $medico_id, $fecha, $horario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "El médico no está disponible en este horario. Por favor, elige otro.";
            } else {
                // Insertar turno
                $insert_query = "INSERT INTO turnos (medico_id, paciente_dni, especialidad, fecha, hora) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param("iisss", $medico_id, $paciente_dni, $especialidad, $fecha, $horario);

                if ($stmt->execute()) {
                    echo "Turno registrado exitosamente.";
                } else {
                    echo "Error al registrar el turno: " . $stmt->error;
                }
            }
        }
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método no permitido.";
}
?>
