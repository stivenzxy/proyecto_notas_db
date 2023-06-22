<?php
require "connection.php";
class User{
  private $connect;
  public function __construct(){
    $this->connect = Connection::getConnection();
  }
  public function findByUsernameAndPassword($username, $password){
    //  $query = "SELECT * FROM users WHERE username=:$username AND pasword=:$password";
    $query = "SELECT * FROM users WHERE username = ? AND pasword = ?";
    
    //statement
    $stmt = $this->connect->prepare($query);
    // bindParam() agrega variables a una sentencia preparada como parametros
    //$stmt->bindParam(':username',$username);
    //$stmt->bindParam(':pasword',$password);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password);
    $stmt->execute(); // ejecuta la consulta

    return $stmt->fetchAll(PDO::FETCH_ASSOC); // obtiene la fila de un conjunto de resultados como un arreglo de arreglos
  }

  public function getRolById($username){
    $query = "SELECT role_id FROM users WHERE username = ?";
    
    $stmt = $this->connect->prepare($query);
    $stmt->bindParam(1,$username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // obtiene una fila de resultados como un arreglo asociativo, numerico o mixto
    $role = $result['role_id'];

    return $role;
  }
}
?>