<?php
ob_start();
session_start();
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/funcion_visualizar.php');
require_once ('../clases/funcion_permisos.php');

if (permiso_ver('110')=='1')
 {
  
  $_SESSION['g_carga_recontratacion_vista']="...";
}
else
{
$_SESSION['g_carga_recontratacion_vista']="No 
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
            <h1>Recontratación</h1>
            </div>

            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                <li class="breadcrumb-item active"><a href="../vistas/g_cargajefatura_vista.php">Jefatura</a></li>
              </ol>
            </div>

            <div class="RespuestaAjax"></div>

          </div>
        </div><!-- /.container-fluid -->

      </section> 

      <!-- Main content 
      <section class="content">
        <div class="container-fluid">

              pantalla 1 -->
    <!--form action="../Controlador/guardar_permisos_usuarios_controlador.php" method="post"  data-form="save" autocomplete="off" class="FormularioAjax"-->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title"> </h3>
        <!--<div class="card-tools">
             <a href="../vistas/g_generardeclaracion_vista.php" class="btn btn-success">Generar Declaración</a>
              
               ABAJITO BORRÉ EL MINIMIZAR QUE NO LO NECESITABA
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>-->
      </div>

      <!-- <div class="card-header">-->

      <div class="box-header with-border">
        <div class="px-12 float-sm-right">
          <div class="form-group">
            <!--button type="submit" name="export" class="btn btn-success "  id="btn_generar_recontratacion" ><i class="zmdi zmdi-floppy"></i>Generar Declaración</button-->



          </div>
        </div>
      </div>
         <!-- pantalla 2 --> 
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Historial de Recontratación</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabla_recontratacion" class="table table-bordered table-striped">
            <thead>
                  <tr>
                    <th scope="col">ID CARGA</th>
                    <th scope="col">PERIODO</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">ACCIÓN</th>
                  </tr>
                </thead>
              </table>


          </div> <!-- /.card-bodyr -->


            
        </div> <!-- /.container-fluid -->
      </section>


      </div>
      <div class="RespuestaAjax"></div>

    <!--/form-->

    </div>

    <script type="text/javascript">
  

      $(function () {
   
        $('#tabla').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "responsive": true,
        });
      });
    </script>

<script type="text/javascript">
    $(document).ready(function() {
      var table = $("#tabla_recontratacion").DataTable({
        "lengthMenu": [
          [5],
          [5]
        ],
        "order": [
          [0, 'desc']
        ],
        "responsive": true,
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
        "ajax": {
          "url": "../clases/tabla_recontratacion.php",
          "type": "POST",
          "dataSrc": ""
        },
        "columns": [{
            "data": "id_craed_jefa"
          },
          {
            "data": "periodo_cr"
          },
          {
            "data": "fecha_cr"
          },
          {
            "data": null,
            //defaultContent: '<center><input type="radio" id="selecion" name="selecion"></center>'
            defaultContent: '<center><div class="btn-group"><a href="../vistas/g_generarrecontratacion_vista.php"><button id="verdocentesCR" class=" btn btn-success btn - m"><i class="fas fa-eye"></i></button></a><div></center>'
          },
        ],
      });

      $('#tabla_recontratacion').on('click', '#verdocentesCR', function(e) {
        e.preventDefault();
        var fila = table.row($(this).parents('tr')).data();
        var id_craed_jefa = fila.id_craed_jefa;
        window.localStorage.clear();

        const formulario = new FormData();
        formulario.append('enviar_docente', 1);
        formulario.append('id_craed_jefa', id_craed_jefa);
        fetch('../clases/tabla_docentesCR.php', {
            method: 'POST',
            body: formulario
          })
          .then(res => res.json())
          .then(data => {
            console.log(data);
            localStorage.setItem('data', JSON.stringify(data));            
            window.location.href = "../vistas/g_generarrecontratacion_vista.php";
          })
      });

    });
    </script>
  </body>
</html>
