<?php
require('../models/connection.php');

$conn = Connection::getConnection();
$codigo_usr = $_POST["codigo"];
$password = $_POST["password"];

$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM usuarios WHERE codigo_usr = :codigo AND passhash = crypt(:pasword, passhash)");
$stmt->bindParam(':codigo', $codigo_usr);
$stmt->bindParam(':pasword', $password);
$stmt->execute();

$count = $stmt->fetchColumn();

if ($count > 0) {
    header('Location: ../home.php');
} else {
    echo '<script>
            alert("Código de usuario o contraseña incorrectos");
            history.back();
        </script>';
}
$conn = null;
?>