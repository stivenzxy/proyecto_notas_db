<?php
class cursosModel {
    public function getCursos($codigo_usr, $connect) {
        $query = "SELECT * FROM cursos where codigo_usr=?";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(1,$codigo_usr);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarCurso() {
        // Implementa la lógica para insertar un curso.
    }

    public function eliminarCurso() {
        // Implementa la lógica para eliminar un curso.
    }
}
?>

