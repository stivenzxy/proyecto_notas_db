<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/calificaciones.css">
  <script src="https://kit.fontawesome.com/e562395e64.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
  <title>Tabla de Estudiantes</title>
  <script>
    function habilitarEdicion(inputElement) {
      inputElement.disabled = false;
    }
  </script>
</head>
<body>
  <table class="students-table">
  <h2>Registro de Calificaciones - Fecha: <span id="current_date"></span></h2>
            <script>
            date = new Date();
            year = date.getFullYear();
            month = date.getMonth() + 1;
            day = date.getDate();
            document.getElementById("current_date").innerHTML = day + "/" + month + "/" + year;
            </script>
            <h2>Curso: </h2>
    <thead>
      <tr>
        <th class="codigo">Código</th>
        <th class="nombre">Nombre</th>
        <th class="nota">Nota</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Ejemplo de datos de la base de datos
      $estudiantes = array(
        array("160004725", "JESUS ESTIVEN PEREZ TORRES", 3.4),
        array("160004814", "JHOJAN ANDRES GRISALES MORA", 4.5),
        array("160004613", "HAIDER JOHAN ARANGO", 4.7),
        array("160004600", "JHORMAN ALEXANDER CARRILLO PEREZ", 4.7)
      );

      foreach ($estudiantes as $estudiante) {
        $codigo = $estudiante[0];
        $nombre = $estudiante[1];
        $nota = $estudiante[2];
      ?>
      <tr>
        <td><div class="textTd"><?php echo $codigo; ?></div></td>
        <td><div class="textTd"><?php echo $nombre; ?></div></td>
        <td>
          <div class="nota-container">
            <input type="text" class="nota-input" value="<?php echo $nota; ?>" disabled>
            <div class="acciones-nota">
              <i class="fa-solid fa-pencil-alt editar-nota" onclick="habilitarEdicion(this.parentElement.previousElementSibling)"></i>
              <a href="actualizar.php?codigo=<?php echo $codigo; ?>&nota=<?php echo $nota; ?>"><i class="fa-solid fa-floppy-disk guardar-nota"></i></a>
              <a href="eliminar.php?codigo=<?php echo $codigo; ?>"><i class="fa-solid fa-trash-alt eliminar-nota"></i></a>
            </div>
          </div>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
