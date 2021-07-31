<?php
require '../Controlador/db.php';
$db = new db();
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

if (isset($_GET['enviar'])) {
    $id_retro = $_GET['id_retro_soli'];
    $respuesta = $db->retro($id_retro);
    $anio = $respuesta['anio'];
    $periodo = $respuesta['periodo'];
    $docente = $respuesta['docente'];
    $codigo_empleado = $respuesta['codigo_empleado'];
    $cant_clases_reasignadas = $respuesta['cant_clases_reasignadas'];
    $memorandum = $respuesta['memorandum'];
    $nombre_proyecto = $respuesta['nombre_proyecto'];
    $avances = $respuesta['avances'];
    $fecha_inicio = $respuesta['fecha_inicio'];
    $fecha_finalizacion = $respuesta['fecha_finalizacion'];
    $n_identidad = $respuesta['n_identidad'];

    ob_start();

?>
    <div class="container-sm">
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Retroalimentacion</title>
        </head>
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

        <body style="margin:0;padding:0">
            <br>
            <p style="text-align:right; margin-right: 58px;">Oficio de solicitud N° ________</p><br>
            <p></p>
            <p align="center" class="f0">
                <strong>Reporte de retroalimentación por reasignación académica</strong>
            </p>
            <br>

            <p></p>

            <p style="text-align:left; margin-left: 60px;">
                <strong>Periodo</strong>
                <u id="id_periodo"><?php echo $periodo ?> </u>&nbsp;&nbsp; <strong>Año</strong> <u id="anio"><?php echo $anio ?></u>
            </p> <br>
            <p style="text-align:left; margin-left: 60px;">
                <strong>Docente</strong>
                <u id="docente_nombre"><?php echo $docente ?> </u>&nbsp;&nbsp; <strong>Codigo Empleado</strong> <u id="cod_empleado"><?php echo $codigo_empleado ?> </u>
            </p> <br>
            <p style="text-align:left; margin-left: 60px;">
                <strong>Cantidad de clases reasignadas</strong>
                <u id="cant_clases"><?php echo $cant_clases_reasignadas ?> </u>&nbsp;&nbsp; <strong>memorándum</strong> <u id="memo"><?php echo $memorandum ?></u>
            </p> <br>

            <p style="text-align:left; margin-left: 60px;">
                <strong>Nombre del proyecto en el que trabaja</strong><br>
                <u id="nombre_proyecto"><?php echo $nombre_proyecto ?></u>

            </p><br>
            <p style="text-align:left; margin-left: 60px;">
                <strong>Resultado obtenido</strong><br>
                <u id="resultado"><?php echo $avances ?></u>

            </p><br>
            <p style="text-align:left; margin-left: 60px;">
                <strong>Fecha que inicio el proyecto</strong><br>
                <u id="fecha_inicio"><?php echo $fecha_inicio ?> </u>
            </p> <br>
            <p style="text-align:left; margin-left: 60px;">
                <strong>Fecha que finaliza participación en proyecto</strong><br>
                <u id="fecha_final"> <?php echo $fecha_finalizacion ?></u>
            </p> <br> <br> <br>
            <br> <br> <br>
            <br> <br> <br>
            <br>
            <p></p>
            <p></p>
            <p class="f1">
            <table style="width:100%">
                <tr>
                    <th style="text-align: center;"> <u><?php echo $n_identidad ?></u> </th>
                    <th style="width:150px"></th>
                    <th style="text-align: center;"> <u> <?php echo $docente ?> </u> </th>
                </tr>
                <tr>
                    <td style="text-align: center;">No. Identidad del Docente</td>
                    <td></td>
                    <td style="text-align: center;">Nombre y firma del docente</td>
                </tr>
            </table>
            </p>

        </body>

        </html>
    </div>
<?php
    $html = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'ES', 'true', 'UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}
?>