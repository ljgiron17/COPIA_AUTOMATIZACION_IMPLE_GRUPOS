<?php
require_once 'conexion3.php';
$conexion = conexion();

//envio de la consulta
if (isset($_POST['get_data_res'])) {

    $id_indicador = $_POST['id_indicador'];

    $query = "SELECT r.id_responsables, r.descripcion_responsable FROM tbl_responsables r, tbl_indica_responsables ir, tbl_indicadores i WHERE r.id_responsables = ir.id_responsables AND i.id_indicador = ir.id_indicador AND i.id_indicador = $id_indicador";

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
