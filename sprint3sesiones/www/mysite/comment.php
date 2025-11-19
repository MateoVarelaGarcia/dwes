<?php
session_start(); 

$db = new mysqli('172.16.0.2', 'root', '1234', 'mysitedb');
if ($db->connect_error) { die('Fallo en la conexión a la base de datos.'); }

$user_id_a_insertar = $_SESSION['user_id'] ?? null;
$pelicula_id = $_POST['pelicula_id'] ?? null;
$comentario = $_POST['new_comment'] ?? null;

if (is_null($pelicula_id) || is_null($comentario)) {
    die('<p>Faltan datos para el comentario.</p>');
}

if (!is_null($user_id_a_insertar)) {
    $insert_query = "INSERT INTO tComentarios (comentario, pelicula, usuario) VALUES (?, ?, ?)";
    $stmt = $db->prepare($insert_query);
    $stmt->bind_param("sii", $comentario, $pelicula_id, $user_id_a_insertar);
} else {
    $insert_query = "INSERT INTO tComentarios (comentario, pelicula) VALUES (?, ?)";
    $stmt = $db->prepare($insert_query);
    $stmt->bind_param("si", $comentario, $pelicula_id);
}

if ($stmt->execute()) {
    echo "<p>Nuevo comentario añadido.</p>";
} else {
    echo "<p>Error al añadir el comentario.</p>";
}

$stmt->close();
$db->close();
?>
<html>
<body>
    <?php
    echo "<a href='detail.php?id=" . htmlspecialchars($pelicula_id) . "'>Volver a la Película</a>";
    ?>
</body>
</html>