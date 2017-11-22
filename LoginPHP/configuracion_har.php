<?php
$mysqli = mysqli_connect(
    '127.0.0.1', 
    'root', 
    'equipohar123',
    'testing_har' );
 if (!$mysqli) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>
