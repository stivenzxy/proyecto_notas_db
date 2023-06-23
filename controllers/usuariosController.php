<?php
require('../models/connection.php');
require('../models/usuariosModel.php');
class LoginController extends Connection{
    private $usuarioModel;
    public $connect;
    public function __construct(){
        $this->usuarioModel = new User();
        $this->connect = $this->getConnection();
    }

    public function login(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['code']; 
            $password = $_POST['pass'];         
            $user = $this->usuarioModel->findByUsernameAndPassword($username, $password,$this->connect);
            var_dump($user);
            if (count($user) > 0) {
                /*header("Location: http://home.php"); */    
                echo json_encode(array('success'=>1));            
            } else{
                /*$var = "Hola Pepe";
                echo'<script type="text/javascript">
                alert("Tarea Guardada");
                window.location.href="http://index.php";
                </script>'; */
                echo json_encode(array('success'=>0));
            }   
        }
    }
    }

    $formAction = new LoginController();
    $formAction->login();
    
