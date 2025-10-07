<html>
<body>
<h1>Login</h1>

<form method="post" action="login.php">
    <label>Usuario:</label>
    <input type="text" name="usuario" required><br><br>
    <label>Contraseña:</label>
    <input type="password" name="clave" required><br><br>
    <input type="submit" value="Entrar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    if ($usuario == "admin" && $clave == "1234") {
        echo "<p style='color:green;'>Acceso concedido ✅</p>";
    } else {
        echo "<p style='color:red;'>Acceso denegado ❌</p>";
    }
}
?>
</body>
</html>
