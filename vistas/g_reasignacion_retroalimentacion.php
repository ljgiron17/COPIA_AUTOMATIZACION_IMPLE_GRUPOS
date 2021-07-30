<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
// require_once('../clases/funcion_bitacora.php');
// require_once('../clases/funcion_visualizar.php');

// if (permiso_ver('120') == '1') {

//   $_SESSION['g_reasignacion_retroalimentacion'] = "...";
// } else {
//   $_SESSION['g_reasignacion_retroalimentacion'] = "No 
//    tiene permisos para visualizar";
// }


// $Id_objeto = 120;

// $visualizacion = permiso_ver($Id_objeto);

// 
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
              <p style="text-align:right; margin-right: 58px;">Oficio de solicitud N° ________</p><br>
              <p></p>
              <p align="center" class="f0">
                <strong>Reporte de retroalimentación por reasignación académica</strong>
              </p>
              <br>

              <p></p>

              <p style="text-align:left; margin-left: 60px;">
                <strong>Periodo</strong>
                <u id="id_periodo"></u>&nbsp;&nbsp; <strong>Año</strong> <u id="anio"></u>
              </p> <br>
              <p style="text-align:left; margin-left: 60px;">
                <strong>Docente</strong>
                <u id="docente_nombre"></u>&nbsp;&nbsp; <strong>Codigo Empleado</strong> <u id="cod_empleado"></u>
              </p> <br>
              <p style="text-align:left; margin-left: 60px;">
                <strong>Cantidad de clases reasignadas</strong>
                <u id="cant_clases"></u>&nbsp;&nbsp; <strong>memorándum</strong> <u id="memo"></u>
              </p> <br>

              <p style="text-align:left; margin-left: 60px;">
                <strong>Nombre del proyecto en el que trabaja</strong><br>
                <u id="nombre_proyecto"></u>

              </p><br>
              <p style="text-align:left; margin-left: 60px;">
                <strong>Resultado obtenido</strong><br>
                <u id="resultado"></u>

              </p><br>
              <p style="text-align:left; margin-left: 60px;">
                <strong>Fecha que inicio el proyecto</strong><br>
                <u id="fecha_inicio"></u>
              </p> <br>
              <p style="text-align:left; margin-left: 60px;">
                <strong>Fecha que finaliza participación en proyecto</strong><br>
                <u id="fecha_final"></u>
              </p> <br> <br> <br>

            </body>

            </html>
          </div>
        </div>
        <div class="modal-footer">
          <form position="absolute" id="form_solictiud" method="get" target="_blank" action="../pdf/pdf_retro_alimentacion.php">
            <!-- <input type="text" name="id_cliente" value=' + data + '> -->
            <input style="display:none;" type="text" id="id_retro_soli" name="id_retro_soli" class="form-control">
            <input id="redirbtn" type="submit" name="enviar" class="btn btn-primary" value="Generar PDF">
          </form>
          <!-- <button type="button"  >Generar PDF</button> -->
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


            <h1>Retroalimentación</h1>
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
        <table id="tabla_retroalimentacion" class="table table-bordered table-striped" cellpadding="0" width="100%">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">PERIODO</th>
              <th scope="col">DOCENTE</th>
              <th scope="col">CODIGO EMPLEADO</th>
              <th scope="col">ESTADO</th>
              <th scope="col">DETALLES</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- /.card-body -->
      <br> <br> <br> <br>
      <div class="card-footer">
        <a href="../pdf/pdf_retroalimentacion.php" target="_blank">Descargar solicitud de retroalimentación</a>
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
      var table = $("#tabla_retroalimentacion").DataTable({
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
          "url": "../clases/tabla_retroalimentacion.php",
          "type": "POST",
          "dataSrc": ""
        },
        "columns": [{
            "data": "id_retroalimentacion"
          },
          {
            "data": "periodo"
          },
          {
            "data": "docente"
          },
          {
            "data": "codigo_empleado"
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
        // "rowCallback": function(row, data, index) {
        //   if (data.estado == "Denegada") {
        //     $('td', row).css('background-color', '#fba6b1');
        //   } else if (data.estado == "Aceptada") {
        //     $('td', row).css('background-color', '#c7ffc7');
        //   }
        // }

      });


      $('#tabla_retroalimentacion tbody').on('click', '#ver_detalles', function() {
        var fila = table.row($(this).parents('tr')).data();
        var id = fila.id_retroalimentacion;
        document.getElementById('id_retro_soli').value = id;
        //console.log(id);

        const form_retro = new FormData();
        form_retro.append('enviar_retro', 1);
        form_retro.append('id_retro', id);

        fetch('../Controlador/action.php', {
            method: "POST",
            body: form_retro
          })
          .then(res => res.json())
          .then(data => {
            console.log(data);
            document.getElementById('id_periodo').innerHTML = `${data.periodo}`;
            document.getElementById('anio').innerHTML = `${data.anio}`;
            document.getElementById('docente_nombre').innerHTML = `${data.docente}`;
            document.getElementById('cod_empleado').innerHTML = `${data.codigo_empleado}`;
            document.getElementById('cant_clases').innerHTML = `${data.cant_clases_reasignadas}`;
            document.getElementById('memo').innerHTML = `${data.memorandum}`;
            document.getElementById('nombre_proyecto').innerHTML = `${data.nombre_proyecto}`;
            document.getElementById('resultado').innerHTML = `${data.avances}`;
            document.getElementById('fecha_inicio').innerHTML = `${data.fecha_inicio}`;
            document.getElementById('fecha_final').innerHTML = `${data.fecha_finalizacion}`;
          });
      });

    });

    // function redir(data) {
    //   document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../pdf/getDataReasignacion.php"><input type="text" name="id_cliente" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
    //   // document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../pdf/getDataReasignacion.php"><input type="text" name="id_cliente" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
    //   document.getElementById('redirbtn').click();
    // }
  </script>
</body>

</html>
