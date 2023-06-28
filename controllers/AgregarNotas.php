<?php
require('../models/connection.php');
require('../models/NotasModel.php');

session_start();
$codigo = $_SESSION['cod_curso'];

class AgregarNotas extends Connection {
public $connect;
public $NotasModel;
public function __construct() {
$this->connect = $this->getConnection();
$this->NotasModel = new Nota();

}
public function agregar() {
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datos = [
            'posicion' => trim($_POST['posicion']),
            'descripcion' => trim($_POST['descripcion']),
            'porcentaje' => trim($_POST['porcentaje']),
            'cod_curso' => trim($_POST['cod_curso']),
        ];

        if($datos['porcentaje'] > 100) {
            die('El porcentaje no puede ser mayor a 100');
        }

        $sumaPorcentajes = $this->NotasModel->getSumaPorcentajes($datos,$this->connect);
        if(($sumaPorcentajes + $datos['porcentaje']) > 100) {
            die('La suma de los porcentajes no puede exceder el 100%');
        }

        $Repeposicion = $this->NotasModel->getPosicion($datos,$this->connect);
        if($Repeposicion == true) {
            die('La posicion ingresada ya existe!');
        }

        if($this->NotasModel->agregarNota($datos,$this->connect)){
            echo '<script>alert("Nota agregada exitosamente!");
                    history.back();
                </script>';
        } else {
            die('Algo salió mal');
        }
    } 
}
}

$agregarNota = new AgregarNotas();
$agregarNota->agregar();
