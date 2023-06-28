<?php
require('../models/connection.php');
require('../models/NotasModel.php');

session_start();
$codigo = $_SESSION['cod_curso'];

class AgregarNotas extends Connection
{
    public $connect;
    public $NotasModel;
    public function __construct()
    {
        $this->connect = $this->getConnection();
        $this->NotasModel = new Nota();
    }


    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            switch ($action) {
                case 'agregarNota':
                    $this->agregar();
                    break;
                case 'verListadoNotas':
                    $this->mostrarListado();
                    break;

                case 'actualizarNota':
                    $this->editarNota($_POST);
                    break;

                default:
                    //echo 'Acción inválida';
                    break;
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $action = $_GET['action'] ?? '';
            switch ($action) {
                case 'eliminarNota':
                    $datos = [
                        'posicion' => trim($_GET['posicion']),
                        'cod_curso' => trim($_GET['cod_curso']),
                    ];
                    $this->eliminar($datos);
                    break;
                default:
                    //echo 'Acción inválida';
                    break;
            }
        }
    }


    public function getNombreCurso($cod_curso)
    {
        $nombreCurso = $this->NotasModel->getNombreCurso($cod_curso, $this->connect);
        return $nombreCurso;
    }

    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'posicion' => trim($_POST['posicion']),
                'descripcion' => trim($_POST['descripcion']),
                'porcentaje' => trim($_POST['porcentaje']),
                'cod_curso' => trim($_POST['cod_curso']),
            ];

            if ($datos['porcentaje'] > 100) {
                echo '<script>alert("ERROR. El porcentaje no puede ser mayor a 100");
                history.back();</script>';
                die();
            }

            if ($datos['porcentaje'] <= 0) {
                echo '<script>alert("ERROR. El porcentaje no puede ser cero");
                history.back();</script>';
                die();
            }

            $sumaPorcentajes = $this->NotasModel->getSumaPorcentajes($datos, $this->connect);
            if (($sumaPorcentajes + $datos['porcentaje']) > 100) {
                echo '<script>alert("ERROR. La suma de los porcentajes no puede exceder el 100%");
                history.back();</script>';
                die();
            }

            $Repeposicion = $this->NotasModel->getPosicion($datos, $this->connect);
            if ($Repeposicion == true) {
                echo '<script>alert("ERROR. La posicion ingresada ya existe en la tabla");
                history.back();</script>';
                die();
            }

            if ($this->NotasModel->agregarNota($datos, $this->connect)) {
                echo '<script>alert("Nota agregada exitosamente!");
                     history.back();
                     </script>';
            } else {   
                echo '<script>alert("Algo salio mal!");
                history.back();
                </script>';
                die();
            }
        }
    }
    public function editarNota($datos)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'posicion' => trim($_POST['posicion']),
                'descripcion' => trim($_POST['descripcion']),
                'porcentaje' => trim($_POST['porcentaje']),
                'cod_curso' => trim($_POST['cod_curso']),
            ];

            try {
                if ($datos['porcentaje'] > 100) {
                    echo '<script>alert("ERROR. La suma de los porcentajes no puede exceder el 100%");
                    history.back();</script>';
                    die();
                }

                if ($datos['porcentaje'] <= 0) {
                    echo '<script>alert("ERROR. El porcentaje no puede ser cero");
                    history.back();</script>';
                    die();
                }

                $Repeposicion = $this->NotasModel->getPosicion($datos, $this->connect);
                if ($Repeposicion == false) {
                    echo '<script>alert("ERROR. La posicion ingresada no existe en la tabla");
                    history.back();</script>';
                    die();
                }

                $porcentajeActual = $this->NotasModel->getPorcentaje($datos,$this->connect);
                $sumaPorcentajes = $this->NotasModel->getSumaPorcentajes($datos, $this->connect) - $porcentajeActual;

                if (($sumaPorcentajes + $datos['porcentaje']) > 100) {
                    echo '<script>alert("ERROR. La suma de los porcentajes no puede exceder el 100%");
                    history.back();</script>';
                    die();
                }

                if ($this->NotasModel->actualizarNota($datos, $this->connect)) {
                    echo '<script>alert("Nota actualizada exitosamente!");
                    history.back();
                </script>';
                } else {
                    throw new Exception('Algo salió mal al intentar actualizar la nota');
                }
            } catch (Exception $e) {
                echo 'Se ha producido una excepción: ' . $e->getMessage();
            }
        }
    }

    public function mostrarListado()
    {
        session_start();
        $codigo = $_SESSION['cod_curso'];

        $listado = $this->NotasModel->getNotas($codigo, $this->connect);
        if (count($listado) > 0) {
            return $listado;
        } else {
            echo 'Hola gay';
        }
    }

    public function eliminar($datos)
    {
        if ($this->NotasModel->eliminarNota($datos, $this->connect)) {
            echo '<script>alert("Nota eliminada exitosamente!");
                    history.back();
                </script>';
        } else {
            die('Algo salió mal al intentar eliminar la nota');
        }
    }
}

$agregarNota = new AgregarNotas();
$agregarNota->handleRequest();
