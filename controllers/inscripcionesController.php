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
                    $this->verListado();
                    break;
                case 'inscribirEstudiante':
                    $this->inscribirEstudiante();
                    break;
                case 'crearInscripcion':
                    $this->crearInscripcion();
                    break;
                case 'eliminarEstudianteInscrito':
                    $this->eliminarEstudianteInscrito();
                default:
                    //echo 'Acción inválida';
                    break;
            }
        }
    }

    public function verListado()
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

    public function inscribirEstudiante()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $estudianteSeleccionado = $_POST['listEstudiantes'];

            $separarAtributos = explode(' - ', $estudianteSeleccionado);
            $codigo = trim($separarAtributos[0]);
            $cod_est = intval($codigo);

            session_start();
            $nomb_curso = $_SESSION['cursos'];
            $anio = $_SESSION['anio'];
            $periodo = $_SESSION['periodo'];

            $cod_curso = $this->inscripcionesModel->getCodCurso($nomb_curso, $this->connect);
            $this->insert = $this->inscripcionesModel->agregarEstudianteInscripcion($cod_est, $cod_curso, $periodo, $anio, $this->connect);

            if ($this->insert) {
                $nuevosEstudiantesInscritos = $this->inscripcionesModel->getEstudiantesInscritos($nomb_curso, $anio, $periodo, $this->connect);
                $_SESSION['nuevosEstudiantesInscritos'] = $nuevosEstudiantesInscritos;
                echo json_encode(array('success' => 1));
            } else {
                echo json_encode(array('success' => 0));
            }
        }
    }

    public function crearInscripcion()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            session_start();
            $nomb_curso = $_SESSION['cursos'];
            $anio = $_SESSION['anio'];
            $periodo = $_SESSION['periodo'];

            $cod_curso = $this->inscripcionesModel->getCodCurso($nomb_curso, $this->connect);
            $crearInscripcion = $this->inscripcionesModel->crearInscripcion($cod_curso, $anio, $periodo, $this->connect);

            if ($crearInscripcion == true) {
                echo json_encode(array('success' => 1));
            } else {
                echo json_encode(array('success' => 0));
            }
        }
    }

    public function eliminarEstudianteInscrito()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cod_est = $_POST['cod_est'];

            session_start();
            $nomb_curso = $_SESSION['cursos'];
            $anio = $_SESSION['anio'];
            $periodo = $_SESSION['periodo'];

            $cod_curso = $this->inscripcionesModel->getCodCurso($nomb_curso, $this->connect);
            $eliminarEstudiante = $this->inscripcionesModel->eliminarEstudianteInscrito($cod_curso, $cod_est, $periodo, $anio, $this->connect);
            //echo var_dump($eliminarEstudiante);
           if ($eliminarEstudiante == true) {
                echo '<script>
                        alert("estudiante eliminado correctamente!");
                        history.back();
                        location.reload();
                      </script>';
            } else {
                echo '<script>
                        alert("el estudiante ya se encuentra eliminado");
                        history.back();
                     </script>';
            }
        }
    }
}

$listado = new InscripcionesController();
$listado->handleRequest();