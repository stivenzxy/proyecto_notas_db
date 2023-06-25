<?php

require('../models/connection.php');
require('../models/inscripcionesModel.php');
class InscripcionesController extends Connection
{
    private $inscripcionesModel;
    private $nomb_curso;
    private $anio;
    private $periodo;
    public $estudiantesInscritos;
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
            $this->nomb_curso = $_POST['cursos'];
            $this->anio = $_POST['anio'];
            $this->periodo = $_POST['periodo'];

            $this->estudiantesInscritos = $this->inscripcionesModel->getEstudiantesInscritos($this->nomb_curso, $this->anio, $this->periodo, $this->connect);
            ///////////////////////////////
            session_start();
            $_SESSION['estudiantesInscritos'] = $this->estudiantesInscritos;
            $_SESSION['cursos'] = $this->nomb_curso;
            $_SESSION['anio'] = $this->anio;
            $_SESSION['periodo'] = $this->periodo;
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

            $separarAtributos = explode('-', $estudianteSeleccionado);
            $codigo = trim($separarAtributos[0]);
            $cod_est = intval($codigo);

            $insert = $this->inscripcionesModel->AgregarEstudianteInscripcion($cod_est,$this->nomb_curso,$this->periodo,$this->anio,$this->connect);

            if($insert) {
                $nuevosEstudiantesInscritos = $this->inscripcionesModel->getEstudiantesInscritos($this->nomb_curso,$this->anio,$this->periodo,$this->connect);
                $_SESSION['nuevosEstudiantesInscritos']=$nuevosEstudiantesInscritos;
                echo json_encode(array('success' => 1));
            }
        } 
    }
}

$listado = new InscripcionesController();
$listado->handleRequest();
