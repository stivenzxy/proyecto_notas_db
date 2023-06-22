<?php
require('connection.php');

class CursosModel {
    private $connect;
    public function __construct(){
        $this->connect = Connection::getConnection();
    }

    public function VerEstudiantes($nomb_curso,$anio,$periodo){
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

    public function InsertarEstudiantes($cod_est,$nombre1,$nombre2,$apellido1,$apellido2){
        $verify = 'SELECT cod_est FROM estudiantes WHERE cod_est = ?';
        $vstmt = $this->connect->prepare($verify);
        $vstmt->bindParam(1,$cod_est);
        $vstmt->execute();
        $result = $vstmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0){
            return false;
        } else {
            $insert = "INSERT INTO estudiantes(cod_est,nomb1_est,nomb2_est,ape_paterno,ape_materno) VALUES(?,?,?,?,?)";

            $stmt = $this->connect->prepare($insert);
            $stmt->bindParam(1,$cod_est);
            $stmt->bindParam(2,$nombre1);
            $stmt->bindParam(3,$nombre2);
            $stmt->bindParam(4,$apellido1);
            $stmt->bindParam(5,$apellido2);
    
            $stmt->execute();
            return true;
        }
    }

    public function AgregarInscripcion($cod_est, $nomb_curso, $periodo, $anio){
        $select = 'SELECT cod_curso FROM cursos WHERE nomb_curso = ?';
        $insert = 'INSERT INTO inscripciones (cod_est, cod_curso, periodo, anio) VALUES (?, ?, ?, ?)';
    
        $stmt = $this->connect->prepare($select);
        $stmt->bindParam(1, $nomb_curso);
        $stmt->execute();
        $cod_curso = $stmt->fetchColumn();
    
        if (!$cod_curso) {
            return false;
        }
    
        $stmt = $this->connect->prepare($insert);
        $stmt->bindParam(1, $cod_est);
        $stmt->bindParam(2, $cod_curso);
        $stmt->bindParam(3, $periodo);
        $stmt->bindParam(4, $anio);
    
        $stmt->execute();
        return true;
    }
    
}