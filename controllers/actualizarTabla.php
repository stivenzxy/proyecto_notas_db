<?php
require_once('./estudiantesController.php');
session_start();
$nuevosEstudiantesInscritos = $_SESSION['nuevosEstudiantesInscritos'];
$contador = 1; 

$htmlTabla = '';
foreach ($nuevosEstudiantesInscritos as $nuevoEstudianteInscrito) {
    $htmlTabla .= '<tr>';
    $htmlTabla .= '<td>' . $contador++ . '</td>';
    $htmlTabla .= '<td>' . $nuevoEstudianteInscrito['cod_est'] . '</td>';
    $htmlTabla .= '<td>' . $nuevoEstudianteInscrito['nombre'] . '</td>';
    $htmlTabla .= '<td>';
    $htmlTabla .= '<button class="delete-button" data-cod_estudiante="' . $nuevoEstudianteInscrito['cod_est'] . '">';
    $htmlTabla .= '<i class="fa fa-trash"></i>';
    $htmlTabla .= '</button>';
    $htmlTabla .= '</td>';
    $htmlTabla .= '</tr>';
}

// Devolver los nuevos datos de la tabla como cadena HTML
echo $htmlTabla;
?>

