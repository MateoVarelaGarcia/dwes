<?php
session_start();


$db = new mysqli('172.16.0.2', 'root', '1234', 'mysitedb');
if ($db->connect_error) {
    die('Fail: ' . $db->connect_error);
}

if (!isset($_GET['id'])) {
    die('No se ha especificado una película');
}

$id = $_GET['id'];


$stmt_pelicula = $db->prepare('SELECT * FROM tPeliculas WHERE id = ?');

$stmt_pelicula->bind_param('i', $id);
$stmt_pelicula->execute();
$result_pelicula = $stmt_pelicula->get_result();
$pelicula = $result_pelicula->fetch_assoc();
$stmt_pelicula->close();

if (!$pelicula) {
    die('Película no encontrada.');
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($pelicula['nombre']); ?></title>
    <style>
        body { font-family: Arial; background-color: #fafafa; text-align: center; }
        img { width: 250px; height: 350px; border-radius: 8px; margin-bottom: 15px; }
        ul { list-style: none; padding: 0; }
        li { background: #fff; margin: 5px auto; padding: 10px; width: 60%; border-radius: 6px; border: 1px solid #ddd; text-align: left; }
        a { color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>

<header>
    <nav style="margin-bottom: 20px;">
        <a href="main.php">Volver a la Lista</a>
        <?php 
        if (isset($_SESSION['user_id'])) {
            echo ' | <a href="logout.php">Cerrar Sesión</a>';
        } else {
            echo ' | <a href="login.html">Iniciar Sesión</a>';
        }
        ?>
    </nav>
</header>

<h1><?php echo htmlspecialchars($pelicula['nombre']); ?></h1>
<img src="<?php echo htmlspecialchars($pelicula['url_imagen']); ?>" alt="<?php echo htmlspecialchars($pelicula['nombre']); ?>">
<p><b>Director:</b> <?php echo htmlspecialchars($pelicula['director']); ?></p>
<p><b>Año:</b> <?php echo htmlspecialchars($pelicula['año']); ?></p>

<h3>Comentarios:</h3>
<ul>
<?php

$query_comments = 'SELECT c.comentario, u.nombre 
                   FROM tComentarios c
                   LEFT JOIN tUsuarios u ON c.usuario = u.id  
                   WHERE c.pelicula = ?';

$stmt_comments = $db->prepare($query_comments);
$stmt_comments->bind_param('i', $id);
$stmt_comments->execute();
$result_comments = $stmt_comments->get_result();

while ($row = $result_comments->fetch_assoc()) {
    $nombre = $row['nombre'] ? htmlspecialchars($row['nombre']) : 'Anónimo';
    $comentario = htmlspecialchars($row['comentario']);
    echo "<li><b>{$nombre}:</b> {$comentario}</li>";
}
$stmt_comments->close();
?>
</ul>

<p>Deja un nuevo comentario:</p>
<form action="comment.php" method="post">
    <textarea rows="4" cols="50" name="new_comment" required></textarea><br>
    <input type="hidden" name="pelicula_id" value="<?php echo htmlspecialchars($id); ?>">
    
    <?php if (!isset($_SESSION['user_id'])): ?>
        <p style="color: red;">* Inicia sesión para que tu comentario aparezca con tu nombre.</p>
    <?php endif; ?>

    <input type="submit" value="Comentar">
</form>


</body>
</html>

<?php $db->close(); ?>
