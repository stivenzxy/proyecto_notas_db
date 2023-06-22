<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="css/login.css">
	<link rel="shortcut icon" href="resources/login.ico" type="image/x-icon">
	<script src="https://kit.fontawesome.com/e562395e64.js" crossorigin="anonymous"></script>
</head>

<body>
	<form method="post" id="loginForm" action="controllers/usuariosController.php">
		<div class="title">Iniciar Sesion</div>
		<label>
			<i class="fa-solid fa-user"></i>
			<input placeholder="nombre de usuario" type="text" id="user" name="user" required>
		</label>
		<label>
			<i class="fa-solid fa-lock"></i>
			<input placeholder="contraseña" type="password" id="pass" name="pass" required>
		</label>
		<a href="#" class="link">Olvidaste tu contraseña?</a>

		<button type="submit" id="button">Login</button>
		<!--<p style="display: inline;">¿No tienes una cuenta?</p>
		<a href="#" style="display: inline;" class="register">Registrate</a>-->
		<div style="margin-top: 15px;" class="register">
  			<a>¿No tienes una cuenta?</a>
  			<a style="color: #E96BCC;" href="views/newUserView.php" class="link2">Registrate</a>
		</div>
		<br><br>
		<div id="alerta"></div>

	</form>
	<script type="module" src="assets/mainLogin.js"></script>
</body>

</html>