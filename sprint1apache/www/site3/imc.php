<html>
<body>
<h1>Cálculo del IMC</h1>
<?php
function calcular_imc($peso, $altura) {
    return $peso / ($altura * $altura);
}

if (isset($_GET["peso"]) && isset($_GET["altura"])) {
    $peso = $_GET["peso"];
    $altura = $_GET["altura"];
    $imc = calcular_imc($peso, $altura);

    echo "<p>Tu IMC es: " . round($imc, 2) . "</p>";

    if ($imc < 18.5) {
        echo "<p>Bajo peso</p>";
    } elseif ($imc < 25) {
        echo "<p>Normal</p>";
    } else {
        echo "<p>Sobrepeso</p>";
    }
} else {
    echo "<p>Por favor, introduce peso y altura en la URL.</p>";
}
?>
</body>
</html>
