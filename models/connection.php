<?php

class Connection {
    static public function getConnection(){
        $host = "database-notas.ckq1ztccobtx.us-east-2.rds.amazonaws.com";
        $port = "5432";
        $dbname = "database_notasest8";
        $username = "rediah10k";
        $password = "pg54321*";
        
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