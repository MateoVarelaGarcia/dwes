<html>
<body>
<h1>Conversor de Temperaturas</h1>

<form method="post" action="">
    <label for="cantidad">Cantidad:</label>
    <input type="number" step="any" name="cantidad" id="cantidad" required><br><br>

    <input type="radio" name="conversion" value="CtoF" required> Celsius → Fahrenheit<br>
    <input type="radio" name="conversion" value="FtoC"> Fahrenheit → Celsius<br><br>

    <input type="submit" value="Convertir">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Asegurarse de que se enviaron los datos
    if (isset($_POST["cantidad"]) && isset($_POST["conversion"])) {
        $cantidad = floatval($_POST["cantidad"]);
        $tipo = $_POST["conversion"];

        if ($tipo == "CtoF") {
            $resultado = ($cantidad * 9/5) + 32;
            echo "<p>$cantidad °C = " . round($resultado, 2) . " °F</p>";
        } elseif ($tipo == "FtoC") {
            $resultado = ($cantidad - 32) * 5/9;
            echo "<p>$cantidad °F = " . round($resultado, 2) . " °C</p>";
        } else {
            echo "<p>Conversión no válida.</p>";
        }
    } else {
        echo "<p>Por favor, introduce todos los datos.</p>";
    }
}
?>
</body>
</html>
