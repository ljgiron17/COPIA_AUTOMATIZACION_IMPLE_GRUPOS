<?php 
session_start();
require_once ('../clases/Conexion.php');
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/funcion_bitacora.php');
  require_once ('../clases/funcion_visualizar.php');

  if (permiso_ver('119')=='1')
  {
   
   $_SESSION['g_reasignacion_solicitud']="...";
 }
 else
 {
 $_SESSION['g_reasignacion_solicitud']="No 
   tiene permisos para visualizar";
 
 }


        $Id_objeto=119 ; 

        $visualizacion= permiso_ver($Id_objeto);

        ?>


 <!DOCTYPE html>
<html>
<head>
  <title></title>
</head>


<body >
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">


            <h1>Retroalimentacion de Reasignaciones</h1>
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
              <h3 class="card-title">Retroalimentaciones</h3>
              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
           
           
            <div class="card card-default">
             
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabla" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>ID DOCENTE</th>
                 <th>NOMBRE</th>
                 <th>JORNADA</th>
                 <th>CLASE A REASIGNAR</th>
                 <th>ACTIVIDAD A REALIZAR</th>
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
  

 $(function () {
   
    $('#tabla').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });


</script>
</body>
</html>