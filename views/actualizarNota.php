<?php
session_start();
$codigo = $_SESSION['cod_curso'];
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/notas.css">
</head>

<body>
    <div class="contenedor">
        <form action="../controllers/AgregarNotasController.php" method="POST">
            <div class="form-details">
                <input type="hidden" name="cod_curso" value="<?php echo $codigo ?>">
                <br>
                <label for="descripcion">Ingrese la descripción:</label>
                <input type="text" name="descripcion" placeholder="Descripción" required>
                <br>
                <label for="porcentaje">Ingrese el porcentaje:</label>
                <input type="text" name="porcentaje" placeholder="Porcentaje" required>
                <br>
                <label for="posicion">Ingrese la posición de la nota a actualizar:</label>
                <input type="text" name="posicion" placeholder="Posición" required>
                <br><br>
            </div>
            <input type="submit" name="submit" value="Actualizar">
            <input type="hidden" name="action" value="actualizarNota">
            <!--<button><?php echo $codigo ?></button>-->
        </form>
        <button class="back-button" id="back-button" style="margin-top:30%; color:#fff; position:fixed;" onclick="window.history.back()">Volver</button>
    </div>
</body>

</html>