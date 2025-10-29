<?php
$db = mysqli_connect('localhost', 'root', '1234', 'mysitedb') or die('Fail');

$new_comment = $_POST['new_comment'];
$pelicula_id = $_POST['pelicula_id'];
$usuario_id = $_POST['usuario_id'];

$query = "INSERT INTO tComentarios (comentario, usuario_id, pelicula_id) 
          VALUES ('$new_comment', '$usuario_id', '$pelicula_id')";
mysqli_query($db, $query) or die('Error al insertar comentario');

mysqli_close($db);

echo "<p>Comentario añadido correctamente.</p>";
echo '<a href="/detail.php?id='.$pelicula_id.'">Volver a la película</a>';
?>
