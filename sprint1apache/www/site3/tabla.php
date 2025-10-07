<html>
<body>
<h1>Tabla del 7</h1>
<table border="1" cellpadding="5">
<tr><th>Operación</th><th>Resultado</th></tr>
<?php
for ($i = 1; $i <= 10; $i++) {
    $resultado = 7 * $i;
    echo "<tr><td>7 x $i</td><td>$resultado</td></tr>";
}
?>
</table>
</body>
</html>
