<?php
require_once 'conexion3.php';
$conexion = conexion();

//envio de la consulta
$query = "SELECT id_indicadores_gestion,nombre_indicador,descripcion,fecha,estado FROM  tbl_indicadores_gestion";

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
