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

        $action = isset($_GET['action']) ? $_GET['action'] : '';
            switch ($action) {
             case 'editarCursoPre':
           $cod_cur = isset($_GET['cod_cur']) ? $_GET['cod_cur'] : '';
          $nomb_cur = isset($_GET['nomb_cur']) ? $_GET['nomb_cur'] : '';

          $this->editarCursoPre($cod_cur, $nomb_cur);

      

        break;

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

    public function editarCursoPre($cod_cur, $nomb_cur) {
        session_start();                  
        $_SESSION['cod_cur']=$cod_cur;
         $_SESSION['nomb_cur']=$nomb_cur;
         header("Location: ../views/editarCurso.php"); 
        }
    
    public function editarCurso() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cod_cur= $_POST['cod_cur'];
            $nomb_cur = $_POST['nomb_usr'];
            try {
                $this->cursosModel->setCurso($cod_cur, $nomb_cur, $this->connect);
                header("Location: ../views/tablaCursos.php"); 
            } 
            catch (Exception $e) {
                echo 'Se ha producido una excepción: ' . $e->getMessage();
                session_start();                  
                $_SESSION['cod_cur']=$cod_cur;
                 $_SESSION['nomb_cur']=$nomb_cur;
                 header("Location: ../views/editarCurso.php"); 

            }
        }
    }

}



$cursosController = new cursosController();
$cursosController->handleRequest();
?>

