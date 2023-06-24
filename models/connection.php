<?php

class Connection {
    static public function getConnection(){
        $host = "localhost";
        $port = "5432";
        $dbname = "notas_parciales";
        $username = "stiven";
        $password = "17347251";
        
        try {
            $conn = new PDO("pgsql:host=$host;port=$port; dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexion a la BD realizada correctamente!";
            return $conn;
        } catch (PDOException $e) {
            echo "Error al conectar con la Base de datos" . $e->getMessage();
            return null;
        }
    }
}