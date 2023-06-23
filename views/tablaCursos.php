<?php
require_once('../controllers/cursosController.php');

//$controller = new CursosController();
/*$controller->mostrarListado();*/
session_start();
$estudiantes = $_SESSION['estudiantes'];
/*var_dump($estudiantes)*/
$contador = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tablaEstudiantes.css">
    <link rel="shortcut icon" href="../resources/listadoEstudiantes.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e562395e64.js" crossorigin="anonymous"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
    <title>Estudiantes inscritos</title>
</head>

<body>
    <div class="container">
        <div class="table-header">
            <h2>Cursos</h2>
            <button onclick="goBack()" id="back-button">Volver</button>
            <script>
                function goBack() {
                    history.back();
                }
            </script>
           
        </div>
        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tablaCursos">
                <?php foreach ($estudiantes as $estudiante) { ?>
                <tr>
                    <td><?php echo $contador++; ?></td>
                    <td><?php echo $estudiante['cod_est'];?></td>
                    <td><?php echo $estudiante['nombre'];?></td>
                    <td>
                        <button class="delete-button" data-cod_estudiante="<?php echo $estudiante['cod_est']; ?>">
                            <i class="fa-solid fa-trash"></i> <!--Cuando haga cambios aqui debo cambiar Actualizar tabla tambien-->
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <section class="modal">
            <div class="modal-container">
            <img src="../resources/AddStudentModal.svg" class="modal-image">
            <div class="modal-form-container">
                <form method="post" id="form-addStudent" action="../controllers/estudiantesInstance.php">
                    <h2 class="modal-title">Agregar Estudiante</h2>
                    <input type="number" id="cod_est" name="cod_est" placeholder="Código de Estudiante" required>
                    <input type="text" id="nomb_est" name="nomb_est" placeholder="Nombre del Estudiante" required><br>
                    <button type="submit" id="addStudentButton">Agregar</button>
                </form>
                <a href="#" class="modal-close">Cerrar</a>
                </div>
            </div>
        </section>
        <div class="alerta"></div>
    </div>
    <script type="module" src="../js/agregarEstudiante.js"></script>
</body>

</html>