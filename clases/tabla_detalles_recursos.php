<?php
require_once 'conexion3.php';
$conexion = conexion();

//envio de la consulta
$query = "SELECT rt.id_detalle_tipo_recurso, rt.nombre, rt.cantidad, rt.descripcion, rt.precio_aprox,(rt.cantidad * rt.precio_aprox) as total, ret.nombre_recurso FROM tbl_detalles_tipo_recurso rt, tbl_recursos_tipo ret
WHERE rt.id_recurso_tipo = ret.id_recurso_tipo";

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