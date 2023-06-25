<?php

require('../models/connection.php');
require('../models/inscripcionesModel.php');
class InscripcionesController extends Connection
{
    private $inscripcionesModel;
    public $estudiantesInscritos;
    private $insert;
    public $connect;
    public function __construct()
    {
        $this->inscripcionesModel = new InscripcionesModel();
        $this->connect = $this->getConnection();
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            switch ($action) {
                case 'verListado':
                    $this->VerListado();
                    break;
                case 'inscribirEstudiante':
                    $this->InscribirEstudiante();
                    break;
                default:
                    //echo 'Acción inválida';
                    break;
            }
        }
    }

    public function VerListado()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //si el form se envio mediante post, entonces {...}
            $nomb_curso = $_POST['cursos'];
            $anio = $_POST['anio'];
            $periodo = $_POST['periodo'];

            $this->estudiantesInscritos = $this->inscripcionesModel->getEstudiantesInscritos($nomb_curso, $anio, $periodo, $this->connect);
            ///////////////////////////////
            session_start();
            $_SESSION['estudiantesInscritos'] = $this->estudiantesInscritos;
            $_SESSION['cursos'] = $nomb_curso;
            $_SESSION['anio'] = $anio;
            $_SESSION['periodo'] = $periodo;
            ///////////////////////////////
            if (count($this->estudiantesInscritos) > 0) {
                echo json_encode(array('success' => 1));
            } else {
                echo json_encode(array('success' => 0));
            }
        }
    }

    public function InscribirEstudiante(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $estudianteSeleccionado = $_POST['listEstudiantes'];

            $separarAtributos = explode(' - ', $estudianteSeleccionado);
            $codigo = trim($separarAtributos[0]);
            $cod_est = intval($codigo);

            session_start();
            $nomb_curso = $_SESSION['cursos'];
            $anio = $_SESSION['anio'];
            $periodo = $_SESSION['periodo'];
            
            $this->insert = $this->inscripcionesModel->AgregarEstudianteInscripcion($cod_est,$nomb_curso,$periodo,$anio,$this->connect);

            if($this->insert) {
                $nuevosEstudiantesInscritos = $this->inscripcionesModel->getEstudiantesInscritos($nomb_curso,$anio,$periodo,$this->connect);
                $_SESSION['nuevosEstudiantesInscritos']=$nuevosEstudiantesInscritos;
                echo json_encode(array('success' => 1));
            } else {
                echo json_encode(array('success' => 0));
            }
        } 
    }
}

$listado = new InscripcionesController();
$listado->handleRequest();
