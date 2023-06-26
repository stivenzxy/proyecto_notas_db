<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-egde">
    <title>inicio</title>
    <!--<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/necolas.github.io_normalize.css_8.0.1_normalize.css">
    <link rel="shortcut icon" href="resources/login.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/stylesLogin.css">
</head>

<body>
    <div class="contenedor-formulario contenedor">
        <div class="imagen-formulario">
            <img src="resources/unillanos.jpg" alt="Imagen de Fondo">
            <div class="capa-degradada"></div>
        </div>
        <form action="controllers/login.php" class="formulario" method="post">
            <div class="texto-formulario">
                <img src="resources/logoUnillanos.png" alt="Logo" class="logo">
                <h2>Bienvenido</h2>
                <p>inicia sesión con tu cuenta</p>
            </div>

            <div class="input">
                <label for="username">Codigo de docente:</label>
                <input placeholder="ingrese su codigo de docente" type="number" id="username" name="codigo" required><br><br>
            </div>

            <div class="input">
                <label for="password">Contraseña:</label>
                <input placeholder="Ingrese su contraseña" type="password" id="password" name="password"
                    required><br><br>
            </div>
            <div class="input">
                <input type="submit" value="Iniciar sesión">
            </div>
        </form>
    </div>
</body>
</html>