<?php
ob_start();
session_start();
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/funcion_visualizar.php');
require_once ('../clases/funcion_permisos.php');

if (permiso_ver('106')=='1')
 {
  
  $_SESSION['g_carga_declaracionjurada_vista']="...";
}
else
{
$_SESSION['g_carga_declaracionjurada_vista']="No 
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
                <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                <li class="breadcrumb-item active"><a href="../vistas/g_cargajefatura_vista.php">Jefatura</a></li>
              </ol>
            </div>

            <div class="RespuestaAjax"></div>

          </div>
        </div><!-- /.container-fluid -->

      </section> 

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- pantalla 1 -->
          <form action="../Controlador/guardar_permisos_usuarios_controlador.php" method="post"  data-form="save" autocomplete="off" class="FormularioAjax">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"> </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>

          <div class="card-header">
          
            <div class="px-12 float-sm-right">

              <div class="form-group">
                <button type="submit" name="export" class="btn btn-success "  id="btn_generar_recontratacion" ><i class="zmdi zmdi-floppy"></i>Generar Declaración</button>
            </div>
            </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group">
                    <input type="text" class="global_filter form-control" id="global_filter" placeholder="buscar..." style="width: 90%;">
                    <span class="input-group-text">Buscar</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
             
                <div class="col-sm-6">
                  <div class="form-group">
                     <label>Fecha Inicio</label>
                      <input class="form-control" type="date" id="txt_fecha_inicio" name="txt_fecha_inicio"  >
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Fecha Final</label>
                      <input class="form-control" type="date" id="txt_fecha_final" name="txt_fecha_final"  >
                   </div>
                </div>


           
                <p class="text-center" style="margin-top: 20px;">
                  <button type="submit" class="btn btn-primary" id="btn_filtrar_declaracion" ><i class="zmdi zmdi-floppy"></i> Filtrar</button>
                </p>

              </div>
            </div>
          </div>
        </div> <!-- /.container-fluid -->
      </section>


      <section class="content">
        <div class="container-fluid">  

          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Historial de Declaración Jurada </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabla" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>PERIODO</th>
                  <th>DESCRIPCIÓN</th>
                  <th>FECHA</th>
                  <th>ACCIONES </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>  
                    <td>
                      <td>
                        <td style="text-align: center;">
                          <input type="checkbox" name="acciones[]" value="<?php echo $row['']; ?>">
                        </td>
                      </td>
                    </td> 
                  </td> 
                </tr>
              </tbody>
            </table>


          </div> <!-- /.card-bodyr -->


            
        </div> <!-- /.container-fluid -->
      </section>


      </div>
      <div class="RespuestaAjax"></div>

      </form>

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
  </body>
</html>
