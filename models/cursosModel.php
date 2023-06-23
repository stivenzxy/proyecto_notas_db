<?php 
class CursosModel {
    public function InsertarCurso($cod_cur,$nomb_cur,$cod_usr,$connect){
        $verify = 'SELECT cod_cur FROM cursos WHERE cod_est = ?';
        $vstmt = $connect->prepare($verify);
        $vstmt->bindParam(1,$cod_cur);
        $vstmt->execute();
        $result = $vstmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0){
            return false;
        } else {
            $insert = "INSERT INTO estudiantes(cod_cur,nomb_cur,cod_usr) VALUES(?,?,?)";

            $stmt = $connect->prepare($insert);
            $stmt->bindParam(1,$cod_cur);
            $stmt->bindParam(2,$nomb_cur);
            $stmt->bindParam(3,$cod_usr);

            $stmt->execute();
            return true;
        }
    }

    

}