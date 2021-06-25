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
</head>


<body>

  <!-- inicio modal EDITAR EL USUARIO DE LA SOLICITUD DE REASIGNACION -->
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
          <label for="">ID DOCENTE</label><br>
          <input type="text" placeholder="id"><br>
          <label for="">NOMBRE DOCENTE</label> <br>
          <input type="text" placeholder="nombre docente"><br>
          <label for="">Nombre Proyecto</label> <br>
          <input type="text" placeholder="nombre proyecto"><br>
          <label for="">fecha inicio</label><br>
          <input type="text" placeholder="fecha"><br>
          <label for="">fecha final</label><br>
          <input type="text" placeholder="fecha"><br>
          <label for="">avance realizado</label><br>
          <input type="text" placeholder="avance"> <br>
          <label for="">periodo del proyecto</label><br>
          <input type="text" placeholder="periodo"><br>
          <label for="">cant horas</label><br>
          <input type="text" placeholder="horas"> <br>

          Aqui se mostraranlos detalles de la solicitud en formato PDF
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger">Denegar</button>
          <button type="button" class="btn btn-success">Aceptar</button>
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

      <div class="card-footer">

      </div>
    </div>

  </div>
  </section>

  </div>


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
            defaultContent: '<center><div class="btn-group"><button id="ver_detalles" class="ver btn btn-primary btn - m" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-eye"></i></button><div></center>'
          },
          // { "data": "ip" },
          // { "data": "cambio" },                                                    
        ],


      });

      $('#tabla_solicitud tbody').on('click', '#ver_detalles', function() {
        //LECTURA DEL EVENTO PARA ELIMINAR UN REGISTRO
        var fila = table.row($(this).parents('tr')).data();
        var id = fila.id_reac_academica;
        console.log(id);
      });
    });
  </script>
</body>

</html>