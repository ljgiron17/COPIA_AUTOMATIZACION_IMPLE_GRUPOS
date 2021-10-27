<?php

require_once 'conexion3.php';
$conexion = conexion();

if (isset($_POST['enviar_docente'])) {
    
    $id_craed_jefa = $_POST['id_craed_jefa'];
    
    // $query = "select`Nombre` from tbl_carga_academica_temporal 
    // WHERE `id_coordAcademica` = $id_archivo group by Nombre";
    $query = "SELECT `id_craed_jefa`,`Profesor` FROM `tbl_carga_craed` WHERE `id_craed_jefa` = $id_craed_jefa group BY Profesor";

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
}
