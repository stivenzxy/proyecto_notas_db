<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/notas.css">
  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 70%;
    }

    .sub-content {
      background-color: #fff;
      padding: 20px;
      border:solid 1px #000;
      border-radius: 5px;
    }

    .btn-habilitar {
      background-color: rgba(255, 173, 8, 0.871);
      color: #fff;
      border-radius: 3px;
      text-decoration: none;
      border: none;
      padding: 5px 10px;
    }

    .btn-guardarCambios {
      background-color: rgb(79, 61, 218);
      color: #fff;
      border:none;
      border-radius: 3px;
      text-decoration: none;
      padding: 5px 10px;
    }
  </style>
</head>
<body>
  <h1>Editar Nota</h1>
  
  <?php
  // Obtener el codigo de la nota a editar desde el parámetro de la URL
  $id = $_GET['cod_nota'];

  // Comprobar si se ha enviado el formulario para guardar los cambios
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los valores actualizados del formulario
    $posicion = $_POST['posicion'];
    $descripcion = $_POST['descripcion'];
    $porcentaje = $_POST['porcentaje'];

    // Aquí iría el código PHP para actualizar los datos de la nota en la base de datos
    // Puedes utilizar el ID y los valores actualizados para realizar la actualización

    // Ejemplo de mensaje de éxito
    /*if(si la suma de los campos es ){
      echo '<script>
              alert("error al actualizar, el porcentaje ingresado hace que se sobrepase el 100%");
              location.reload();
            </script>';
    } else {
      echo '<script>
             alert("campos actualizados correctamente!");
             history.go(-2);
           </script>';
    }*/
  }

  // Aquí iría el código PHP para obtener los datos de la nota correspondiente desde la base de datos
  // Puedes utilizar el ID para obtener los datos específicos de la nota

  // Ejemplo de datos de prueba
  $nota = ['posicion' => 1, 'descripcion' => 'Parcial Uno', 'porcentaje' => '30'];
  ?>

  <div class="container">
  <title>Editar Nota</title>
    <div class="sub-content">
      <form method="POST">
        <label for="posicion">Posición:</label>
        <input type="text" id="posicion" name="posicion" value="<?php echo $nota['posicion']; ?>" disabled>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $nota['descripcion']; ?>" disabled>

        <label for="porcentaje">Porcentaje:</label>
        <input type="text" id="porcentaje" name="porcentaje" value="<?php echo $nota['porcentaje']; ?>" disabled>


        <button type="button" class="btn-habilitar" id="btn-habilitar">Habilitar edición</button>
        <button type="submit" class="btn-guardarCambios">Guardar cambios</button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('btn-habilitar').addEventListener('click', function() {
      document.getElementById('posicion').removeAttribute('disabled');
      document.getElementById('descripcion').removeAttribute('disabled');
      document.getElementById('porcentaje').removeAttribute('disabled');
      this.innerText = 'Edición habilitada';
    });
  </script>
</body>
</html>
