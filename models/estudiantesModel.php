<?php 
class EstudiantesModel {
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