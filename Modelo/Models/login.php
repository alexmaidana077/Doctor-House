<?php
session_start();

$servidor = "localhost";
$usuario = "root";
$contra = "";
$DbNombre = "cinica";

$conn = new mysqli($servidor, $usuario, $contra, $DbNombre);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $contra = trim($_POST['contra']);

    // Verificar que los campos no estén vacíos
    if (!empty($email) && !empty($contra)) {
        $sql = "
            SELECT 'paciente' AS rol, contra FROM paciente WHERE email = ?
            UNION 
            SELECT 'administrador' AS rol, contra FROM administrador WHERE email = ?
            UNION
            SELECT 'medicos' AS rol, contra FROM medicos WHERE email = ?";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("sss", $email, $email, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($rol, $hashed_password);
            $stmt->fetch();

            if (password_verify($contra, $hashed_password)) {
                $_SESSION['email'] = $email;
                $_SESSION['rol'] = $rol;

                // Redirigir al índice
                header("Location: ../../index.php");
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "No existe una cuenta con ese correo.";
        }

        $stmt->close();
    } else {
        echo "Por favor, complete todos los campos.";
    }
}

$conn->close();
?>
