<?php

require_once 'conexion3.php';
$conexion = conexion();

$id_archivo = mysqli_real_escape_string($conexion, $_POST['id_archivo']);
$nombre_docente = mysqli_real_escape_string($conexion,  $_POST['nombre_docente']);

// $query = "select`Nombre` from tbl_carga_academica_temporal 
// WHERE `id_coordAcademica` = $id_archivo group by Nombre";
$query = "SELECT `Codigo`,`Asignatura`,`UV`,`Seccion`,`N_Alumnos` FROM `tbl_carga_academica_temporal` 
    WHERE `Nombre` = '$nombre_docente' AND `id_coordAcademica` = $id_archivo group by Seccion";

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
