
<?php
/*require "models/connection.php";
$connect = (new Connection())->getConnection();
if(isset($_POST['iniciar_sesion'])){
	session_start();
	$usuario = $_POST['code'];
	$contrasena = $_POST['password'];

	$query = 'SELECT authenticate(:user, :contrasena)';
	

	$stmt = $this->connect->prepare($query);
	$stmt->bindParam(':user', $usuario);
	$stmt->bindParam(':contrasena', $contrasena);
	$stmt->execute();
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if ($res !== false) {
		$value = $res['authenticate'];
		var_dump($value);
		
		if ($value == 1) {
			// El valor es "v"
			$_SESSION['usuario'] = $usuario;
		$_SESSION['id_usuario'] = $id_usuario;
		header('Location: home.php');
		} elseif ($value == 0) {
			// El valor es "f"
			echo "<script type=\"text/javascript\">alert(\"Usuario Errado o Contraseña Errada\");</script>";
		}
		
	}
	
}

*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="css/login.css">
	<link rel="shortcut icon" href="resources/login.ico" type="image/x-icon">
	<script src="node_modules/sweetalert2/dist/sweetalert2.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.css">
	<script src="https://kit.fontawesome.com/e562395e64.js" crossorigin="anonymous"></script>
</head>

<body>
	<form id="loginForm" action="controllers/usuariosController.php" method="post">
		<div class="title">Iniciar Sesion</div>
		<label>
			<i class="fa-solid fa-user"></i>
			<input type="number" name="code" min="0" max="999999999"placeholder="Introduce tu codigo" required>
		</label>
		<label>
			<i class="fa-solid fa-lock"></i>
			<input type="password" name="pass" placeholder="Introduce tu contraseña">

        
		</label>
		<a href="#" class="link">Olvidaste tu contraseña?</a>

		<button type="submit" id="" name="iniciar_sesion">Login</button>
		<!--<p style="display: inline;">¿No tienes una cuenta?</p>
		<a href="#" style="display: inline;" class="register">Registrate</a>-->
		<div style="margin-top: 15px;" class="register">
  			<a>¿No tienes una cuenta?</a>
  			<a style="color: #E96BCC;" href="views/newUserView.php" class="link2">Registrate</a>
		</div>
		<br><br>

	</form>
	<script type="module" src="./js/mainLogin.js"></script>
</body>

</html>



  







