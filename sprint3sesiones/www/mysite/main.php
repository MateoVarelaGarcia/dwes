<?php
$db = mysqli_connect('localhost', 'root', '1234', 'mysitedb') or die('Fail');
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Mis Películas</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; text-align: center; }
        h1 { color: #333; }
        .pelicula {
            display: inline-block;
            margin: 15px;
            padding: 10px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 200px;
        }
        img { width: 180px; height: 260px; border-radius: 6px; object-fit: cover; }
        a { text-decoration: none; color: #007BFF; font-weight: bold; }
        a:hover { color: #0056b3; }
    </style>
</head>
<body>
<h1>Catálogo de Películas</h1>

<?php
$query = 'SELECT * FROM tPeliculas';
$result = mysqli_query($db, $query) or die('Query error');

while ($row = mysqli_fetch_array($result)) {
    echo '<div class="pelicula">';
    echo '<img src="'.$row['url_imagen'].'" alt="'.$row['nombre'].'"><br>';
    echo '<a href="detail.php?id='.$row['id'].'">'.$row['nombre'].'</a><br>';
    echo '<p>'.$row['director'].' ('.$row['año'].')</p>';
    echo '</div>';
}
mysqli_close($db);
?>

</body>
</html>