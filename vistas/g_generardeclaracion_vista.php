<?php
ob_start();
session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');

if (permiso_ver('108') == '1') {

  $_SESSION['g_generardeclaracion_vista'] = "...";
} else {
  $_SESSION['g_generardeclaracion_vista'] = "No 
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
            <h1>Declaración Jurada</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="../vistas/g_cargajefatura_vista.php">Gestión de Carga Académica</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/g_carga_declaracionjurada_vista.php">Declaración Jurada</a></li>
              <li class="breadcrumb-item active">Selección de Docentes</li>
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
              <p id="nombreDocente"></p>
              <table id="detalle_docente" class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Codigo Asignatura</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Unidades V.</th>
                    <th scope="col">Sección</th>
                    <th scope="col">N° de alumnos</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Descargar</button>
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
            <table id="tabla_docentes" class="table table-bordered table-striped">
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

    <script type="text/javascript">
      // $(document).ready(function() {
      //   var id_cord = localStorage.getItem("id_cord");
      //   var table = $("#tabla_docentes").DataTable({
      //     "lengthMenu": [
      //       [5],
      //       [5]
      //     ],
      //     "order": [
      //       [0, 'desc']
      //     ],
      //     "responsive": true,
      //     "language": {
      //       "lengthMenu": "Mostrar _MENU_ Registros",
      //       "zeroRecords": "No se encontraron resultados",
      //       "info": "Mostrando la pagina de _PAGE_ de _PAGES_",
      //       "infoEmpty": "No records available",
      //       "infoFiltered": "(Filtrado de _MAX_ Registros Totales)",
      //       "search": "Buscar:",
      //       "pagingType": "full_numbers",
      //       "oPaginate": {
      //         "sNext": "Siguiente",
      //         "sPrevious": "Anterior"
      //       },
      //     },
      //     ajax: {
      //       url: "../clases/tabla_docentes.php",
      //       type: "POST",
      //       dataSrc: {
      //         id_cord: id_cord
      //       }
      //     },
      //     "columns": [{
      //         "data": "id_coordAcademica"
      //       },
      //       {
      //         "data": "Nombre"
      //       },
      //       {
      //         "data": null,
      //         //defaultContent: '<center><input type="radio" id="selecion" name="selecion"></center>'
      //         defaultContent: '<center><div class="btn-group"><a href="../vistas/g_generardeclaracion_vista.php"><button id="verdocentes" class=" btn btn-success btn - m"><i class="fas fa-eye"></i></button></a><div></center>'
      //       },
      //     ],
      //   });

      //   $('#tabladeclaracion').on('click', '#verdocentes', function(e) {
      //     // e.preventDefault();
      //     // var fila = table.row($(this).parents('tr')).data();
      //     // var id_coordAcademica = fila.id_coordAcademica;
      //     // console.log(id_coordAcademica);
      //   });
      // });
      var retrievedObject = localStorage.getItem('data');
      const data = JSON.parse(retrievedObject);

      var table = $('#tabla_docentes').DataTable({
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
            data: 'id_coordAcademica'
          },
          {
            data: 'Nombre'
          },
          {
            data: null,
            render: function(data, type, row) {

              return '<center><button class="btn btn-primary" id="get_ID" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus " ></i></button><center>';
            }
          }
        ]

      });
      table.columns([0]).visible(false);
      $('#tabla_docentes tbody').on('click', '#get_ID', function() {
        //LECTURA DEL EVENTO PARA ELIMINAR UN REGISTRO
        var fila = table.row($(this).parents('tr')).data();
        var id_archivo = fila.id_coordAcademica;
        var nombre_docente = fila.Nombre;
        //console.log(id + '-' + nombre);
        $('#detalle_docente tbody').empty();
        document.getElementById('nombreDocente').innerHTML = nombre_docente;
        datos(id_archivo, nombre_docente);

      });

      /*function datos(){
		var retrievedObject = localStorage.getItem('data');
		console.log(JSON.parse(retrievedObject));
    }*/

      function datos(id_archivo, nombre_docente) {
        //esta envia los datos hacia la consulta        
        //alert(COD_TIENDA);
        //recupera los datos de la tabla pedidos y muestra el detalle pedidos
        $.ajax({
          type: "POST",
          url: "../clases/tabla_detalle_docente.php",
          data: {
            id_archivo: id_archivo,
            nombre_docente: nombre_docente,

          },
          dataType: 'JSON',
          // error: function(xhr, status, error) {
          //   var errorMessage = xhr.status + ':' + xhr.statusText
          //   alert('Error - ' + errorMessage);
          // },
          success: function(r) {
            console.log(r);
            var len = r.length;
            for (var i = 0; i < len; i++) {
              var codigo_asignatura = r[i].Codigo;
              var Asignatura = r[i].Asignatura;
              var unid_valorativas = r[i].UV;
              var Seccion = r[i].Seccion;
              var N_Alumnos = r[i].N_Alumnos;

              var tr_body = "<tr>" +
                "<td class='des'>" + codigo_asignatura + "</td>" +
                "<td align='center' class='cant'>" + Asignatura + "</td>" +
                "<td align='center' class='art'>" + unid_valorativas + "</td>" +
                "<td align='center' class='ped'>" + Seccion + "</td>" +
                "<td align='center' class='ped'>" + N_Alumnos + "</td>" +
                // "<td align='center'><button type='button'data-toggle='modal' data-target='#miModal'  name='editar_d' id='editar_d' class='btn btn-success btn-sm' title='Editar' ><i class='fas fa-edit' ></i></button></td>" +
                // "<td align='center'><button type='button' name='eliminar' id='eliminar' class='btn btn-danger btn-sm' title='Editar' ><i class='fas fa-times' ></i></button></td>"
                "</tr>";

              $("#detalle_docente tbody").append(tr_body);
            }
          }
        });
      }
    </script>


</body>

</html>