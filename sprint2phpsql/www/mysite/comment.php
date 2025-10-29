<?php

$db = mysqli_connect('localhost', 'root', '1234', 'mysitedb') or die('Fail');

$new_comment = $_POST['new_comment'];
$pelicula_id = $_POST['pelicula_id'];
$usuario_id = $_POST['usuario_id'];

$query = "INSERT INTO tComentarios (comentario, usuario_id, pelicula_id) 
          VALUES ('$new_comment', '$usuario_id', '$pelicula_id')";
mysqli_query($db, $query) or die('Error al insertar comentario');

echo "<h3>Comentarios actualizados:</h3>";
echo "<ul>";

$query2 = 'SELECT c.comentario, c.fecha, u.nombre 
           FROM tComentarios c
           LEFT JOIN tUsuarios u ON c.usuario_id = u.id
           WHERE c.pelicula_id='.$pelicula_id.'
           ORDER BY c.fecha DESC';
$result2 = mysqli_query($db, $query2) or die('Query error');

while ($row = mysqli_fetch_array($result2)) {
    echo '<li><b>'.$row['nombre'].'</b> ('.$row['fecha'].')<br>'.$row['comentario'].'</li>';
}

echo "</ul>";

mysqli_close($db);

echo '<p><a href="/detail.php?id='.$pelicula_id.'">Volver a la película</a></p>';
?>
