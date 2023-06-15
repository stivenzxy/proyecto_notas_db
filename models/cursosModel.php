<?php
require('connection.php');

class CursosModel {
    private $connect;
    public function __construct(){
        $this->connect = Connection::getConnection();
    }

    public function QueryListadoEstudiantes($nomb_curso,$anio,$periodo){
        $query = "SELECT e.cod_est,CONCAT(e.nomb1_est,' ',e.nomb2_est,' ',e.ape_paterno,' ',e.ape_materno) 
                  AS nombre 
                  FROM estudiantes e 
                  JOIN inscripciones i 
                  ON e.cod_est = i.cod_est 
                  JOIN cursos c 
                  ON i.cod_curso = c.cod_curso 
                  WHERE c.nomb_curso = ? AND i.anio = ? AND i.periodo = ?";

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1,$nomb_curso);
        $stmt->bindParam(2,$anio);
        $stmt->bindParam(3,$periodo);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}