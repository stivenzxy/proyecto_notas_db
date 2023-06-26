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
    <title>Cursos de</title>
</head>

<body>
    <div class="container">
        <div class="table-header">
            <div class="header-container">
                <h2>Cursos</h2>
                
            </div>
            <button  id="back-button"><a href="../index.php">Volver</a></button>
            
           
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
                <?php 
                foreach ($cursosTotales as $curso) { ?>
                <tr>
                    <td><?php echo $contador++; ?></td>
                    <td><?php echo $curso['cod_curso']; ?></td>
                    <td><?php echo $curso['nomb_curso']; ?></td>
                    <td>
                    <button class="button">
                            
                            <i class="fa-solid fa-info"></i>
                            
                        </button>
                    <button class="button">
                            <i class="fa-solid fa-table"></i>
                            
                        </button>

                        <button class="button">   
                        <a href="../controllers/cursosController.php?action=editarCursoPre&cod_cur=<?php 
                        echo $curso['cod_curso']; ?>&nomb_cur=<?php echo $curso['nomb_curso']; ?>">

                            <i class="fa-solid fa-pencil"></i>
                        </a>  
                        </button>

                        <button class="delete-button">
                            <i class="fa-solid fa-trash"></i>
                            
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    
    </div>
</body>

</html>


