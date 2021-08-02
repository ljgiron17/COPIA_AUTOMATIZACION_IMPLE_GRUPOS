<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

if (permiso_ver('119') == '1') {

  $_SESSION['g_reasignacion_solicitud'] = "...";
} else {
  $_SESSION['g_reasignacion_solicitud'] = "No 
   tiene permisos para visualizar";
}


$Id_objeto = 119;

$visualizacion = permiso_ver($Id_objeto);

?>


<!DOCTYPE html>
<html>

<head>
  <title></title>
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


<body>

  <!-- inicio modal -->
  <div id="modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detalles de la solicitud</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-sm">
            <!DOCTYPE html>
            <html lang="en">

            <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Document</title>
            </head>

            <body style="margin:0;padding:0">
              <p align="center" class="f0">
                <strong>Solicitud de reasignación académica</strong>
              </p>
              <p style="margin-left: 30px;">
                <img width="246" height="123" src="../dist/img/unah_log.jpg" />

              </p><br>
              <p style="text-align:right; margin-right: 58px;">Oficio de solicitud N° <u id="id_solicitud"> </u> </p><br>

              <p style="text-align:left; margin-left: 58px;">
                <strong>Solicitud</strong>
                <u id="nombre_solicitud"></u>
              </p> <br>
              <p style="text-align:left; margin-left: 58px;">
                <strong>Docente</strong>
                <u id="nombre_docente"></u>
              </p><br>
              <p style="text-align:left; margin-left: 58px;">
                <strong>Proyecto</strong>
                <u id="nombre_proyecto"></u>
              </p><br>
              <p style="text-align:left; margin-left: 58px;">
                <strong>Fecha Inicio</strong>
                <u id="fecha_inicio"></u> <strong align="right">Fecha Finaliza</strong><u id="fecha_final"></u>
              </p><br>
              <p style="text-align:left; margin-left: 58px;">
                <strong>Avance realizado si estuvo el periodo anterior</strong>
                <u id="avance_realizado"></u>
              </p><br>
              <p style="text-align:left; margin-left: 58px;">
                <strong>Proyección para este periodo académico</strong>
                <u id="proyeccion"></u>
              </p><br>
              <p style="text-align:left; margin-left: 58px;">
                <strong>Tiempo de dedicación propuesto (horas por semana)</strong>
                <u id="horas"></u>
              </p>

            </body>

            </html>
          </div>
        </div>
        <div class="modal-footer">
          <form position="absolute" id="form_solictiud" method="get" target="_blank" action="../pdf/getDataReasignacion.php">
            <!-- <input type="text" name="id_cliente" value=' + data + '> -->
            <input style="display:none;" type="text" id="id_cliente" name="id_cliente" class="form-control">
            <input id="redirbtn" type="submit" name="enviar" class="btn btn-primary" value="Generar PDF">
          </form>
          <!-- <button type="button"  >Generar PDF</button> -->

          <button type="button" class="btn btn-danger" id="solictud_denegar">Denegar</button>
          <button type="button" class="btn btn-success" id="aceptar_solicitud">Aceptar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- fin modal -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">


            <h1>Solicitudes de reasignación</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/g_reasignacionjefatura_vista.php">Reasigacion Academica</a></li>
            </ol>
          </div>

          <div class="RespuestaAjax"></div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Solicitudes</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>

        <div class="card card-default">

        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tabla_solicitud" class="table table-bordered table-striped" cellpadding="0" width="100%">
          <thead>
            <tr>
              <th scope="col">ID SOLICITUD</th>
              <th scope="col">ID DOCENTE</th>
              <th scope="col">NOMBRE DOCENTE</th>
              <th scope="col">ESTADO SOLICITUD</th>
              <th scope="col">ACCIÓN</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- /.card-body -->
      <br> <br> <br> <br>
      <div class="card-footer">
        <a href="../pdf/pdf_reasignacion.php" target="_blank">Descargar solicitud de reasignación</a>
        <!-- <embed src="../pdf/getDataReasignacion.php" frameborder="1" width="100%" height="400px"> -->


      </div>
    </div>

  </div>
  </section>
  <div id="redirect"></div>
  </div>

  <script src="../js/manejo_solicitudes.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $("#tabla_solicitud").DataTable({
        "lengthMenu": [
          [3],
          [3]
        ],
        "order": [ 
          [0, 'desc']
        ],
        "responsive": true,
        language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar    _MENU_    Filas",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ ",
                "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 ",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },                
            },
        "ajax": {
          "url": "../clases/tabla_reac_solicitud.php",
          "type": "POST",
          "dataSrc": ""
        },
        "columns": [{
            "data": "id_reac_academica"
          },
          {
            "data": "id_docente"
          },
          {
            "data": "nombre_docente"
          },
          {
            "data": "estado"
          },
          {
            "data": null,
            defaultContent: '<center><div class="btn-group"><button id="ver_detalles" class="ver btn btn-success btn - m" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-eye"></i></button><div></center>'
          },
          // { "data": "ip" },
          // { "data": "cambio" },                                                    
        ],
        "rowCallback": function(row, data, index) {
          if (data.estado == "Denegada") {
            $('td', row).css('background-color', '#fba6b1');
          } else if (data.estado == "Aceptada") {
            $('td', row).css('background-color', '#c7ffc7');
          }
        }

      });


      $('#tabla_solicitud tbody').on('click', '#ver_detalles', function() {
        //LECTURA DEL EVENTO PARA ELIMINAR UN REGISTRO
        var fila = table.row($(this).parents('tr')).data();
        var id = fila.id_reac_academica;
        console.log(id);
        document.getElementById("id_cliente").value = id;
        //redir(id);
        const formulario_envio = new FormData();
        formulario_envio.append('id_cliente', id);
        formulario_envio.append('reac_cliente', 1);
        fetch('../Controlador/action.php', {
            method: 'POST',
            body: formulario_envio
          })
          .then(res => res.json())
          .then(data => {
            //console.log(data);
            console.log('Datos_proyecto_solicitud');
            //document.getElementById('').innerHTML = `${data.}`;
            document.getElementById('id_solicitud').innerHTML = `${data.id_reac_academica}`;
            document.getElementById('nombre_solicitud').innerHTML = `${data.nombre_proyecto}`;
            document.getElementById('nombre_docente').innerHTML = `${data.nombre_docente}`;
            document.getElementById('nombre_proyecto').innerHTML = `${data.nombre_proyecto}`;
            document.getElementById('fecha_inicio').innerHTML = `${data.fecha_inicio}`;
            document.getElementById('fecha_final').innerHTML = `${data.fecha_final}`;
            document.getElementById('avance_realizado').innerHTML = `${data.avance_realizado}`;
            document.getElementById('proyeccion').innerHTML = `${data.proyec_periodo_actual}`;
            document.getElementById('horas').innerHTML = `${data.cant_horas}`;
          });
      });


    });

    function redir(data) {
      document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../pdf/getDataReasignacion.php"><input type="text" name="id_cliente" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
      // document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../pdf/getDataReasignacion.php"><input type="text" name="id_cliente" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
      document.getElementById('redirbtn').click();
    }
  </script>
</body>

</html>