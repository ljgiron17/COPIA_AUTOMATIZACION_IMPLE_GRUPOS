<?php
ob_start();
session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');

if (permiso_ver('112') == '1') {

  $_SESSION['g_generarrecontratacion_vista'] = "...";
} else {
  $_SESSION['g_generarrecontratacion_vista'] = "No 
  tiene permisos para visualizar";
}
?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Recontratación </h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/g_cargajefatura_vista.php">Gestión de Carga Académica</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/g_carga_recontratacion_vista.php">Recontratación</a></li>
              <li class="breadcrumb-item active">Selección de docentes</li>
            </ol>
          </div>

          <div class="RespuestaAjax"></div>

        </div>

      </div><!-- /.container-fluid -->

    </section>
    <!-- inicio de modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Información Docente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <p id="nombreDocenteCR"></p>
              <table id="detalle_docenteCR" class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Centro CRAED</th>
                    <th scope="col">Días</th>
                    <th scope="col">Semana</th>
                    <th scope="col">Sección</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Generar reporte</button>
          </div>
        </div>
      </div>
    </div>
    <!-- fin de modal -->

    <!-- pantalla 2 -->
    <section class="content">
      <div class="container-fluid">


        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Selección de Docentes</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabla_docentesCR" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">NOMBRE DOCENTES</th>
                  <th scope="col">ACCIÓN</th>
                </tr>
              </thead>
            </table>
          </div> <!-- /.card-body -->


        </div> <!-- /.container-fluid -->
    </section>
    <!-- <div class="RespuestaAjax"></div>-->


  </div>

  <script type="text/javascript">
    var retrievedObject = localStorage.getItem('data');
    const data = JSON.parse(retrievedObject);

    var table = $('#tabla_docentesCR').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ Registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando la pagina de _PAGE_ de _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(Filtrado de _MAX_ Registros Totales)",
        "search": "Buscar:",
        "pagingType": "full_numbers",
        "oPaginate": {
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      },
      data: data,
      columns: [{
          data: 'id_craed_jefa'
        },
        {
          data: 'Profesor'
        },
        {
          data: null,
          render: function(data, type, row) {

            return '<center><button class="btn btn-primary" id="get_ID" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus " ></i></button><center>';
          }
        }
      ]
    });

    //table.columns([0]).visible(false);
    $('#tabla_docentesCR tbody').on('click', '#get_ID', function() {

      var fila = table.row($(this).parents('tr')).data();
      var id_craed_jefa = fila.id_craed_jefa;
      var nombre_docente = fila.Profesor;
      //console.log(id_craed_jefa+'-'+nombre_docente);

      $('#detalle_docenteCR tbody').empty();
      document.getElementById('nombreDocenteCR').innerHTML = nombre_docente;
      datos(id_craed_jefa, nombre_docente);
    });

    function datos(id_craed_jefa, nombre_docente) {
      $.ajax({
        type: "POST",
        url: "../clases/tabla_detalle_docenteCR.php",
        data: {
          id_craed_jefa: id_craed_jefa,
          nombre_docente: nombre_docente
        },
        dataType: 'JSON',
        success: function(r) {
          console.log(r);
          var len = r.length;
          for (var i = 0; i < len; i++) {
            var Asignatura_cr = r[i].Asignatura_cr;
            var Centro_cr = r[i].Centro_cr;
            var Dias_cr = r[i].Dias_cr;
            var Semana = r[i].Semana;
            var Seccion_cr = r[i].Seccion_cr;

            var tr_body = "<tr>" +
              "<td class='des'>" + Asignatura_cr + "</td>" +
              "<td align='center' class='cant'>" + Centro_cr + "</td>" +
              "<td align='center' class='art'>" + Dias_cr + "</td>" +
              "<td align='center' class='ped'>" + Semana + "</td>" +
              "<td align='center' class='ped'>" + Seccion_cr + "</td>" +
              // "<td align='center'><button type='button'data-toggle='modal' data-target='#miModal'  name='editar_d' id='editar_d' class='btn btn-success btn-sm' title='Editar' ><i class='fas fa-edit' ></i></button></td>" +
              // "<td align='center'><button type='button' name='eliminar' id='eliminar' class='btn btn-danger btn-sm' title='Editar' ><i class='fas fa-times' ></i></button></td>"
              "</tr>";

            $("#detalle_docenteCR tbody").append(tr_body);
          }
        }
      });

    }
  </script>


</body>

</html>