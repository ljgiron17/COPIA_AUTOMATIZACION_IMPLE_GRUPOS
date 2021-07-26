<?php
require_once 'conexion3.php';
$conexion = conexion();

//envio de la consulta
if (isset($_POST['datos_plani'])) {

    $id_planif = $_POST['id_plani'];
    
    $query = "SELECT * FROM `tbl_objetivos_estrategicos` WHERE id_planificacion = $id_planif";

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
