<?php
class InscripcionesModel
{

    public function getCodCurso($nomb_curso, $connect)
    {
        $select = 'SELECT cod_curso FROM cursos WHERE nomb_curso = ?';
        $stmt = $connect->prepare($select);
        $stmt->bindParam(1, $nomb_curso);
        $stmt->execute();
        $cod_curso = $stmt->fetchColumn();

        return $cod_curso;
    }

    public function getEstudiantesInscritos($nomb_curso, $anio, $periodo, $connect)
    {
        $query = "SELECT e.cod_est,CONCAT(e.nomb1_est,' ',e.nomb2_est,' ',e.ape_paterno,' ',e.ape_materno) 
                  AS nombre 
                  FROM estudiantes e 
                  JOIN inscripciones i 
                  ON e.cod_est = i.cod_est 
                  JOIN cursos c 
                  ON i.cod_curso = c.cod_curso 
                  WHERE c.nomb_curso = ? AND i.anio = ? AND i.periodo = ?";

        $stmt = $connect->prepare($query);
        $stmt->bindParam(1, $nomb_curso);
        $stmt->bindParam(2, $anio);
        $stmt->bindParam(3, $periodo);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarEstudianteInscripcion($cod_est, $cod_curso, $periodo, $anio, $connect)
    {
        $verificar = 'SELECT * FROM inscripciones WHERE cod_est = ? AND anio = ? AND periodo = ? AND cod_curso = ?';

        $vstmt = $connect->prepare($verificar);
        $vstmt->bindParam(1, $cod_est);
        $vstmt->bindParam(2, $anio);
        $vstmt->bindParam(3, $periodo);
        $vstmt->bindParam(4, $cod_curso);
        $vstmt->execute();
        $resultado = $vstmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultado) > 0) {
            return false;
        } else {
            $insert = 'INSERT INTO inscripciones (cod_est, cod_curso, periodo, anio) VALUES (?, ?, ?, ?)';

            $stmt = $connect->prepare($insert);
            $stmt->bindParam(1, $cod_est);
            $stmt->bindParam(2, $cod_curso);
            $stmt->bindParam(3, $periodo);
            $stmt->bindParam(4, $anio);

            $stmt->execute();
            return true;
        }
    }

    public function crearInscripcion($cod_curso, $anio, $periodo, $connect)
    {
        $verificar = 'SELECT * FROM inscripciones WHERE cod_est = 0 AND cod_curso = ? AND periodo = ? AND anio = ?';

        $vstmt = $connect->prepare($verificar);
        $vstmt->bindParam(1, $cod_curso);
        $vstmt->bindParam(2, $periodo);
        $vstmt->bindParam(3, $anio);

        $vstmt->execute();
        $resultado = $vstmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultado) > 0) {
            return false;
        } else {
            $insert = 'INSERT INTO inscripciones(cod_curso,cod_est,periodo,anio) VALUES (?, 0, ?, ?)';

            $stmt = $connect->prepare($insert);
            $stmt->bindParam(1, $cod_curso);
            $stmt->bindParam(2, $periodo);
            $stmt->bindParam(3, $anio);

            $stmt->execute();
            return true;
        }
    }

    public function eliminarEstudianteInscrito($cod_curso,$cod_est,$periodo,$anio,$connect)
    {
        $verificar = 'SELECT cod_est FROM inscripciones WHERE cod_curso = ? AND cod_est = ? AND periodo = ? AND anio = ?';
        $vstmt = $connect->prepare($verificar);
        $vstmt->bindParam(1,$cod_curso);
        $vstmt->bindParam(2,$cod_est);
        $vstmt->bindParam(3,$periodo);
        $vstmt->bindParam(4,$anio);
        $vstmt->execute();

        $resultado = $vstmt->fetchAll(PDO::FETCH_ASSOC);
       // var_dump($resultado);
        if(count($resultado) > 0){
            $delete = 'DELETE FROM inscripciones WHERE cod_est = ? AND cod_curso = ? AND periodo = ? AND anio = ?';
        
            $stmt = $connect->prepare($delete);
            $stmt->bindParam(1,$cod_est);
            $stmt->bindParam(2,$cod_curso);
            $stmt->bindParam(3,$periodo);
            $stmt->bindParam(4,$anio);
    
            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }
}
