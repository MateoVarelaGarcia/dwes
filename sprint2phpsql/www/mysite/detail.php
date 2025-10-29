<?php
$db = mysqli_connect('localhost', 'root', '1234', 'mysitedb') or die('Fail');

if (!isset($_GET['id'])) {
    die('No se ha especificado una película');
}

$id = $_GET['id'];
$query = 'SELECT * FROM tPeliculas WHERE id='.$id;
$result = mysqli_query($db, $query) or die('Query error');
$pelicula = mysqli_fetch_array($result);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pelicula['nombre']; ?></title>
    <style>
        body { font-family: Arial; background-color: #fafafa; text-align: center; }
        img { width: 250px; height: 350px; border-radius: 8px; margin-bottom: 15px; }
        ul { list-style: none; padding: 0; }
        li { background: #fff; margin: 5px auto; padding: 10px; width: 60%; border-radius: 6px; border: 1px solid #ddd; }
        a { color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>

<h1><?php echo $pelicula['nombre']; ?></h1>
<img src="<?php echo $pelicula['url_imagen']; ?>">
<p><b>Director:</b> <?php echo $pelicula['director']; ?></p>
<p><b>Año:</b> <?php echo $pelicula['año']; ?></p>

<h3>Comentarios:</h3>
<ul>
<?php
$query2 = 'SELECT c.comentario, u.nombre 
           FROM tComentarios c
           LEFT JOIN tUsuarios u ON c.usuario_id = u.id
           WHERE c.pelicula_id='.$id;
$result2 = mysqli_query($db, $query2) or die('Query error');
while ($row = mysqli_fetch_array($result2)) {
    echo '<li><b>'.$row['nombre'].':</b> '.$row['comentario'].'</li>';
}
?>
</ul>

</body>
</html>

<?php mysqli_close($db); ?>
