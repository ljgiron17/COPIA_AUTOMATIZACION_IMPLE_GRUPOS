<?php
require_once("../Controlador/db.php");
$db = new db;

if (isset($_POST['add_info'])) {

    //?archivo coordinacion academica

    $nombreArchivo_ca = $_FILES['file_ca']['name'];
    $nombreTemp_ca = $_FILES['file_ca']['tmp_name'];
    $fileError_ca = $_FILES['file_ca']['error']; //!errores

    $fileExt = explode('.', $nombreArchivo_ca);
    $fileActualExt = strtolower(end($fileExt));
    $fileNewNombre_ca = uniqid('', true) . "." . $fileActualExt;


    $ruta = "../archivos/file_academica/" . $fileNewNombre_ca;
    move_uploaded_file($nombreTemp_ca, $ruta);

    //?fin archivo coordinacion academica

    //?inicio archivo craed
    $nombreArchivo_cr = $_FILES['file_cr']['name'];
    $nombreTemp_cr = $_FILES['file_cr']['tmp_name'];
    $fileError_cr = $_FILES['file_cr']['error']; //!errores

    $fileExt_cr = explode('.', $nombreArchivo_cr);
    $fileActualExt_cr = strtolower(end($fileExt_cr));
    $fileNewNombre_cr = uniqid('', true) . "." . $fileActualExt_cr;


    $ruta2 = "../archivos/file_craed/" . $fileNewNombre_cr;
    move_uploaded_file($nombreTemp_cr, $ruta2);

    //?fin inicio archivo craed

    $periodo_ca = $_POST['periodo_ca']; 
    $descrip_ca = $_POST['descrp_ca'];
    $nombre_archivo = $fileNewNombre_ca;
    $fecha = $_POST['txt_fecha_ingreso_ca'];

    //$_POST[''];

    $periodo_cr = $_POST['periodo_cr'];
    $descripcion_cr = $_POST['descrip_cr']; 
    $nombre_archivo_cr = $fileNewNombre_cr;
    $fecha_cr = $_POST['txt_fecha_ingreso_cr'];

    $respuesta = $db->addfileAcademica($periodo_ca, $descrip_ca, $nombre_archivo, $fecha, $periodo_cr, $descripcion_cr, $nombre_archivo_cr, $fecha_cr);
    echo json_encode($respuesta);
    

   
}
