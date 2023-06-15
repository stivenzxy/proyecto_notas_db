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
            /*$periodo1 = $_POST['periodo1'];
            $periodo2 = $_POST['periodo2'];*/

            /*var_dump($nomb_curso);
            var_dump($anio);
            var_dump($periodo);*/
            $this->estudiantes = $this->cursosModel->QueryListadoEstudiantes($nomb_curso,$anio,$periodo);
           session_start();
           $_SESSION['estudiantes']=$this->estudiantes;
            //var_dump($this->estudiantes);
            if (count($this->estudiantes) > 0) {
                /*echo json_encode(array('success'=>1));*/
                header('Location: ../views/tablaEstudiantes.php');
            } else {
                /*echo json_encode(array('success'=>0));*/
                header('Location: ../views/NoExistsInDB.php');
            }
        }
    }
}