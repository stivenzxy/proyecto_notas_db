<?php
require('../models/cursosModel.php');
class CursosController {
    private $cursosModel;
    public $estudiantes;
    public function __construct(){
        $this->cursosModel = new CursosModel();
    }

    public function mostrarListado(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nomb_curso = $_POST['cursos'];
            $anio = $_POST['anio'];
            $periodo = $_POST['periodo'];
        
            $this->estudiantes = $this->cursosModel->QueryListadoEstudiantes($nomb_curso,$anio,$periodo);
           session_start();
           $_SESSION['estudiantes']=$this->estudiantes;

            if (count($this->estudiantes) > 0) {
                echo json_encode(array('success'=>1));
            } else {
                echo json_encode(array('success'=>0));
            }
        }
    }
}