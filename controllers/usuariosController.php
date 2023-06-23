<?php
require "../models/connection.php";
require "../models/usuariosModel.php";
class LoginController extends Connection{
    private $usuarioModel;
    public function __construct(){
        $this->usuarioModel = new User();
        $this->connect = $this->getConnection();
    }
    }
    public function login(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['user']; 
            $password = $_POST['pass'];
            
            $user = $this->usuarioModel->findByUsernameAndPassword($username, $password);
            
            if ($user !== false) {
                header("Location: http://localhost:8080/proyecto_notas_db/home.php")  
                       
        }
        
        
    }
}
    $formAction = new LoginController();
    $formAction->login();
    
