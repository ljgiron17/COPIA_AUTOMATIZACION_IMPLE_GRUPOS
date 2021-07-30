<?php
require_once 'conexion3.php';
$conexion = conexion();

//envio de la consulta
$query = "SELECT tg.id_detalle_tipo_gasto, tg.nombre, tg.descripcion, tg.precio_aprox, tg.cantidad, (tg.cantidad*tg.precio_aprox) as total, gt.nombre_gasto  FROM tbl_detalles_tipo_gasto tg, tbl_tipo_gastos gt WHERE gt.id_tipo_gastos = tg.id_tipo_gastos";

//buscando el resultado 
$resultado = mysqli_query($conexion, $query);
if (!$resultado) {
    die("Error");
} else {
    $filas = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $filas[] = $fila;
    }
    echo json_encode($filas); //enviando en formato jSON
}
mysqli_free_result($resultado);
mysqli_close($conexion);
