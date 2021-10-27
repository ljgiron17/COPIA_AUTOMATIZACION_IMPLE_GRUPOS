<?php

require_once 'conexion3.php';
$conexion = conexion();

$id_craed_jefa = mysqli_real_escape_string($conexion, $_POST['id_craed_jefa']);
$nombre_docente = mysqli_real_escape_string($conexion,  $_POST['nombre_docente']);

// $query = "select`Nombre` from tbl_carga_academica_temporal 
// WHERE `id_coordAcademica` = $id_archivo group by Nombre";
/*$query = "SELECT `Asignatura_cr`,`Centro_cr`,`Dias_cr`,`Semana`,`Seccion_cr` FROM 'tbl_carga_craed` 
    WHERE `Profesor` = '$nombre_docente' AND `id_craed_jefa` = $id_craed_jefa group by Seccion_cr";*/
$query = "SELECT `Asignatura_cr`,`Centro_cr`,`Dias_cr`,`Semana`,`Seccion_cr` from tbl_carga_craed 
    WHERE `Profesor` = '$nombre_docente' AND `id_craed_jefa` = $id_craed_jefa group by `Seccion_cr`";

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

