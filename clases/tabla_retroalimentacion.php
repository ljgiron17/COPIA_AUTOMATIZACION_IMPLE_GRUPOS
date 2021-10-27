<?php
require_once 'conexion3.php';
$conexion = conexion();

//envio de la consulta
$query = "SELECT `id_retroalimentacion`, `periodo`, `docente`,`codigo_empleado`,`avances`  from tbl_retroalimentacion ";

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
