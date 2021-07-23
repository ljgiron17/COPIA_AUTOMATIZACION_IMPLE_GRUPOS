<?php
require '../Controlador/db.php';
$db = new db();
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

if (isset($_GET['enviar'])) {
    $id_cliente = $_GET['id_cliente'];
    $respuesta = $db->getDatosReac($id_cliente);
    $solicitud = $respuesta['nombre_proyecto'];
    $nombre_docente = $respuesta['nombre_docente'];
    $fecha_inicio = $respuesta['fecha_inicio'];
    $fecha_final = $respuesta['fecha_final'];
    $avance_realizado = $respuesta['avance_realizado'];
    $proyec_periodo_actual = $respuesta['proyec_periodo_actual'];
    $cant_horas =$respuesta['cant_horas'];

    ob_start();

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            p {
                font-size: 15px;
            }

            p.f1 {
                margin: 58px;
            }

            p.f0 {
                font-size: 18px;
            }
        </style>
    </head>

    <body style="margin:0;padding:0">
    <br>
        <p align="center" class="f0">
            <strong>Solicitud de reasignación académica</strong>
        </p>
        <p style="margin-left: 30px;">
            <img width="246" height="123" src="../dist/img/unah_log.jpg" />

        </p><br>
        <p style="text-align:right; margin-right: 58px;">Oficio de solicitud N° <u><?php echo $id_cliente; ?></u><br>
        </p><br>
        <p style="text-align:left; margin-left: 58px; margin-right: 58px;">
            <strong>Solicitud </strong>
            <u><?php echo $solicitud; ?></u>
        </p> <br>
        <p style="text-align:left; margin-left: 58px; margin-right: 58px;">
            <strong>Docente </strong>
            <u><?php echo $nombre_docente; ?></u>
        </p><br>
        <p style="text-align:left; margin-left: 58px; margin-right: 58px;">
            <strong>Proyecto </strong>
            <u><?php echo $solicitud; ?></u>
        </p><br>
        <p style="text-align:left; margin-left: 58px; margin-right: 58px;">
            <strong>Fecha Inicio</strong>
            <u><?php echo $fecha_inicio; ?></u> <strong align="right">Fecha Finaliza</strong><u><?php echo $fecha_final; ?></u>
        </p><br>
        <p style="text-align:left; margin-left: 58px; margin-right: 58px;">
            <strong>Avance realizado si estuvo el periodo anterior</strong>
            <u><?php echo $avance_realizado; ?></u>
        </p><br>
        <p style="text-align:left; margin-left: 58px; margin-right: 58px;">
            <strong>Proyección para este periodo académico</strong>
            <u><?php echo $proyec_periodo_actual; ?></u>
        </p><br>
        <p style="text-align:left; margin-left: 58px; margin-right: 58px;">
            <strong>Tiempo de dedicación propuesto (horas por semana)</strong>
            <u><?php echo $cant_horas; ?></u>
        </p><br> <br> <br> <br> <br> <br> <br> <br> <br> <br> 
        <p class="f1">
            ________________________
        <p style="margin-left: 30px;"><strong>Firma del docente</strong></p>
        </p>
    </body>

    </html>
<?php
    $html = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'ES', 'true', 'UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}
?>