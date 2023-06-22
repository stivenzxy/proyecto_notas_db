<?php
require('../models/connection.php');
require('../models/inscripcionesModel.php');
class InscripcionesController extends Connection{
    private $inscripcionesModel;
    public $estudiantesInscritos;
    public $connect;
    public function __construct(){
        $this->inscripcionesModel = new InscripcionesModel();
        $this->connect = $this->getConnection();
    }

    public function VerListado(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ //si el form se envio mediante post, entonces {...}
            $nomb_curso = $_POST['cursos'];
            $anio = $_POST['anio'];
            $periodo = $_POST['periodo'];
            
            
            $this->estudiantesInscritos = $this->inscripcionesModel->getEstudiantesInscritos($nomb_curso,$anio,$periodo,$this->connect);
            ///////////////////////////////
            session_start();
            $_SESSION['estudiantesInscritos']=$this->estudiantesInscritos;
            $_SESSION['cursos']=$nomb_curso;
            $_SESSION['anio']=$anio;
            $_SESSION['periodo']=$periodo;
            ///////////////////////////////
            if (count($this->estudiantesInscritos) > 0) {
                echo json_encode(array('success'=>1));
            } else {
                echo json_encode(array('success'=>0));
            }
        }
    }
}

$listado = new InscripcionesController();
$listado->VerListado();
