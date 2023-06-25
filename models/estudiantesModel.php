<?php 
class EstudiantesModel {
    public function obtenerNombreEstudiantes($connect,$nomb_curso,$anio,$periodo) {
        $select = 'SELECT cod_curso FROM cursos WHERE nomb_curso = ?';
        $query = "SELECT cod_est,CONCAT(nomb1_est,' ',nomb2_est,' ',ape_paterno,' ',ape_materno) 
                  AS nombre 
                  FROM estudiantes 
                  WHERE cod_est 
                  NOT IN(SELECT DISTINCT cod_est FROM inscripciones WHERE cod_curso=? AND anio=? AND periodo=?) 
                  AND nomb1_est <> 'VACIO'
                  ORDER BY nombre ASC";

        $stmt1 = $connect->prepare($select);
        $stmt1->bindParam(1,$nomb_curso);
        $stmt1->execute();
        $cod_curso = $stmt1->fetchColumn();
    
        if (!$cod_curso) {
            return false;
        }

        $stmt2 = $connect->prepare($query);
        $stmt2->bindParam(1,$cod_curso);
        $stmt2->bindParam(2,$anio);
        $stmt2->bindParam(3,$periodo);
        $stmt2->execute();

        return $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }

    public function InsertarEstudiantes($cod_est,$nombre1,$nombre2,$apellido1,$apellido2,$connect){
        $verify = 'SELECT cod_est FROM estudiantes WHERE cod_est = ?';
        $vstmt = $connect->prepare($verify);
        $vstmt->bindParam(1,$cod_est);
        $vstmt->execute();
        $result = $vstmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0){
            return false;
        } else {
            $insert = "INSERT INTO estudiantes(cod_est,nomb1_est,nomb2_est,ape_paterno,ape_materno) VALUES(?,?,?,?,?)";

            $stmt = $connect->prepare($insert);
            $stmt->bindParam(1,$cod_est);
            $stmt->bindParam(2,$nombre1);
            $stmt->bindParam(3,$nombre2);
            $stmt->bindParam(4,$apellido1);
            $stmt->bindParam(5,$apellido2);
    
            $stmt->execute();
            return true;
        }
    }

}