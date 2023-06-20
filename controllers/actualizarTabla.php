<?php
require_once('./estudiantesController.php');
session_start();
$nuevosEstudiantes = $_SESSION['nuevosEstudiantes'];
$contador = 1;

$htmlTabla = '';
foreach ($nuevosEstudiantes as $estudiante) {
    $htmlTabla .= '<tr>';
    $htmlTabla .= '<td>' . $contador++ . '</td>';
    $htmlTabla .= '<td>' . $estudiante['cod_est'] . '</td>';
    $htmlTabla .= '<td>' . $estudiante['nombre'] . '</td>';
    $htmlTabla .= '<td>';
    $htmlTabla .= '<button class="delete-button" data-cod_estudiante="' . $estudiante['cod_est'] . '">';
    $htmlTabla .= '<i class="fa fa-trash"></i>';
    $htmlTabla .= '</button>';
    $htmlTabla .= '</td>';
    $htmlTabla .= '</tr>';
}

// Devolver los nuevos datos de la tabla como cadena HTML
echo $htmlTabla;
?>

