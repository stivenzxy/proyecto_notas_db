<?php
class Nota {
    private $db;

    public function __construct() {
    }


    public function AgregarCalificacion($valor,$nota,$cod_curso, $cod_est, $anio, $periodo, $connect){

        try {
            $fecha = date('Y-m-d');
            $query = "INSERT into calificaciones (valor, fecha, cod_curso, cod_est, periodo, anio, nota) values ($valor,'$fecha',$cod_curso,$cod_est,$periodo,$anio,$nota);";
            $stmt = $connect->prepare($query);    
            return $stmt->execute();
            }
        
        catch (PDOException $exception){
            return 'Error: ' . $exception->getMessage();
        }

}

    
    public function verificarCalificacion($cod,$connect) {
        $query = 'SELECT i.cod_est,e.nomb_est,c.valor,c.nota,i.cod_curso,i.anio, i.periodo,c.cod_cal FROM inscripciones i LEFT JOIN calificaciones c on i.cod_curso = c.cod_curso join estudiantes e on e.cod_est = i.cod_est where cod_curso = $cod_curso AND nota = $cod_nota or nota is null and cod_cur = $cod_cur order by e.nomb_est';
        $stmt = $connect->prepare($query);
        return($stmt->execute()) ? $stmt->fetchAll(): false;
    }
    

    public function editarCalificacion($datos,$connect) {
        $query = 'SELECT SUM(porcentaje) as suma_porcentaje FROM notas WHERE cod_curso = :cod_curso';
        $stmt1=$connect->prepare($query);
        $stmt1->bindParam(':cod_curso', $datos['cod_curso']);
        $stmt1->execute();

        $sumaPorcentajes = $stmt1->fetchColumn();
		return $sumaPorcentajes;
    }

 
    public function agregarNota($datos,$connect) {
        $query = 'INSERT INTO notas (posicion, descripcion, porcentaje,cod_curso) VALUES (:posicion,:descripcion, :porcentaje ,:cod_curso)';
        $stmt2=$connect->prepare($query);
        $stmt2->bindParam(':posicion', $datos['posicion']);
        $stmt2->bindParam(':descripcion', $datos['descripcion']);
        $stmt2->bindParam(':porcentaje', $datos['porcentaje']);
        $stmt2->bindParam(':cod_curso', $datos['cod_curso']);


        if($stmt2->execute()){
            return true;
        } else {
            return false;
        }
    }
}