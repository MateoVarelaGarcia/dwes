<?php
// 1. Conexión a la base de datos (Ajusta los datos de conexión)
$db = new mysqli('localhost', 'root', '1234', 'web_canciones');
if ($db->connect_error) {
    die('<p>Error de conexión a la base de datos.</p>');
}

// 2. Recuperar datos
$email_posted = $_POST['f_email'] ?? '';
$password_posted = $_POST['f_password'] ?? '';

// 3. Buscar el usuario y obtener el hash de la contraseña (Prepared Statement)
// Consulta: SELECT id, contraseña FROM tUsuarios WHERE email = ?
$query = "SELECT id, contraseña FROM tUsuarios WHERE email = ?";
$stmt = $db->prepare($query);

// Enlazar parámetro 's' (string)
$stmt->bind_param("s", $email_posted);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Usuario no encontrado [cite: 222-223]
    echo '<p>Usuario no encontrado con ese email</p>';
    $stmt->close();
} else {
    // Usuario encontrado
    $only_row = $result->fetch_assoc();
    $stmt->close();

    // 4. Verificar la contraseña usando password_verify() [cite: 228]
    if (password_verify($password_posted, $only_row['contraseña'])) {
        // Éxito: Contraseña correcta. Iniciar sesión. [cite: 98]
        session_start();
        $_SESSION['user_id'] = $only_row['id']; // Almacena el ID del usuario [cite: 101]
        header('Location: main.php'); // Redirigir a la página principal [cite: 99]
        exit;
    } else {
        // Contraseña incorrecta [cite: 222-223]
        echo '<p>Contraseña incorrecta</p>';
    }
}

$db->close();
?>