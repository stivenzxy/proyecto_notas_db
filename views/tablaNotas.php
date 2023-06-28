<?php
session_start();

if (isset($_GET['cod_curso'])) {
    unset($_SESSION['cod_curso']);
    $_SESSION['cod_curso'] = $_GET['cod_curso'];
    //var_dump($_SESSION['cod_curso']);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Gestión de Notas</title>
  <link rel="stylesheet" type="text/css" href="../css/notas.css">
</head>
<body>
  <div class="container">
  <h1>CREAR NOTAS DE CURSO</h1>
  <button class="back-button" id="back-button"><a style="text-decoration:none; color:#fff;" href="tablaCursos.php">Volver</a></button>
  <div class="notas-table">
    <table>
      <thead>
        <tr>
          <th>Posición</th>
          <th>Descripción</th>
          <th>Porcentaje</th>
          <th>Editar</th>
          <th>Borrar</th>
          <th>Registrar</th>
        </tr>
      </thead>
      <tbody id="tablaNotas">
        <?php
        // Aquí iría el código PHP para obtener los datos de la base de datos
        // y generar las filas de la tabla dinámicamente
        require_once("../controllers/mostrarNotasController.php");
        // Ejemplo de datos de prueba
        $class = new MostrarNotas();
        $listado = $class->mostrarListado();
        foreach ($listado as $nota) {
          echo '<tr>';
          echo '<td>' . $nota['posicion'] . '</td>';
          echo '<td>' . $nota['descripcion'] . '</td>';
          echo '<td>' . $nota['porcentaje'] . '</td>';
          echo '<td><a class="btn-editar" href="agregarNota.php?id=' . $nota['posicion'] . '">Editar</a></td>';
          echo '<td><a class="btn-borrar" href="borrar.php?id=' . $nota['posicion'] . '">Borrar</a></td>';
          echo '<td><a class="btn-registrar" href="calificaciones.php?id=' . $nota['posicion'] . '">Registrar</a></td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
    <a href="agregarNota.php" class="btn-agregar-nota">Agregar Nota</a>
  </div>
  </div>
</body>
</html>
