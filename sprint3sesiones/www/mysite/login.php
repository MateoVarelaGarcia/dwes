<?php
session_start();
$db = new mysqli('localhost', 'root', '1234', 'mysitedb');
if ($db->connect_error) { die('<p>Error de conexión a la base de datos.</p>'); }

$email_posted = $_POST['f_email'] ?? '';
$password_posted = $_POST['f_password'] ?? '';

$query = "SELECT id, contraseña FROM tUsuarios WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $email_posted);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo '<p>Usuario o contraseña incorrectos. <a href="login.html">Volver</a></p>';
} else {
    $only_row = $result->fetch_assoc();
    
    if (password_verify($password_posted, $only_row['contraseña'])) {
        $_SESSION['user_id'] = $only_row['id'];
        $stmt->close();
        $db->close();
        header('Location: main.php');
        exit;
    } else {
        echo '<p>Usuario o contraseña incorrectos. <a href="login.html">Volver</a></p>';
    }
}
$db->close();
?>