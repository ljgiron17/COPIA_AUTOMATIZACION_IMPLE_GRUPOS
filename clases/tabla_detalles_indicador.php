<?php
require_once 'conexion3.php';
$conexion = conexion();

//envio de consulta de indicadores de gestion
$query = "SELECT rt.id_detalles_tipo_indicador, rt.descripcion, ret.nombre_indicador from tbl_detalles_tipo_indicador rt, tbl_indicadores_gestion ret
WHERE rt.id_indicadores_gestion = ret.id_indicadores_gestion";
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
