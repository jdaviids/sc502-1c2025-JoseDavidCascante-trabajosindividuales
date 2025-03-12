<?php

$transacciones = [];

function registrarTransaccion($id, $descripcion, $monto) {
    global $transacciones;
    $transacciones[] = [
        'id' => $id,
        'descripcion' => $descripcion,
        'monto' => $monto
    ];
}

function generarEstadoDeCuenta() {
    global $transacciones;
    $totalContado = 0;
    $detalleTransacciones = "DETALLE DE TRANSACCIONES:\n";
    
    foreach ($transacciones as $transaccion) {
        $detalleTransacciones .= "ID: " . $transaccion['id'] . " | " . $transaccion['descripcion'] . " | Monto: $" . number_format($transaccion['monto'], 2) . "\n";
        $totalContado += $transaccion['monto'];
    }
    
    $interes = 0.026 * $totalContado;
    $totalConInteres = $totalContado + $interes;
    $cashback = 0.001 * $totalContado;
    
    $resumen = "\nRESUMEN:\n";
    $resumen .= "Total de contado: $" . number_format($totalContado, 2) . "\n";
    $resumen .= "Total con interés (2.6%): $" . number_format($totalConInteres, 2) . "\n";
    $resumen .= "Cashback (0.1%): $" . number_format($cashback, 2) . "\n";
    
    $estadoCuenta = $detalleTransacciones . $resumen;
    
    echo nl2br($estadoCuenta);
    
    file_put_contents("estado_cuenta.txt", $estadoCuenta);
}


registrarTransaccion(1, "Compra en supermercado", 50.75);
registrarTransaccion(2, "Cena en restaurante", 30.20);
registrarTransaccion(3, "Compra en línea", 120.90);
registrarTransaccion(4, "Gasolina", 45.00);


generarEstadoDeCuenta();

?>
