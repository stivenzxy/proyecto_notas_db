<?php
require('../models/connection.php');
require('../models/cursosModel.php');

class cursosController extends Connection {
    private $cursosModel;
    public $connect;

    public function __construct() {
        $this->cursosModel = new cursosModel();
        $this->connect = $this->getConnection();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            switch ($action) {
                case 'verListado':
                    $this->verListado();
                    break;
            }
        }
    }

    public function verListado() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo_usr = $_POST['cod_usr'];
            $cursosList = $this->cursosModel->getCursos($codigo_usr, $this->connect);
            session_start();                  
            $_SESSION['cursosTotales']=$cursosList;
            $_SESSION['nombre']=$codigo_usr;
            if (count($cursosList) > 0) {
                header("Location: ../views/tablaCursos.php"); 
            } else {
                header("Location: https://www.tomshardware.com/how-to/zip-files-in-linux");
            }
            exit(); // Se recomienda agregar exit() después de la redirección.
        }
    }
}

// Crear una instancia del controlador y manejar la solicitud.
$cursosController = new cursosController();
$cursosController->handleRequest();
?>

