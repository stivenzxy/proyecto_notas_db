<?php
require('../models/cursosModel.php');
class CursosController {
    private $cursosModel;
    public $estudiantes;
    public function __construct(){
        $this->cursosModel = new CursosModel();
    } 

    public function mostrarListado(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ //si el form se envio mediante post, entonces {...}
            $nomb_curso = $_POST['cursos'];
            $anio = $_POST['anio'];
            $periodo = $_POST['periodo'];
            
            
            $this->estudiantes = $this->cursosModel->VerEstudiantes($nomb_curso,$anio,$periodo);
            session_start();
            $_SESSION['estudiantes']=$this->estudiantes;
            $_SESSION['cursos']=$nomb_curso;
            $_SESSION['anio']=$anio;
            $_SESSION['periodo']=$periodo;

            if (count($this->estudiantes) > 0) {
                echo json_encode(array('success'=>1));
            } else {
                echo json_encode(array('success'=>0));
            }
        }
    }
}