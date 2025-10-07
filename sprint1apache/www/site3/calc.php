<html>
<body>
<h1>Calculadora</h1>

<form method="post" action="calc.php">
    <input type="number" step="any" name="num1" required>
    <select name="operacion">
        <option value="suma">+</option>
        <option value="resta">-</option>
        <option value="multiplicacion">*</option>
        <option value="division">/</option>
    </select>
    <input type="number" step="any" name="num2" required>
    <input type="submit" value="Calcular">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n1 = $_POST["num1"];
    $n2 = $_POST["num2"];
    $op = $_POST["operacion"];
    $resultado = 0;

    switch ($op) {
        case "suma":
            $resultado = $n1 + $n2;
            echo "<p>$n1 + $n2 = $resultado</p>";
            break;
        case "resta":
            $resultado = $n1 - $n2;
            echo "<p>$n1 - $n2 = $resultado</p>";
            break;
        case "multiplicacion":
            $resultado = $n1 * $n2;
            echo "<p>$n1 * $n2 = $resultado</p>";
            break;
        case "division":
            if ($n2 != 0) {
                $resultado = $n1 / $n2;
                echo "<p>$n1 / $n2 = " . round($resultado, 2) . "</p>";
            } else {
                echo "<p>No se puede dividir entre 0.</p>";
            }
            break;
    }
}
?>
</body>
</html>
