<?php
require_once("../Controlador/db.php");
$db = new db;

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

if (isset($_POST['add_info'])) {

    // //?archivo coordinacion academica
    $nombreArchivo_ca = $_FILES['file_ca']['name'];
    $nombreTemp_ca = $_FILES['file_ca']['tmp_name']; //ruta del archivo a validar formato correcto
    $fileError_ca = $_FILES['file_ca']['error']; //!errores

    ////?arhivo craed
    $nombreArchivo_cr = $_FILES['file_cr']['name'];
    $nombreTemp_cr = $_FILES['file_cr']['tmp_name'];
    $fileError_cr = $_FILES['file_cr']['error']; //!errores


    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($nombreTemp_ca);
    $data = $spreadsheet->getActiveSheet(0);
    $valor = $spreadsheet->getActiveSheet()->getCell('A3')->getValue();

    if ($valor != "N# Empleado") {
        echo json_encode('cr_incorrecto');
    } else {
        $spreadsheet2 = \PhpOffice\PhpSpreadsheet\IOFactory::load($nombreTemp_cr);
        $data2 = $spreadsheet2->getActiveSheet(0);
        $valor2 = $spreadsheet2->getActiveSheet()->getCell('A4')->getValue();
        if ($valor2 != "seleccionar") {
            echo json_encode('cread_invalido');
        } else {
            //echo json_encode('Ambos_validos');
            //!moviendo primer archivo 
            $fileExt = explode('.', $nombreArchivo_ca);
            $fileActualExt = strtolower(end($fileExt));
            $fileNewNombre_ca = uniqid('', true) . "." . $fileActualExt;
            $ruta = "../archivos/file_academica/" . $fileNewNombre_ca;
            move_uploaded_file($nombreTemp_ca, $ruta);
            //!fin primer archivo

            //!moviendo segundo archivo
            $fileExt_cr = explode('.', $nombreArchivo_cr);
            $fileActualExt_cr = strtolower(end($fileExt_cr));
            $fileNewNombre_cr = uniqid('', true) . "." . $fileActualExt_cr;
            $ruta2 = "../archivos/file_craed/" . $fileNewNombre_cr;
            move_uploaded_file($nombreTemp_cr, $ruta2);
            //!fin segundo archivo

            //?datos del form
            $periodo_ca = $_POST['periodo_ca'];
            $descrip_ca = $_POST['descrp_ca'];
            $nombre_archivo = $fileNewNombre_ca;
            $fecha = $_POST['txt_fecha_ingreso_ca'];

            $periodo_cr = $_POST['periodo_cr'];
            $descripcion_cr = $_POST['descrip_cr'];
            $nombre_archivo_cr = $fileNewNombre_cr;
            $fecha_cr = $_POST['txt_fecha_ingreso_cr'];
            //?fin datos del form

            $respuesta = $db->addfileAcademica($periodo_ca, $descrip_ca, $nombre_archivo, $fecha, $periodo_cr, $descripcion_cr, $nombre_archivo_cr, $fecha_cr);
            echo json_encode($respuesta);
        }
    }


    // $fileExt = explode('.', $nombreArchivo_ca);
    // $fileActualExt = strtolower(end($fileExt));
    // $fileNewNombre_ca = uniqid('', true) . "." . $fileActualExt;


    // $ruta = "../archivos/file_academica/" . $fileNewNombre_ca;
    // move_uploaded_file($nombreTemp_ca, $ruta);

    // //?fin archivo coordinacion academica

    // //?inicio archivo craed
    // $nombreArchivo_cr = $_FILES['file_cr']['name'];
    // $nombreTemp_cr = $_FILES['file_cr']['tmp_name'];
    // $fileError_cr = $_FILES['file_cr']['error']; //!errores

    // $fileExt_cr = explode('.', $nombreArchivo_cr);
    // $fileActualExt_cr = strtolower(end($fileExt_cr));
    // $fileNewNombre_cr = uniqid('', true) . "." . $fileActualExt_cr;


    // $ruta2 = "../archivos/file_craed/" . $fileNewNombre_cr;
    // move_uploaded_file($nombreTemp_cr, $ruta2);

    // //?fin inicio archivo craed

    // $periodo_ca = $_POST['periodo_ca'];
    // $descrip_ca = $_POST['descrp_ca'];
    // $nombre_archivo = $fileNewNombre_ca;
    // $fecha = $_POST['txt_fecha_ingreso_ca'];

    // //$_POST[''];

    // $periodo_cr = $_POST['periodo_cr'];
    // $descripcion_cr = $_POST['descrip_cr'];
    // $nombre_archivo_cr = $fileNewNombre_cr;
    // $fecha_cr = $_POST['txt_fecha_ingreso_cr'];

    // $respuesta = $db->addfileAcademica($periodo_ca, $descrip_ca, $nombre_archivo, $fecha, $periodo_cr, $descripcion_cr, $nombre_archivo_cr, $fecha_cr);
    //echo json_encode($respuesta);
    //echo json_encode($_POST);



}

if (isset($_POST['reac_cliente'])) {

    $id_cliente = $_POST['id_cliente'];
    $respuesta = $db->getDatosReac($id_cliente);
    echo json_encode($respuesta);
}

if (isset($_POST['denegada'])) {
    $id_cliente = $_POST['id_cliente'];
    $respuesta = $db->updateSolicitudDenegada($id_cliente);
    echo json_encode($respuesta);
}

if (isset($_POST['aceptada'])) {
    $id_cliente = $_POST['id_cliente'];
    $respuesta = $db->updateSolicitudAceptada($id_cliente);
    echo json_encode($respuesta);
}

if (isset($_POST['ver_excel_ca'])) {

    $nombre_archivo = $_POST['nombre_archivo'];
    print_r('<label>' . $nombre_archivo . '</label>');
    $ruta_archivo_excel = '../archivos/file_academica/' . $nombre_archivo;


    //$ruta = 'craed.xlsx';
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load($ruta_archivo_excel);
    //establecer en que hoja se trabajara
    $sheet = $spreadsheet->getActiveSheet(0); // se espcifica en que hoja se quiere trabajar
    $value = $spreadsheet->getActiveSheet()->getCell('A3')->getValue(); //especifica el valor especifico del archivo a subir


    echo '<table class="table table-bordered table-striped mb-0" >';
    foreach ($sheet->/*getRowIterator(3)*/getRowIterator(3)  as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        echo '<tr>';
        foreach ($cellIterator as $cell) {
            if (!is_null($cell)) {
                //$value = $cell->getCalculatedValue();
                $value = $cell->getValue();
                echo '<td>' . $value . '</td>';
            }
        }
        echo '</tr>';
    }
    echo '</table>';
}

if (isset($_POST['ver_excel_cr'])) {
    $nombre_archivo = $_POST['nombre_archivo_cr'];
    print_r('<label>' . $nombre_archivo . '</label>');
    $ruta_archivo_excel = '../archivos/file_craed/' . $nombre_archivo;


    //$ruta = 'craed.xlsx';
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load($ruta_archivo_excel);
    //establecer en que hoja se trabajara
    $sheet = $spreadsheet->getActiveSheet(0); // se espcifica en que hoja se quiere trabajar
    $value = $spreadsheet->getActiveSheet()->getCell('A4')->getValue(); //especifica el valor especifico del archivo a subir


    echo '<table class="table table-bordered table-striped mb-0" >';
    foreach ($sheet->/*getRowIterator(3)*/getRowIterator(4)  as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        echo '<tr>';
        foreach ($cellIterator as $cell) {
            if (!is_null($cell)) {
                //$value = $cell->getCalculatedValue();
                $value = $cell->getValue();
                echo '<td>' . $value . '</td>';
            }
        }
        echo '</tr>';
    }
    echo '</table>';
}

if (isset($_POST['tipo_recursos'])) {
    $estado = 'Activo';
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha_recurso'];
    $nombre_recurso = $_POST['nombre_recurso'];
    $respuesta = $db->newTipoRecurso($descripcion, $fecha, $nombre_recurso, $estado);
    echo json_encode($respuesta);
}
if (isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $respuesta = $db->eliminarRecurso($id);
    echo json_encode($respuesta);
}


if (isset($_POST['cambiar_estado'])) {
    $estado = $_POST['estado'];
    $id = $_POST['id'];
    if ($estado == 'Activo') {
        $nuevo_estado = 'Inactivo';
        $respuesta = $db->cambiarEstado($id, $nuevo_estado);
        echo json_encode($respuesta);
    } else if ($estado == 'Inactivo') {
        $nuevo_estado = 'Activo';
        $respuesta = $db->cambiarEstado($id, $nuevo_estado);
        echo json_encode($respuesta);
    }
}

if (isset($_POST['agregar_tipo_gasto'])) {

    $descrip = $_POST['descripcion'];
    $estado = "Activo";
    $fecha = $_POST['fecha_gasto'];
    $nombre_gasto = $_POST['nombre_gasto'];

    $respuesta = $db->insertTipoGasto($descrip, $estado, $fecha, $nombre_gasto);
    echo json_encode($respuesta);
    //echo json_encode($_POST);
}
