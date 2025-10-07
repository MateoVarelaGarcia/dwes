<html>
<body>
<h1>Carrito de compra</h1>
<table border="1" cellpadding="5">
<tr><th>Producto</th><th>Precio (€)</th></tr>
<?php
$carrito = array(
    "Manzana" => 0.80,
    "Pan" => 1.35,
    "Leche" => 0.79,
    "Huevos" => 2.30
);

$total = 0;

foreach ($carrito as $producto => $precio) {
    echo "<tr><td>$producto</td><td>" . number_format($precio, 2) . "€</td></tr>";
    $total += $precio;
}
echo "<tr><td><strong>TOTAL</strong></td><td><strong>" . number_format($total, 2) . "€</strong></td></tr>";
?>
</table>
</body>
</html>
