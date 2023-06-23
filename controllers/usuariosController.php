<?php
//require "../models/connection.php";
require "../models/usuariosModel.php";
class LoginController{
    private $userModel;
    public function __construct(){
        $this->userModel = new User();
    }
    }
    public function login(){
        /*
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['user']; 
            $password = $_POST['pass'];
            
            $user = $this->userModel->findByUsernameAndPassword($username, $password);
            
            if ($user !== false) {
                // El resultado no está vacío
                $value = $result['authenticate'];
            
                 if ($value == 'v') {
                    echo json_encode(array('success'=>1));
                } else if ($value == 'f') {
                    echo json_encode(array('success'=>2));
                }
                       
        }
        */ 
        header("Location: http://localhost:8080/proyecto_notas_db/home.php")
    }
    $formAction = new LoginController();
    $formAction->login();
    
