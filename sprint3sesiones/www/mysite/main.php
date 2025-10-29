<?php
session_start();

$db = new mysqli('localhost', 'root', '1234', 'mysitedb');
if ($db->connect_error) {
    die('Fail: ' . $db->connect_error);
}
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

            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out; 
            cursor: pointer;
        }

        .pelicula:hover {
            opacity: 0.9; 
            transform: scale(1.03);
            
        }

        img { width: 180px; height: 260px; border-radius: 6px; object-fit: cover; }
        a { text-decoration: none; color: #007BFF; font-weight: bold; }
        a:hover { color: #0056b3; }
    </style>
</head>
<body>
<header>
    <h1>Catálogo de Películas</h1>
    <nav style="margin-bottom: 20px;">
        <?php 
        if (isset($_SESSION['user_id'])) {
            echo '<p>Usuario logueado | <a href="logout.php">Cerrar Sesión</a></p>';
        } else {
            echo '<p><a href="login.html">Iniciar Sesión</a> | <a href="register.html">Registrarse</a></p>';
        }
        ?>
    </nav>
</header>

<?php
$query = 'SELECT * FROM tPeliculas';

$result = $db->query($query);

if (!$result) {
    die('Query error: ' . $db->error);
}

while ($row = $result->fetch_assoc()) {
    echo '<div class="pelicula">';

    echo '<img src="'.htmlspecialchars($row['url_imagen']).'" alt="'.htmlspecialchars($row['nombre']).'"><br>';
    echo '<a href="detail.php?id='.htmlspecialchars($row['id']).'">'.htmlspecialchars($row['nombre']).'</a><br>';
    echo '<p>'.htmlspecialchars($row['director']).' ('.htmlspecialchars($row['año']).')</p>';
    echo '</div>';
}
$db->close();
?>

</body>
</html>