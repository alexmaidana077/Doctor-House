<?php
session_start();   
?>

<!doctype html>
<html lang="en">

<head>
  <title>Cinica salud</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="Vistas/Estilos/styles.css">

</head>
<body>
<header class="encabezado">
  <img src="Vistas/Estilos/log.png" alt="">
  <ul>
  <?php
    if (!isset($_SESSION['email'])) {
        echo '<a href="Vistas/Paginas/registro.html">Registrarse</a>';
        echo '<a href="Vistas/Paginas/login.html">Iniciar Sesión</a>';
    } else {
        echo '<a href="Modelo/Models/logout.php">Cerrar Sesión</a>';
        // Mostrar enlaces según el rol
        if ($_SESSION['rol'] === 'administrador') {
            echo '<a href="Vistas/Paginas/registro_med.html">Registrar Médico</a>';
        } elseif ($_SESSION['rol'] === 'medicos') {
            echo '<a href="Vistas/Paginas/pacientes.php">Turnos</a>';
        } else {
            echo '<a href="Vistas/Paginas/turno.html">Turno</a>';
        }
    }
    ?>
  </ul>
</header>

  <div class="inicio">
    <nav class="menubar">
      <div class="contenido">
        <h1>Clinica</h1>
        <h3>Cinica salud</h3>
        <p>Nosotros somos Cinica salud, una Clinica con mas de 15 años de experiencia en el cuidado de las personas,
          la cual busca lograr mantener a sus pacientes en obtimas condiciones, siempre tratando de cumplir con 
          lo que se espera y poder cuidar a nuestros pacientes.
        </p>
      </div>
    </nav>
  <div class="imagen">
      <div class="marco">
        <img src="Vistas/Estilos/log.png" alt="Logo">
      </div>
    </div>
  </div>

  <main>
  </main>

  <footer>
  </footer>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>