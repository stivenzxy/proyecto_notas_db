<?php
class Nota
{
    private $db;

    public function __construct()
    {
    }

    public function getNombreCurso($cod_curso, $connect)
    {
        $query = 'SELECT nomb_curso FROM cursos WHERE cod_curso = :cod_curso';
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':cod_curso', $cod_curso);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getNotas($codigo, $connect)
    {
        $query = 'SELECT * FROM notas WHERE cod_curso = :cod_curso ORDER BY posicion ASC';
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':cod_curso', $codigo);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSumaPorcentajes($datos, $connect)
    {
        $query = 'SELECT SUM(porcentaje) as suma_porcentaje FROM notas WHERE cod_curso = :cod_curso';
        $stmt1 = $connect->prepare($query);
        $stmt1->bindParam(':cod_curso', $datos['cod_curso']);
        $stmt1->execute();

        $sumaPorcentajes = $stmt1->fetchColumn();
        return $sumaPorcentajes;
    }

    public function getPosicion($datos, $connect)
    {
        $query = 'SELECT posicion FROM notas WHERE posicion = :posicion AND cod_curso = :cod_curso';
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':posicion', $datos['posicion']);
        $stmt->bindParam(':cod_curso', $datos['cod_curso']);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPorcentaje($datos, $connect)
    {
        $query = 'SELECT porcentaje FROM notas WHERE posicion = :posicion AND cod_curso = :cod_curso';
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':posicion', $datos['posicion']);
        $stmt->bindParam(':cod_curso', $datos['cod_curso']);
        $stmt->execute();

     
        $porcentaje = $stmt->fetchColumn();
        return $porcentaje;
    }

    public function agregarNota($datos, $connect)
    {
        $query = 'INSERT INTO notas (posicion, descripcion, porcentaje,cod_curso) VALUES (:posicion,:descripcion, :porcentaje ,:cod_curso)';
        $stmt2 = $connect->prepare($query);
        $stmt2->bindParam(':posicion', $datos['posicion']);
        $stmt2->bindParam(':descripcion', $datos['descripcion']);
        $stmt2->bindParam(':porcentaje', $datos['porcentaje']);
        $stmt2->bindParam(':cod_curso', $datos['cod_curso']);


        if ($stmt2->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizarNota($datos, $connect)
    {
        $query = 'UPDATE notas SET posicion = :posicion, descripcion = :descripcion, porcentaje = :porcentaje, cod_curso = :cod_curso WHERE posicion = :posicion AND cod_curso = :cod_curso';
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':porcentaje', $datos['porcentaje']);
        $stmt->bindParam(':posicion', $datos['posicion']);
        $stmt->bindParam(':cod_curso', $datos['cod_curso']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarNota($datos, $connect)
{
    $query = 'DELETE FROM notas WHERE posicion = :posicion AND cod_curso = :cod_curso';
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':posicion',$datos['posicion']);
    $stmt->bindParam(':cod_curso',$datos['cod_curso']);


    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
}