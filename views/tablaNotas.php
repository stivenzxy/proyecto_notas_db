<!DOCTYPE html>
<html>
<head>
  <title>Gestión de Notas</title>
  <link rel="stylesheet" type="text/css" href="../css/notas.css">
</head>
<body>
  <h1>CREAR NOTAS DE CURSO</h1>
  <button class="back-button" id="back-button"><a style="text-decoration:none; color:#fff;" href="../home.php">Inicio</a></button>
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

        // Ejemplo de datos de prueba
        $notas = [
          ['posicion' => 1, 'descripcion' => 'Parcial Uno', 'porcentaje' => '30'],
          ['posicion' => 2, 'descripcion' => 'Parcial Dos', 'porcentaje' => '40'],
          ['posicion' => 3, 'descripcion' => 'Examen Final', 'porcentaje' => '30'],
        ];

        foreach ($notas as $nota) {
          echo '<tr>';
          echo '<td>' . $nota['posicion'] . '</td>';
          echo '<td>' . $nota['descripcion'] . '</td>';
          echo '<td>' . $nota['porcentaje'] . '</td>';
          echo '<td><a class="btn-editar" href="editarNota.php?id=' . $nota['posicion'] . '">Editar</a></td>';
          echo '<td><a class="btn-borrar" href="borrar.php?id=' . $nota['posicion'] . '">Borrar</a></td>';
          echo '<td><a class="btn-registrar" href="registrar.php?id=' . $nota['posicion'] . '">Registrar</a></td>';
          echo '</tr>';
        }
        ?>
        <tr>
          <td colspan="6">
            <div class="contenedor">
              <form action="" method="POST">
                <input type="hidden" name="cod_cur" value="<?php echo($_POST['cod_cur'])?>">

                <label for="posicion">Posición:</label>
                <input type="text" name="posicion" placeholder="ingrese la posición" required>
                
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" placeholder="ingrese la descripción" required>

                <label for="porcentaje">Porcentaje:</label>
                <input type="text" name="porcentaje" placeholder="ingrese el porcentaje" required>

                <input type="submit" name="submit" class="btn-agregar-nota" value="Agregar Nota">
              </form>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
