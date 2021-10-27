<?php
ob_start();
session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');

if (permiso_ver('239') == '1') {

  $_SESSION['g_generardeclaracion_vista'] = "...";
} else {
  $_SESSION['g_generardeclaracion_vista'] = "No 
  tiene permisos para visualizar";
}
?>
<!DOCTYPE html>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
</head>

<body>

  <!-- modal final -->
  <!-- Modal -->
  <div class="modal fade" id="modal_final_ca" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Datos Jefe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_reporte_ind">
            <label for="">Nombre Jefe</label>
            <input type="text" class="form-control" id="nombre_jefe" name="nombre_jefe" onkeyup="mayusculas(this);" required>
            <label for="">Departamento</label>
            <input type="text" class="form-control" id="depto" name="depto" onkeyup="mayusculas(this);" required>
            <label for="">Numero de identidad</label>
            <input type="text" class="form-control" id="identidad" name="identidad" required>
            <label for="">Profesión</label>
            <input type="text" class="form-control" id="profesion" name="profesion" onkeyup="mayusculas(this);" required>
            <input type="text" id="nombreEnviar_docente" hidden readonly>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="reporte_modal_individual">Generar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal final -->

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
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/g_cargajefatura_vista.php">Gestión de Carga Académica</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/g_carga_declaracionjurada_vista.php">Declaración Jurada</a></li>
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
              <input type="text" id="nombre_docenteSend" hidden>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <!-- <button type="button" class="btn btn-primary" id="reporte_individual">Generar reporte</button> -->
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
                  <th scope="col">GENERAR</th>
                </tr>
              </thead>
            </table>
          </div> <!-- /.card-body -->
        </div> <!-- /.container-fluid -->
    </section>
    <div id="redirect"></div>
  </div>

  <script type="text/javascript">
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
        },
        {
          data: null,
          render: function(data, type, row) {
            return '<center><button class="btn btn-success" data-toggle="modal" data-target="#modal_final_ca" id="generar_docto">Generar WORD</button><center>';
          }
        }
      ],
    });
    table.columns([0]).visible(false);


    $('#tabla_docentes tbody').on('click', '#get_ID', function() {
      //LECTURA DEL EVENTO PARA ELIMINAR UN REGISTRO
      var fila = table.row($(this).parents('tr')).data();
      var id_archivo = fila.id_coordAcademica;
      var nombre_docente = fila.Nombre;
      console.log(id_archivo);
      $('#detalle_docente tbody').empty();
      document.getElementById('nombreDocente').innerHTML = nombre_docente;
      datos(id_archivo, nombre_docente);

    });

    $('#tabla_docentes tbody').on('click', '#generar_docto', function() {
      var fila = table.row($(this).parents('tr')).data();
      var nombre_docente = fila.Nombre;
      console.log(nombre_docente);
      document.getElementById('nombreEnviar_docente').value = nombre_docente;
      //document.getElementById('form_reporte_ind').reset();
      //redir(nombre_docente);
      //window.location.href = '../Reporte/reporte_individual.php?enviar=enviar&nombre_docente=' + nombre_docente + '';
    });

    /*function datos(){
		var retrievedObject = localStorage.getItem('data');
		console.log(JSON.parse(retrievedObject));
    }*/

    function redir(data) {
      //document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../pdf/getDataReasignacion.php"><input type="text" name="id_cliente" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
      document.getElementById('redirect').innerHTML = '<form style="display:none;" position="absolute" method="get" target="_blank" action="../Reporte/reporte_individual.php"><input type="text" name="nombre_docente" value = ' + data + '><input id="redirbtn" type="submit" name="enviar" value=' + data + '></form>';
      document.getElementById('redirbtn').click();
    }

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


  <script>
    // reporte desde el modal
    // const reporte = document.getElementById('reporte_individual');
    // reporte.addEventListener('click', function(e) {
    //   e.preventDefault();
    //   var fila = table.row($(this).parents('tr')).data();
    //   console.log(id_archivo);
    //   //window.location.href = "../Reporte/reporte_individual.php";
    // });
    //fin reporte desde el modal
    const button_individual = document.getElementById('reporte_modal_individual');
    button_individual.addEventListener('click', function(e) {
      e.preventDefault();
      
      if (form_reporte_ind.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        form_reporte_ind.classList.add('was-validated')
      } else {
        var nombre_jefe = document.getElementById('nombre_jefe').value;
        var depto = document.getElementById('depto').value;
        var identidad = document.getElementById('identidad').value;
        var periodo = localStorage.getItem('periodo');
        var nombre_docente = document.getElementById('nombreEnviar_docente').value;
        var profesion = document.getElementById('profesion').value;  
        var id_coordAcademica = localStorage.getItem('id_coordAcademica');      
        window.location.href = '../Reporte/reporte_individual.php?enviar=enviar&nombre_docente=' + nombre_docente + '&nombre_jefe=' + nombre_jefe + '&depto=' + depto + '&identidad=' + identidad + '&periodo=' + periodo + '&profesion=' + profesion + '&id_coordAcademica='+id_coordAcademica+'';                
        $('#modal_final_ca').modal('toggle');
        document.getElementById('form_reporte_ind').reset();
      }

    });


    function mayusculas(e) {
      e.value = e.value.toUpperCase();
    }
  </script>
</body>

</html>