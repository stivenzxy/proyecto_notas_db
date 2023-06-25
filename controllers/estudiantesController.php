<?php
require('../models/connection.php');
require('../models/estudiantesModel.php');
class EstudiantesController extends Connection
{
    private $estudiantesModel;
    public $connect;
    private $insert;
    public function __construct()
    {
        $this->estudiantesModel = new EstudiantesModel();
        $this->connect = $this->getConnection();
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            switch ($action) {
                case 'agregarEstudiante':
                    $this->agregarEstudiante();
                    break;
                default:
                    //echo 'Acción inválida';
                    break;
            }
        }
    }

    public function agregarEstudiante()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cod_est = $_POST['cod_est'];
            $nomb_est = $_POST['nomb_est'];

            $separarNombre = explode(" ", $nomb_est);

            $nombre1 = $separarNombre[0];
            $nombre2 = "";
            $apellido1 = "";
            $apellido2 = "";

            if(count($separarNombre) == 2){
                $apellido1 = $separarNombre[count($separarNombre) - 1];
            } elseif (count($separarNombre) == 3) {
                $apellido1 = $separarNombre[count($separarNombre) - 2];
                $apellido2 = $separarNombre[count($separarNombre) - 1];
            } else {
                $nombre2 = $separarNombre[1];
                $apellido1 = $separarNombre[2];
                $apellido2 = $separarNombre[3];
            }

            $this->insert = $this->estudiantesModel->InsertarEstudiantes($cod_est, $nombre1, $nombre2, $apellido1, $apellido2, $this->connect);

            if ($this->insert) {
                echo json_encode(array('success' => 1));
            } else {
                echo json_encode(array('success' => 0));
            }
        }
    }

    public function mostrarEstudiantesExistentes()
    {
        $nomb_curso = $_SESSION['cursos'];
        $anio = $_SESSION['anio'];
        $periodo = $_SESSION['periodo'];

        $estudiantesDisponibles = $this->estudiantesModel->obtenerNombreEstudiantes($this->connect, $nomb_curso, $anio, $periodo);
        return $estudiantesDisponibles;
    }
}

$retorno = new EstudiantesController();
$retorno->handleRequest();
