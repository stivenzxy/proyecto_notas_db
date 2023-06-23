<?php
session_start();
$estudiantesInscritos = $_SESSION['estudiantesInscritos'];
$nomb_curso = $_SESSION['cursos'];
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
            </div>
            <button onclick="goBack()" id="back-button">Volver</button>
            <script>
            function goBack() {
                history.back();
            }
            </script>
            <button type="submit" id="header-button">Añadir Estudiante</button>
            <div class="input-search">
                <input type="search" placeholder="Buscar" />
                <i class="fa fa-search" id="search"></i>
            </div>
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
            <tbody id="tablaEstudiantes">
                <?php foreach ($estudiantesInscritos as $estudianteInscrito) { ?>
                <tr>
                    <td><?php echo $contador++; ?></td>
                    <td><?php echo $estudianteInscrito['cod_est']; ?></td>
                    <td><?php echo $estudianteInscrito['nombre']; ?></td>
                    <td>
                        <button class="delete-button"
                            data-cod_estudiante="<?php echo $estudianteInscrito['cod_est']; ?>">
                            <i class="fa-solid fa-trash"></i>
                            <!--Cuando haga cambios aqui debo cambiar Actualizar tabla tambien-->
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <section class="modal">
            <div class="modal-container">

                <div class="addEstudianteExistente-container">
                    <img src="../resources/AddExistStudent.svg" class="modal-image1">
                    <form method="post" id="form-addExistingStudent" action="../controllers/estudiantesController.php">
                        <h2 class="modal-title1">Agregar estudiante existente a la inscripcion</h2>
                        <label for="listEstudiantes" class="listEstudiantes">Estudiantes disponibles: </label><br>
                        <button type="button" value="false">Inscritos</button>
                        <button type="button" value="true">No inscritos</button>
                        <?php
                            require_once("../controllers/estudiantesController.php");
                            $class = new EstudiantesController();
                            $estudiantesDisp = $class->mostrarEstudiantesExistentes();
                            echo "<select>";
                            foreach ($estudiantesDisp as $nombre) {
                                echo "<option id='listEstudiantes' value='" . $nombre['nombre'] . "'>" . $nombre['nombre'] . "</option>";
                            }
                            echo "</select>";
                        ?>
                        <button type="submit" id="addStudentButton">
                            <h2 class="textcontainer">Agregar</h2>
                        </button>
                        <input type="hidden" name="action" value="agregarEstudianteExistente">
                    </form>
                </div>

                <div class="modal-form-container">
                    <img src="../resources/AddStudentModal.svg" class="modal-image2">
                    <form method="post" id="form-addStudent" action="../controllers/estudiantesController.php">
                        <h2 class="modal-title">Crear y agregar un nuevo estudiante</h2>
                        <input type="number" id="cod_est" name="cod_est" placeholder="Código de Estudiante" required>
                        <input type="text" id="nomb_est" name="nomb_est" placeholder="Nombre del Estudiante"
                            required><br>
                        <div class="buttonscontainer">
                            <button type="submit" id="addStudentButton">
                                <h2 class="textcontainer">Crear y Agregar</h2>
                            </button>
                            <input type="hidden" name="action" value="agregarNuevoEstudiante">
                            <a href="#" class="modal-close">Cerrar</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <div class="alerta"></div>
    </div>
    <script type="module" src="../js/estudiantesController.js"></script>
</body>

</html>