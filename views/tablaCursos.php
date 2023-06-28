<?php
session_start();
$cursosTotales = $_SESSION['cursosTotales'];
$nomb1_usr = $_SESSION['nombre'];
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
    <title>Cursos de docente</title>
</head>

<body>
    <div class="container">
        <div class="table-header">
            <div class="header-container">
                <h2>Cursos</h2>
            </div>
            <button id="back-buttonc"><a style="text-decoration:none; color:#fff;" href="../home.php">Inicio</a></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Notas / Editar nombre</th>
                </tr>
            </thead>
            <tbody id="tablaEstudiantes">
                <?php
                foreach ($cursosTotales as $curso) { ?>
                    <tr>
                        <td><?php echo $contador++; ?></td>
                        <td><?php echo $curso['cod_curso']; ?></td>
                        <td><?php echo $curso['nomb_curso']; ?></td>
                        <td>
                            <button class="tablaNotasButton">
                                <a style="text-decoration:none; color:#fff;" href="tablaNotas.php?cod_curso=<?php echo urlencode($curso['cod_curso']); ?>">Nota</a>
                            </button>
                            <button class="editarButton">
                                <a style="text-decoration:none; color:#fff;" href="../controllers/cursosController.php?action=editarCursoPre&cod_cur=<?php
                                                                                                                                                        echo $curso['cod_curso']; ?>&nomb_cur=<?php echo $curso['nomb_curso']; ?>">
                                    <!-- <i class="fa-solid fa-pen-to-square"></i>--> Editar
                                </a>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</body>

</html>