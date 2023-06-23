<?php
class User{
  public function findByUsernameAndPassword($code, $password, $connect){
    //  $query = "SELECT * FROM users WHERE username=:$username AND pasword=:$password";
    $query = "SELECT * FROM usuarios where codigo_usr=? and passhash=crypt(?, gen_salt('bf', 4))";
    
    $stmt = $connect->prepare($query);
    $stmt->bindParam(1, $code);
    $stmt->bindParam(2, $password);
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
  }

}
?>