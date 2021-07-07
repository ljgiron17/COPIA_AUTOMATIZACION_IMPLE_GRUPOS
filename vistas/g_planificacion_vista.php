<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

if (permiso_ver('114') == '1') {

  $_SESSION['g_planificacion'] = "...";
} else {
  $_SESSION['g_planificacion'] = "No 
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
              <h1>Proyecto Operativo Anual (POA)</h1>
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

      <section class="content">
        <div class="card card-default">
          <div class="card-body  ">
            <div class="row">
              <div class="col-9">
                <h3 class="card-title">Registros de Cargas Académicas</h3>
              </div>
              <div class="col-3">
                <a  href="#" class="btn btn-primary btn-m"  data-toggle="modal" data-target="#Modal"><i class="fas fa-plus"></i>    Nuevo POA</a>
              </div>    
            </div>
          </div>
        </div>

        <!-- /.card-header -->
        <div class=" card-body">
          <div class="container-fluid">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Planificación</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab" aria-controls="movimientos" aria-selected="false">Objetivos de la Planificación</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="indicadores-tab" data-toggle="tab" href="#indicadores" role="tab" aria-controls="#" aria-selected="false">Indicadores</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="#" data-toggle="tab" href="#" role="tab" aria-controls="#" aria-selected="false">Indicadores Actividades</a>
              </li>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="#" data-toggle="tab" href="#" role="tab" aria-controls="#" aria-selected="false">Indicadores Responsables</a>
              </li>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="#" data-toggle="tab" href="#" role="tab" aria-controls="#" aria-selected="false">Indicadores Metas</a>
              </li>
           </ul>
           
           <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row justify-content-center"> <!--empieza aqui-->
                  <div class="container-fluid">
                    <div class="card">
                      <div class="card-body">
                        <table id="tabla_planificacion" class="table table-bordered table-striped" >
                          <thead>
                            <tr>
                              <th>FECHA</th>
                              <th>DESCRIPCIÓN</th>
                              <th>ACCIONES</th>
                            </tr>
                          </thead>
                        </table>
                        <!--tbody>
                          <tr>
                            <td> </td>
                          </tr>
                        </tbody-->

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade " id="movimientos" role="tabpanel" aria-labelledby="profile-tab">
                <?php
                  require 'g_planif_objetivos_vista.php';
                ?>
              </div>
              <div class="tab-pane fade " id="indicadores" role="tabpanel" aria-labelledby="profile-tab">
                <?php
                  require 'g_planif_indicadores_vista.php';
                ?>
              </div>
          </div><!-- /.container-fluid -->
        </div><!-- /.card-body -->

      </section>
      <div class="RespuestaAjax"></div>


            <!-- modal crear POA -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="Modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Nuevo Proyecto Operativo Anual</h5>
              <button class="close" data-dismiss="modal"> &times;</button>
            </div>

            <div class="modal-body">
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Fecha:</label>
                    <input class="form-control" type="date" id="txt_fecha_poa" name="txt_fecha_poa">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Descripción:</label>
                    <input class="form-control" type="text" id="txt_descripcion_planificacion" name="txt_descripcion_planificacion"  value="" style="text-transform: uppercase" onkeyup="Espacio(this, event)"  onkeypress="return Letras(event)"  >
                    
                  </div>
                </div>


              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="Siguiente">Siguiente</button>
              </div>

            </div>
          </div>
        </div>
      </div>






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

 

  <body>
</html>