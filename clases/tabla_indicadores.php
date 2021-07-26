<?php
require_once 'conexion3.php';
$conexion = conexion();

//envio de la consulta
if (isset($_POST['get_data_indicador'])) {

    $id_objetivo = $_POST['id_obj_send'];
    
    $query = "SELECT `id_indicador`,`descripcion`,`resultados`,`id_objetivo` FROM `tbl_indicadores` WHERE id_objetivo = $id_objetivo";

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