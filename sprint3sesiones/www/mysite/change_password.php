<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$db = new mysqli('localhost', 'root', '1234', 'mysitedb');
if ($db->connect_error) {
    die('<p>Error de conexión a la base de datos.</p>');
}

$user_id = $_SESSION['user_id'];

$current_password = $_POST['f_current_password'] ?? '';
$new_password = $_POST['f_new_password'] ?? '';
$new_password_confirm = $_POST['f_new_password_confirm'] ?? '';

if ($new_password !== $new_password_confirm) {
    die('<p>Error: La nueva contraseña y su confirmación no coinciden. <a href="change_password.html">Volver</a></p>');
}
if (strlen($new_password) < 6) { 
    die('<p>Error: La nueva contraseña debe tener al menos 6 caracteres. <a href="change_password.html">Volver</a></p>');
}

$stmt_select = $db->prepare("SELECT contraseña FROM tUsuarios WHERE id = ?");
$stmt_select->bind_param("i", $user_id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$user = $result->fetch_assoc();
$stmt_select->close();

if (!$user) {
    die('<p>Error de seguridad: Usuario no encontrado.</p>');
}

if (!password_verify($current_password, $user['contraseña'])) {
    die('<p>Error: La contraseña actual es incorrecta. <a href="change_password.html">Volver</a></p>');
}

$new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

$stmt_update = $db->prepare("UPDATE tUsuarios SET contraseña = ? WHERE id = ?");

$stmt_update->bind_param("si", $new_password_hashed, $user_id);

if ($stmt_update->execute()) {
    echo '<p style="color: green; font-weight: bold;">¡Contraseña cambiada exitosamente!</p>';
} else {
    echo '<p style="color: red;">Error al actualizar la contraseña.</p>';
}

$stmt_update->close();
$db->close();
echo '<p><a href="main.php">Volver a la página principal</a></p>';
?>