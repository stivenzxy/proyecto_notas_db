<?php

require('../models/cursosModel.php');

class EstudiantesController {
    private $cursosModel;
    private $insert;
    public function __construct(){
        $this->cursosModel = new CursosModel();
    }

    public function AgregarEstudiante(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $cod_est = $_POST['cod_est'];
            $nomb_est = $_POST['nomb_est'];

            session_start();
            $nomb_curso=$_SESSION['cursos'];
            $anio=$_SESSION['anio'];
            $periodo=$_SESSION['periodo'];

            $separarNombre = explode(" ",$nomb_est);

            $nombre1 = $separarNombre[0];
            $nombre2 = isset($separarNombre[1]) ? $separarNombre[1] : "";
            $apellido1 = isset($separarNombre[2]) ? $separarNombre[2] : "";
            $apellido2 = isset($separarNombre[3]) ? $separarNombre[3] : "";

            $this->insert = $this->cursosModel->InsertarEstudiantes($cod_est,$nombre1,$nombre2,$apellido1,$apellido2);
            
            if ($this->insert) {
                $this->cursosModel->AgregarInscripcion($cod_est,$nomb_curso,$periodo,$anio);
                $nuevosEstudiantes = $this->cursosModel->VerEstudiantes($nomb_curso,$anio,$periodo);
                $_SESSION['nuevosEstudiantes']=$nuevosEstudiantes;
                echo json_encode(array('success' => 1));
            } else {
                echo json_encode(array('success' => 0));
            }
        }
    }
}