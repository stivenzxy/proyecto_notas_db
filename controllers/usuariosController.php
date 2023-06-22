<?php
//require "../models/connection.php";
require "../models/usuariosModel.php";
class LoginController{
    private $userModel;
    public function __construct(){
        $this->userModel = new User();
    }
    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['user']; 
            $password = md5($_POST['pass']);

            $user = $this->userModel->findByUsernameAndPassword($username, $password);
            $verifyRole = $this->userModel->getRolById($username);

            if ($user && count($user) > 0) {
               // session_start();
                $_SESSION['user'] = $user; // almacena la sesion del usuario actual
                if($verifyRole == 1){ 
                    echo json_encode(array('success'=>1));
                    /*header("Location: ../views/adminView.php");*/
                } else if($verifyRole == 2){
                    echo json_encode(array('success'=>2));
                    /*header("Location: ../views/clientView.php");*/
                }
            } else {
                echo json_encode(array('success'=>3));
            }
        }
    }
    $formAction = new LoginController();
    $formAction->login();
}