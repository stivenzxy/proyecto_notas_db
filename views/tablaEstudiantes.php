<?php
session_start();
$estudiantesInscritos = $_SESSION['estudiantesInscritos'];
$nomb_curso = $_SESSION['cursos'];
$periodo = $_SESSION['periodo'];
$anio = $_SESSION['anio'];
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
            <div class="header-container">
                <h2>Estudiantes</h2>
                <h4>Curso: <?php echo $nomb_curso ?></h4>
                <h4>Año: <?php echo $anio ?> - Periodo: <?php echo $periodo ?></h4>
            </div>
            <button onclick="goBack()" id="back-button">Volver</button>
            <script>
            function goBack() {
                history.back();
            }
            </script>
            <button type="submit" id="header-button">Añadir Estudiante</button>
            <div class="input-search">
                <input type="search" id="buscador" placeholder="Buscar" />
                <i class="fa fa-search" id="search"></i>
            </div>
        </div>
        <table id="tabla">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tablaEstudiantes">
                <?php foreach ($estudiantesInscritos as $estudianteInscrito) {
                    if ($estudianteInscrito['cod_est'] != 0) { ?>
                <tr>
                    <td><?php echo $contador++; ?></td>
                    <td><?php echo $estudianteInscrito['cod_est']; ?></td>
                    <td><?php echo $estudianteInscrito['nombre']; ?></td>
                    <td>
                        <form action="../controllers/inscripcionesController.php" method="post">
                            <input type="hidden" name="cod_est" value="<?php echo $estudianteInscrito['cod_est']; ?>">
                            <button class="delete-button" type="submit">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <input type="hidden" name="action" value="eliminarEstudianteInscrito">
                        </form>
                    </td>
                </tr>
                <?php }
                } ?>
            </tbody>
        </table>
        <section class="modal">
            <div class="modal-container">

                <div class="addEstudianteExistente-container">
                    <img src="../resources/AddExistStudent.svg" class="modal-image">
                    <form method="post" id="form-addExistingStudent"
                        action="../controllers/inscripcionesController.php">
                        <h2 class="modal-title">Agregar estudiante existente a la inscripcion</h2>
                        <label for="listEstudiante" class="listEstudiantes">Estudiantes disponibles: </label><br>
                        <?php
                        require_once("../controllers/estudiantesController.php");
                        $class = new EstudiantesController();
                        $estudiantesDisp = $class->mostrarEstudiantesExistentes();
                        echo "<select name='listEstudiantes'>";
                        foreach ($estudiantesDisp as $estudiante) {
                            $codigoEstudiante = $estudiante['cod_est'];
                            $nombreCompleto = $estudiante['nombre'];
                            $opcion = $codigoEstudiante . ' - ' . $nombreCompleto;

                            echo "<option id='listEstudiante' value='" . $opcion . "'>" . $opcion . "</option>";
                        }
                        echo "</select>";
                        ?>
                        <button type="submit" id="addStudentButton">
                            <h2 class="textcontainer">Agregar</h2>
                        </button>
                        <input type="hidden" name="action" value="inscribirEstudiante">
                        <a href="#" class="modal-close">Cerrar</a>
                    </form>
                </div>
            </div>
        </section>
        <div class="alerta"></div>
    </div>
    <script type="module" src="../js/inscribirEstudiante.js"></script>
    <script type="module" src="../js/buscador.js"></script>
</body>

</html>