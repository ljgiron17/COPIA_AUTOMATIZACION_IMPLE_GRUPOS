<?php
ob_start();
session_start();
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/funcion_visualizar.php');
require_once ('../clases/funcion_permisos.php');

if (permiso_ver('112')=='1')
 {
  
  $_SESSION['g_generarrecontratacion_vista']="...";
}
else
{
$_SESSION['g_generarrecontratacion_vista']="No 
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
              <li class="breadcrumb-item active"><a href="../vistas/g_cargajefatura_vista.php">Jefatura</a></li>
            </ol>
          </div>

          <div class="RespuestaAjax"></div>

        </div>

      </div><!-- /.container-fluid -->
        
    </section>

    
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
          <table id="tabla" class="table table-bordered table-striped">
            <thead>
              <tr>
              <th>DOCENTES</th>
              <th>ACCIONES </th>
              </tr>
              <thead>
                <td>SELECCIONAR TODO</td>
                <td style="text-align: center;">
                <input type="checkbox" name="acciones[]" value="<?php echo $row['']; ?>">
              </thead>
            </thead>
            <tbody>
              <tr>
                <td>  </td>
                <td style="text-align: center;">
                <input type="checkbox" name="acciones[]" value="<?php echo $row['']; ?>">
              </tr>
            </tbody>

          </table>
          <div class="px-12 text-center">
            <a href="#" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i>Generar Documento de Recontratación</a>
          </div>
        </div> <!-- /.card-body -->


      </div> <!-- /.container-fluid -->
    </section>
    <div class="RespuestaAjax"></div>


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