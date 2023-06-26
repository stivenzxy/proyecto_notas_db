<?php
class cursosModel {
    public function getCursos($codigo_usr, $connect) {
        $query = "SELECT * FROM cursos where codigo_usr=?";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(1,$codigo_usr);
        $stmt->execute();
        if (!$stmt) {
            echo "\nPDO::errorInfo():\n";
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setCurso($cod_cur,$nomb_cur, $connect) {
        $query1="SELECT * FROM cursos where cod_curso!=? AND nomb_curso=?";
        $stmt = $connect->prepare($query1);
        $stmt->bindParam(1,$cod_cur);
        $stmt->bindParam(2,$nomb_cur);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($result) > 0){
            throw new Exception('Ya hay un curso con este nombre');

        }
        $query1="UPDATE cursos SET nomb_curso=? where cod_curso=?";
        $stmt = $connect->prepare($query1);
        $stmt->bindParam(1,$nomb_cur);
        $stmt->bindParam(2,$cod_cur);
        $stmt->execute();
    }
}
?>

