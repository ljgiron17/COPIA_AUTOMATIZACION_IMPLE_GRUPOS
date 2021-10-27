<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

$Id_objeto = 250;


$visualizacion = permiso_ver($Id_objeto);


if ($visualizacion == 0) {
    echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                           window.location = "../vistas/g_reasignacion_solicitud.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A REASIGNACIÓN SOLICITUD.');

}

ob_end_flush();
?>


<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>

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
            <input id="" type="submit" name="enviar" class="btn btn-primary" value="Generar PDF">
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

  <!-- Modal -->
  <div class="modal fade" id="nueva_solicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nueva Solicitud</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_solicitud_nueva">
            <label for="">Nombre Docente</label>
            <select name="nombre_docentes" id="nombre_docentes" class="form-control">

            </select>
            <label for="">Nombre Proyecto</label>
            <input type="text" class="form-control" id="nombre_proyecto" maxlength="90" name="nombre_proyecto" onkeyup="mayusculas(this);" required>
            <div class="row">
              <div class="col-6">
                <label for="">Fecha inicio</label>
                <input type="text" class="form-control" id="datepicker" onkeydown="return false" name="fecha_inicio" required>
              </div>
              <div class="col-6">
                <label for="">Fecha final</label>
                <input type="text" class="form-control" id="datepicker1" onkeydown="return false" name="fecha_final" required>
              </div>
            </div>
            <label for="">Periodo del proyecto</label>
            <select name="periodo_soli" id="periodo_soli" class="form-control">
              <option value="PERIODO I">PERIODO I</option>
              <option value="PERIODO II">PERIODO II</option>
              <option value="PERIODO III">PERIODO III</option>
              <option value="PERIODO IV">PERIODO IV</option>
            </select>
            <label for="">Cantidad horas</label>
            <input type="text" id="horas_soli" name="horas_soli" class="form-control" number maxlength="2" required>
            <label for="">Avance Realizado</label>
            <textarea class="form-control" id="avance_realizado" name="avance_realizado" rows="3" onkeyup="mayusculas(this);" required></textarea>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="genera_solicitud">Enviar</button>
        </div>
      </div>
    </div>
  </div>

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
              <li class="breadcrumb-item"><a href="../vistas/g_reasignacionjefatura_vista.php">Gestion de Reasignacion Jefatura</a></li>
            </ol>
          </div>

          <div class="RespuestaAjax"></div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!--Pantalla 2-->
    <div class="card card-default">


      <div class="card-body  ">
        <div class="row">
          <div class="col-9">
            <h3 class="card-title">Registro de solicitudes</h3>
          </div>
          <div class="col-3">
            <a href="#" class="btn btn-success btn-m" data-toggle="modal" id="nueva_soli_modal" data-target="#nueva_solicitud">Nueva solicitud</a>
          </div>
        </div>
        <!-- <a href="../vistas/g_cargararchivosdecargaacademica_vista.php" class="btn btn-success btn-m">Nueva Gestión de Carga</a> -->
      </div>

    </div>
    <br>
    <br>

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
              <th scope="col">RAZÓN</th>
              <th scope="col">ESTADO SOLICITUD</th>
              <th scope="col">ACCIÓN</th>
              <th scope="col">PDF</th>
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
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> -->


  <script type="text/javascript">
    $(document).ready(function() {
      var table = $("#tabla_solicitud").DataTable({
        "lengthMenu": [
          [5],
          [5]
        ],
        "order": [
          [0, 'desc']
        ],
        "responsive": true,
        dom: 'Bfrtip',
        "buttons": [{
            extend: 'copyHtml5',
            title: 'Datos Exportados',
            text: 'Copiar <i class="fas fa-copy"></i>',
            messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'excelHtml5',
            title: 'Datos Exportados',
            text: ' Excel <i class="fas fa-file-excel"></i>',
            messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'pdfHtml5',
            title: 'Datos Exportados',
            text: 'PDF <i class="fas fa-file-pdf"></i>',
            messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
        ],
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
            "data": "razon_negada"
          },
          {
            "data": "estado"
          },
          {
            "data": null,
            defaultContent: '<center><div class="btn-group"><button id="ver_detalles" class="ver btn btn-success btn - m" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-eye"></i></button><div></center>'
          },
          {
            "data": null,
            defaultContent: '<center><button class="btn btn-primary" id="generar_pdf">Generar</button></center>'
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

      $('#tabla_solicitud tbody').on('click', '#generar_pdf', function() {
        var fila = table.row($(this).parents('tr')).data();
        var id_soli = fila.id_reac_academica;
        console.log(id_soli);
        redir(id_soli);
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
      //document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../pdf/getDataReasignacion.php"><input type="text" name="id_cliente" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
      document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../pdf/getDataReasignacion.php"><input type="text" name="id_cliente" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
      document.getElementById('redirbtn').click();
    }
    $("#datepicker, #datepicker1").datepicker();

    function mayusculas(e) {
      e.value = e.value.toUpperCase();
    }


    const button_modal_soli = document.getElementById('nueva_soli_modal');
    button_modal_soli.addEventListener('click', function(e) {
      const getData_docentes = new FormData();
      getData_docentes.append('getData_docente', 1);
      fetch('../Controlador/action.php', {
          method: 'POST',
          body: getData_docentes
        })
        .then(res => res.json())
        .then(data => {
          console.log(data);
          let res = document.querySelector("#nombre_docentes");
          res.innerHTML = '';
          for (let item of data) {
            res.innerHTML += `<option value="${item.id_persona}">${item.nombre_completo}</option>`
          }
        })
    });

    const generar_solicitud = document.getElementById('genera_solicitud');
    const formulario_solicitud = document.getElementById('form_solicitud_nueva');

    generar_solicitud.addEventListener('click', function(e) {
      e.preventDefault();


      if (form_solicitud_nueva.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        form_solicitud_nueva.classList.add('was-validated')
      } else {
        var nombre_docente = $('#nombre_docentes option:selected').text();
        const enviar_datos = new FormData(formulario_solicitud);
        enviar_datos.append('guardarDatos_soli', 1);
        enviar_datos.append('nombre_completo', nombre_docente);
        fetch('../Controlador/action.php', {
            method: 'POST',
            body: enviar_datos
          })
          .then(res => res.json())
          .then(data => {
            console.log(data);
            if (data == 'exito') {
              $('#nueva_solicitud').modal('toggle');
              swal(
                '¡Solicitud enviada con exito!',
                'datos agregados a la base de datos',
                'success'
              )
              var tabla_revision = $('#tabla_solicitud').dataTable();
              tabla_revision.api().ajax.reload();
            } else {
              swal(
                'Oops...',
                'Something went wrong!',
                'error'
              )
            }
          })
      }


    });
  </script>
</body>

</html>