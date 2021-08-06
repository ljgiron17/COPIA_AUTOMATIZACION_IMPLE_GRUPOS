<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
$Id_objeto = 120;
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
                           window.location = "../vistas/g_reasignacion_retroalimentacion.php";
                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A GESTIÓN RETROALIMENTACIÓN.');

}
ob_end_flush(); 

?>


<!DOCTYPE html>
<html>

<head>
  <title></title>

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
            <input id="" type="submit" name="enviar" class="btn btn-primary" value="Generar PDF">
          </form>
          <!-- <button type="button"  >Generar PDF</button> -->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal -->

  <!-- segundo modal Inicio -->
  <div class="modal fade" id="nueva_retroali" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nueva Solicitud</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_retro_nueva">
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
            <div class="row">
              <div class="col-4">
                <label for="">Cantidad horas</label>
                <input type="text" id="horas_soli" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="horas_soli" class="form-control" number maxlength="2" required>
              </div>
              <div class="col-4">
                <label for="">Cantidad clases</label>
                <input type="text" id="cant_clases" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="cant_clases" class="form-control" number maxlength="1" required>
              </div>
              <div class="col-4">
                <label for="">N° Memo</label>
                <input type="text" id="n_memo" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="n_memo" class="form-control" number maxlength="6" required>
              </div>
            </div>
            <label for="">Avance Realizado</label>
            <textarea class="form-control" id="avance_realizado" name="avance_realizado" rows="3" onkeyup="mayusculas(this);" required></textarea>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="genera_retroalimentacion">Enviar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- segundo modal fin -->

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

            </ol>
          </div>

          <div class="RespuestaAjax"></div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="card card-default">


      <div class="card-body  ">
        <div class="row">
          <div class="col-9">
            <h3 class="card-title">Registro de retroalimentación</h3>
          </div>
          <div class="col-3">
            <a href="#" class="btn btn-success btn-m" data-toggle="modal" id="nueva_soli_retro" data-target="#nueva_retroali">Nueva retroalimentación</a>
          </div>
        </div>
        <!-- <a href="../vistas/g_cargararchivosdecargaacademica_vista.php" class="btn btn-success btn-m">Nueva Gestión de Carga</a> -->
      </div>

    </div>


    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Retroalimentación</h3>
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
              <th scope="col">AVANCES</th>
              <th scope="col">DETALLES</th>
              <th scope="col">PDF</th>
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
            "data": "avances"
          },
          {
            "data": null,
            defaultContent: '<center><div class="btn-group"><button id="ver_detalles" class="ver btn btn-success btn - m" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-eye"></i></button><div></center>'
          }, {
            "data": null,
            defaultContent: '<center> <button class="btn btn-primary" id="generar_pdf">Generar</button></center>'
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

      $('#tabla_retroalimentacion tbody').on('click', '#generar_pdf', function() {
        var fila = table.row($(this).parents('tr')).data();
        var id = fila.id_retroalimentacion;
        console.log(id);
        redir(id);
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
            //console.log(data);
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

    function redir(data) {
      document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../pdf/pdf_retro_alimentacion.php"><input type="text" name="id_retro_soli" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
      // document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../pdf/getDataReasignacion.php"><input type="text" name="id_cliente" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
      document.getElementById('redirbtn').click();
    }

    const mostrar_modal = document.getElementById('nueva_soli_retro');
    mostrar_modal.addEventListener('click', function(e) {
      e.preventDefault();

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


    $("#datepicker, #datepicker1").datepicker();

    function mayusculas(e) {
      e.value = e.value.toUpperCase();
    }

    //!agregar una nueva retroalimentación

    const new_retro = document.getElementById('genera_retroalimentacion');
    const form_retro = document.getElementById('form_retro_nueva');

    new_retro.addEventListener('click', function(e) {
      if (form_retro_nueva.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        form_retro_nueva.classList.add('was-validated')
      } else {
        var nombre_docente = $('#nombre_docentes option:selected').text();

        const new_form = new FormData(form_retro);
        new_form.append('nueva_retro', 1);
        new_form.append('nombre_completo', nombre_docente);
        e.preventDefault();
        fetch('../Controlador/action.php', {
            method: 'POST',
            body: new_form
          })
          .then(res => res.json())
          .then(data => {
            console.log(data);
            if (data == 'exito') {
              $('#nueva_retroali').modal('toggle');
              swal(
                '¡Solicitud enviada con exito!',
                'datos agregados a la base de datos',
                'success'
              )
              var tabla_revision = $('#tabla_retroalimentacion').dataTable();
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

    //! FIN agregar una nueva retroalimentación
  </script>
</body>

</html>