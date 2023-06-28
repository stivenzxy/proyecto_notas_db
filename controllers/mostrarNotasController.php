<?php
require('../models/connection.php');
require('../models/NotasModel.php');

class MostrarNotas extends Connection
{
    private $notasModel;
    public $connect;
    public function __construct()
    {
        $this->notasModel = new Nota();
        $this->connect = $this->getConnection();
    }
    public function mostrarListado()
    {
        session_start();
        $codigo = $_SESSION['cod_curso'];

        $listado = $this->notasModel->getNotas($codigo, $this->connect);
        if (count($listado) > 0) {
            return $listado;
        } else {
            echo 'Hola gay';
        }
    }
}
