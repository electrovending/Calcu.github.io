<?php
function calcularValores($valorInicial, $cantidad, $porcentaje) {
    $valoresCrecientes = [];
    $valoresDecrecientes = [];

    for ($i = 0; $i < $cantidad; $i++) {
        $valoresCrecientes[] = $valorInicial * pow(1 + $porcentaje / 100, $i);
        $valoresDecrecientes[] = $valorInicial * pow(1 - $porcentaje / 100, $i);
    }

    return [$valoresCrecientes, $valoresDecrecientes];
}

function calcularMonedas($valorInicial, $cantidad) {
    // Calcula la cantidad de monedas según la lógica especificada
    $monedas = 1; // Inicialmente, tienes 1 moneda
    for ($i = 1; $i <= $cantidad; $i++) {
        if ($i % 2 === 1) {
            // Si es impar, duplica la cantidad de monedas
            $monedas *= 2;
        } else {
            // Si es par, suma el valor actual al total de monedas
            $monedas += $valorInicial;
        }
    }
    return $monedas;
}

echo "Ingresa el valor inicial: ";
$valorInicial = (float) readline();

echo "Ingresa la cantidad de valores a calcular: ";
$cantidad = (int) readline();

echo "Ingresa el porcentaje de incremento: ";
$porcentaje = (float) readline();

$valores = calcularValores($valorInicial, $cantidad, $porcentaje);

echo "\nValores SHORT:\n";
$valoresInvertidos = array_reverse($valores[0]);
$indicesInvertidos = array_reverse(range(0, count($valoresInvertidos) - 1));
$valoresTabla = array_map(function ($valor, $index) use ($indicesInvertidos) {
    return [$indicesInvertidos[$index], $valor];
}, $valoresInvertidos, array_keys($valoresInvertidos));
echo implode("\t", ["Índice", "Valor"]) . PHP_EOL;
foreach ($valoresTabla as $fila) {
    echo implode("\t", $fila) . PHP_EOL;
}

echo "\n--------------------------------------------------\n\n";
echo "Valores LONG:\n";
$valoresLong = $valores[1];
echo implode("\t", ["Índice", "Valor"]) . PHP_EOL;
foreach ($valoresLong as $index => $valor) {
    echo implode("\t", [$index, $valor]) . PHP_EOL;
}

echo "\nIngresa la cantidad inicial de monedas: ";
$cantidadMonedas = (int) readline();
$monedasCalculadas = calcularMonedas($valorInicial, $cantidadMonedas);
echo "Cantidad de monedas después de $cantidadMonedas operaciones: $monedasCalculadas\n";
?>
