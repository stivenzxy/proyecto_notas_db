<?php
require_once('../controllers/cursosController.php');

$controller = new CursosController();
/*$controller->mostrarListado();*/
session_start();
$estudiantes=$_SESSION['estudiantes'];
/*var_dump($estudiantes)*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes inscritos</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($estudiantes as $estudiante) { ?>
            <tr>    
                <td><?php echo $estudiante['cod_est'];?></td>
                <td><?php echo $estudiante['nombre'];?></td>
            </tr>  
        <?php } ?>
    </tbody>
    </table>
   
    
</body>
</html>