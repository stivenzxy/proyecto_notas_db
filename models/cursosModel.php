<?php
class cursosModel {
    public function getCursos($codigo_usr, $connect) {
        $query = "SELECT * FROM cursos where codigo_usr=?";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(1,$codigo_usr);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setCurso($cod_cur,$nomb_cur, $connect) {
        $query1="SELECT * FROM cursos where cod_cur!=? AND nomb_cur=?";
        $stmt = $connect->prepare($query1);
        $stmt->bindParam(1,$cod_cur);
        $stmt->bindParam(2,$nomb_cur);
        $stmt->execute();
        if($stmt->rowCount()>0){
            throw new Exception('Ya hay un curso con este nombre');

        }
        $query1="UPDATE cursos SET nomb_cur=? where cod_cur=?";
        $stmt = $connect->prepare($query1);
        $stmt->bindParam(1,$nomb_cur);
        $stmt->bindParam(2,$cod_cur);
        $stmt->execute();
    }

    public function eliminarCurso() {
        // Implementa la lógica para eliminar un curso.
    }
}
?>

