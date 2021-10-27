<?php
require '../vendor/autoload.php';

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'informat_desarrollo_automatizacion';

$db = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_GET['enviar'])) {
    $id_planificacion = $_GET['id_planificacion'];

    $spreadsheet = new Spreadsheet();
    $Excel_writer = new Xlsx($spreadsheet);

    $fecha = date('d-m-Y');
    $spreadsheet->setActiveSheetIndex(0);

    //$spreadsheet->getActiveSheet()->setCellValue('D1', $fecha);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('k')->setAutoSize(true);

    $spreadsheet->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('D5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('E5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('F5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('H5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('I5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('J5')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('K5')->getAlignment()->setHorizontal('center');

    $activeSheet = $spreadsheet->getActiveSheet();
    // $activeSheet->setCellValue('A5', 'NOMBRE OBJETIVO');
    // $activeSheet->setCellValue('B5', 'RESULTADO ESPERADO');
    // $activeSheet->setCellValue('C5', 'INDICADOR');
    // $activeSheet->setCellValue('D5', 'ACTIVIDADES');
    // $activeSheet->setCellValue('E5', 'MEDIOS VERIFACION');
    // $activeSheet->setCellValue('F5', 'POBLACIÓN OBJETIVO');
    // $activeSheet->setCellValue('G5', 'RESPONSABLES');

    //$spreadsheet->getActiveSheet()->mergeCells('A6:A'.$total.'');
    $spreadsheet->getActiveSheet(1)->mergeCells('A3:A5');
    $spreadsheet->getActiveSheet()->getCell('A3')->setValue('NOMBRE OBJETIVO');
    $spreadsheet->getActiveSheet()->getStyle('A3:A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A3:A5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A3:K5')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
    $spreadsheet->getActiveSheet()->getStyle('A3:K5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('063970');

    $spreadsheet->getActiveSheet(1)->mergeCells('B3:B5');
    $spreadsheet->getActiveSheet()->getCell('B3')->setValue('RESULTADO ESPERADO');
    $spreadsheet->getActiveSheet()->getStyle('B3:B5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('B3:B5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    $spreadsheet->getActiveSheet(1)->mergeCells('C3:C5');
    $spreadsheet->getActiveSheet()->getCell('C3')->setValue('NOMBRE INDICADOR');
    $spreadsheet->getActiveSheet()->getStyle('C3:C5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C3:C5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    $spreadsheet->getActiveSheet(1)->mergeCells('D3:D5');
    $spreadsheet->getActiveSheet()->getCell('D3')->setValue('ACTIVIDADES');
    $spreadsheet->getActiveSheet()->getStyle('D3:D5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('D3:D5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    $spreadsheet->getActiveSheet(1)->mergeCells('E3:E5');
    $spreadsheet->getActiveSheet()->getCell('E3')->setValue('MEDIO DE VERIFICACIÓN');
    $spreadsheet->getActiveSheet()->getStyle('E3:E5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('E3:E5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    $spreadsheet->getActiveSheet(1)->mergeCells('F3:F5');
    $spreadsheet->getActiveSheet()->getCell('F3')->setValue('POBLACIÓN OBJETIVO');
    $spreadsheet->getActiveSheet()->getStyle('F3:F5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('F3:F5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    $spreadsheet->getActiveSheet(1)->mergeCells('G3:G5');
    $spreadsheet->getActiveSheet()->getCell('G3')->setValue('RESPONSABLES');
    $spreadsheet->getActiveSheet()->getStyle('G3:G5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('G3:G5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    $spreadsheet->getActiveSheet(1)->mergeCells('H3:K3');
    $spreadsheet->getActiveSheet()->getCell('H3')->setValue('METAS TRIMESTRALES');
    $spreadsheet->getActiveSheet()->getStyle('H3:K3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('H3:K3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

    $spreadsheet->getActiveSheet()->getCell('H4')->setValue('I TRIMESTRE');
    $spreadsheet->getActiveSheet()->getCell('I4')->setValue('II TRIMESTRE');
    $spreadsheet->getActiveSheet()->getCell('J4')->setValue('III TRIMESTRE');
    $spreadsheet->getActiveSheet()->getCell('K4')->setValue('IV TRIMESTRE');

    $spreadsheet->getActiveSheet()->getCell('H5')->setValue('PLANIFICADO');
    $spreadsheet->getActiveSheet()->getCell('I5')->setValue('PLANIFICADO');
    $spreadsheet->getActiveSheet()->getCell('J5')->setValue('PLANIFICADO');
    $spreadsheet->getActiveSheet()->getCell('K5')->setValue('PLANIFICADO');

    $query_planificacion = $db->query("SELECT * FROM tbl_planificaciones WHERE id_planificacion = " . $id_planificacion . "");
    $fila_plan = $query_planificacion->fetch_assoc();
    $activeSheet->setCellValue('B1', 'Nombre POA: ' . $fila_plan['nombre'] . ', Año ejecución: ' . $fila_plan['anio'] . ', Fecha de archivo: ' . $fecha);

    $spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);

    $query = $db->query("SELECT `id_objetivo`,`nombre_objetivo` FROM `tbl_objetivos_estrategicos` WHERE `id_planificacion` = '" . $id_planificacion . "'");
    if ($query->num_rows > 0) {
        $i = 6;
        $ind = 6;
        $act = 6;
        $med = 6;
        while ($fila_obj = $query->fetch_assoc()) {
            //$activeSheet->setCellValue('B' . $i, $row['area']);
            //$activeSheet->setCellValue('C' . $i, $row['descripcion']);
            $activeSheet->setCellValue('A' . $ind, $fila_obj['nombre_objetivo']);
            $i++;
            $query2 = $db->query("SELECT `id_indicador`, `descripcion`,`resultados` FROM `tbl_indicadores` WHERE `id_objetivo` =" . $fila_obj['id_objetivo'] . "");
            $row_cnt = $query2->num_rows;
            $total = $row_cnt + $ind - 1;
            while ($fila_ind = $query2->fetch_assoc()) {
                //$spreadsheet->getActiveSheet()->mergeCells('A6:A'.$total.'');
                //$spreadsheet->getActiveSheet()->mergeCells('A6:A' . $total . '');                
                $activeSheet->setCellValue('B' . $ind, $fila_ind['resultados']);
                $activeSheet->setCellValue('C' . $ind, $fila_ind['descripcion']);
                $ind++;

                $query5 = $db->query("SELECT tr.descripcion_responsable as responsables from `tbl_responsables` tr, `tbl_indicadores` ti, `tbl_indica_responsables` tir  WHERE tir.id_indicador = ti.id_indicador
                AND tr.id_responsables = tir.id_responsables AND ti.id_indicador =" . $fila_ind['id_indicador'] . " ");
                while ($fila_res = $query5->fetch_assoc()) {
                    $spreadsheet->getActiveSheet()->getCell('G' . $ind)->setValue($fila_res['responsables']);
                } //! fin del while de responsables



                $query4 = $db->query("SELECT `trimestre_1`, `trimestre_2`, `trimestre_3`, `trimestre_4` FROM `tbl_metas` WHERE id_indicador = " . $fila_ind['id_indicador'] . " ");
                while ($fila_met = $query4->fetch_assoc()) {
                    $spreadsheet->getActiveSheet()->getCell('H' . $ind)->setValue($fila_met['trimestre_1']);
                    $spreadsheet->getActiveSheet()->getCell('I' . $ind)->setValue($fila_met['trimestre_2']);
                    $spreadsheet->getActiveSheet()->getCell('J' . $ind)->setValue($fila_met['trimestre_3']);
                    $spreadsheet->getActiveSheet()->getCell('K' . $ind)->setValue($fila_met['trimestre_4']);
                    $ind++;
                    $query3 = $db->query("SELECT id_actividades_poa, nombre_actividad from tbl_actividades_poa WHERE id_indicador =" . $fila_ind['id_indicador'] . "");

                    while ($fila_act = $query3->fetch_assoc()) {
                        $activeSheet->setCellValue('D' . $act, $fila_act['nombre_actividad']);

                        // $query6 = $db->query("SELECT mv.descripcion FROM tbl_medio_verificacion mv, tbl_actividades_poa ap, tbl_act_verficacion av 
                        // WHERE ap.id_actividades_poa = av.id_actividades_poa 
                        // AND  av.id_verificacion = mv.id_verificacion AND ap.id_actividades_poa =" . $fila_act['id_actividades_poa'] . "");

                        $query6 = $db->query("SELECT mv.descripcion, po.descripcion as poblacion FROM tbl_medio_verificacion mv, tbl_actividades_poa ap, tbl_act_verficacion av, tbl_poblacion_objetivo po, tbl_act_poblacion_objetivo apo
                        WHERE ap.id_actividades_poa = av.id_actividades_poa 
                        AND po.id_poblacion_objetivo = apo.id_poblacion_objetivo
                        AND ap.id_actividades_poa = apo.id_actividades_poa
                        AND  av.id_verificacion = mv.id_verificacion AND ap.id_actividades_poa = " . $fila_act['id_actividades_poa'] . "");

                        while ($fila_mv = $query6->fetch_assoc()) {
                            $activeSheet->setCellValue('E' . $act, $fila_mv['descripcion']);
                            $activeSheet->setCellValue('F' . $act, $fila_mv['poblacion']);
                        }

                        $act++;
                    } //!fin while actividades
                } //!fin del while de 
            } //!fin segundo while  

        } //!fin primer while
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '00000a'],
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A3:K' . $total . '')->applyFromArray($styleArray);
    } else {
        $spreadsheet->getActiveSheet()->setCellValue('A6', 'INTRODUZCA DATOS AL PROYECTO');
    }

    $filename = 'areas.xlsx';

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=' . $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');
}
