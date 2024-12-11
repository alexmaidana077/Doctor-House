<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cinica";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recoger los datos enviados por el formulario
    $dni = $conn->real_escape_string($_POST['dni']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $contra = $conn->real_escape_string($_POST['contra']);
    $email = $conn -> real_escape_string($_POST ['email']);
    $telefono = $conn -> real_escape_string ($_POST['telefono']);

     if (empty($dni) || empty($nombre) || empty($apellido) || empty($contra) || empty($email) || empty($telefono)) {
        echo "Todos los campos son obligatorios.";
    } else {
        $contraHash = password_hash($contra, PASSWORD_BCRYPT);

    $sql = "INSERT INTO paciente(dni, nombre, apellido, contra, email, telefono) 
            VALUES ('$dni', '$nombre', '$apellido', '$contraHash','$email', '$telefono')";

            if($conn->query($sql) === TRUE){
                echo "<script>window.location.href = '../../Vistas/Paginas/login.html';</script>";
            }
            else{
                echo "Error en el usuario y/o contraseña para continuar";
            }   
        }
    }
?>