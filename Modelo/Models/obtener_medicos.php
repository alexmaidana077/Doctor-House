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

if (isset($_GET['especialidad'])) {
    $especialidad = $conn->real_escape_string($_GET['especialidad']);
    
    $query = "SELECT dni, nombre, apellido FROM medicos WHERE especialidad = '$especialidad'";
    $result = $conn->query($query);

    $medicos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $medicos[] = $row;
        }
    }

    echo json_encode($medicos);
}

$conn->close();
?>
