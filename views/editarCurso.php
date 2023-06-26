<?php
session_start();
$codigo = $_SESSION['cod_cur'];
$nombre = $_SESSION['nomb_cur'];
?>

<?php require('../layout/header.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../resources/listadoEstudiantes.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e562395e64.js" crossorigin="anonymous"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
    <title>Cursos de</title>
</head>

<main>
    <div class="container">
        <div class="title">Editar informacion</div>
        <form method="post" id="form-cursos" action="../controllers/cursosController.php">
            <div class="cursos-details">
            
                <div class="input-box">
                    <span class="details">Nombre:</span>
                    <input type="text" id="nombre" name="nomb_cur" value="<?php echo $nombre ?>" required>
                </div> 
                <?php echo $codigo?>
                <input type="hidden" name="cod_cur" value="<?php echo $codigo ?>">
                <input type="hidden" name="action" value="editarCurso">            
                <button type="submit" id="button">Guardar</button>
            </div>
        </form>
    </div>
</main>

<?php require('../layout/footer.php')?>