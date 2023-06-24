<?php
require('../models/connection.php');
require('../models/inscripcionesModel.php');
require('../models/estudiantesModel.php');
class EstudiantesController extends Connection {
    private $inscripcionesModel;
    private $estudiantesModel;
    public $connect;
    private $insert;
    public function __construct(){
        $this->inscripcionesModel = new InscripcionesModel();
        $this->estudiantesModel = new EstudiantesModel();
        $this->connect = $this->getConnection();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            switch ($action) {
                case 'agregarNuevoEstudiante':
                    $this->agregarEstudiante();
                    break;
                case 'agregarEstudianteExistente':
                    $this->agregarEstudianteExistente();
                    break;
                default:
                    //echo 'Acción inválida';
                    break;
            }
        }
    }

    public function agregarEstudiante(){
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

            $this->insert = $this->estudiantesModel->InsertarEstudiantes($cod_est,$nombre1,$nombre2,$apellido1,$apellido2,$this->connect);
            
            if ($this->insert) {
                $this->inscripcionesModel->AgregarEstudianteInscripcion($cod_est,$nomb_curso,$periodo,$anio,$this->connect);
                $nuevosEstudiantesInscritos = $this->inscripcionesModel->getEstudiantesInscritos($nomb_curso,$anio,$periodo,$this->connect);
                $_SESSION['nuevosEstudiantesInscritos']=$nuevosEstudiantesInscritos;
                echo json_encode(array('success' => 1));
            } else {
                echo json_encode(array('success' => 0));
            }
        }
    }

    public function agregarEstudianteExistente(){

    }

    public function mostrarEstudiantesExistentes() {
        $estudiantesDisponibles = $this->estudiantesModel->obtenerNombreEstudiantes($this->connect);
        return $estudiantesDisponibles;
    }
}

$retorno = new EstudiantesController();
$retorno->handleRequest();