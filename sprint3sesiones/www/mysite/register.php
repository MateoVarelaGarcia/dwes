<?php

$db = new mysqli('localhost', 'root', '1234', 'mysitedb');
if ($db->connect_error) { die('<p>Error de conexión a la base de datos.</p>'); }

$email = $_POST['f_email'] ?? '';
$nombre = $_POST['f_nombre'] ?? '';
$apellidos = $_POST['f_apellidos'] ?? '';
$password = $_POST['f_password'] ?? '';
$password_confirm = $_POST['f_password_confirm'] ?? '';

if ($password !== $password_confirm) {
    die('<p>Error: Las contraseñas no coinciden.</p><p><a href="register.html">Volver</a></p>');
}

$stmt_check = $db->prepare("SELECT id FROM tUsuarios WHERE email = ?");
$stmt_check->bind_param("s", $email); 
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    $stmt_check->close();
    die('<p>Error: El correo electrónico ya está registrado.</p><p><a href="register.html">Volver</a></p>');
}
$stmt_check->close();

$password_hashed = password_hash($password, PASSWORD_DEFAULT);

$insert_query = "INSERT INTO tUsuarios (email, nombre, apellidos, contraseña) VALUES (?, ?, ?, ?)";
$stmt_insert = $db->prepare($insert_query);
$stmt_insert->bind_param("ssss", $email, $nombre, $apellidos, $password_hashed);

if ($stmt_insert->execute()) {
    $stmt_insert->close();
    $db->close();
    echo "<p>¡Registro exitoso! Redirigiendo a Iniciar Sesión...</p>";
    echo '<script>setTimeout(function() { window.location.href = "login.html"; }, 2000);</script>';
    exit;
} else {
    $stmt_insert->close();
    die('<p>Error al registrar el usuario.</p>');
}
?>