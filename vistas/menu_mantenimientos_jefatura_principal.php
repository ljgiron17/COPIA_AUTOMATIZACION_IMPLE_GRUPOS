<?php
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');


if (permiso_ver('255') == '1') {

  $_SESSION['menu_mantenimientos_jefatura_principal'] = "...";
} else {
  $_SESSION['menu_mantenimientos_jefatura_principal'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('258') == '1') {

  $_SESSION['recursos_tipo'] = "...";
} else {
  $_SESSION['recursos_tipo'] = "No 
  tiene permisos para visualizar";
}
//recursos

//requerimientos
if (permiso_ver('259') == '1') {

  $_SESSION['mantenimiento_tipos_recursos'] = "...";
} else {
  $_SESSION['mantenimiento_tipos_recursos'] = "No 
  tiene permisos para visualizar";
}

if (permiso_ver('260') == '1') {

  $_SESSION['gastos_tipo'] = "...";
} else {
  $_SESSION['gastos_tipo'] = "No 
  tiene permisos para visualizar";
}
//requerimientos

//gastos
if (permiso_ver('261') == '1') {

  $_SESSION['mantenimiento_tipo_gastos_vista'] = "...";
} else {
  $_SESSION['mantenimiento_tipo_gastos_vista'] = "No 
  tiene permisos para visualizar";
}


if (permiso_ver('262') == '1') {

  $_SESSION['indicador_tipo'] = "...";
} else {
  $_SESSION['indicador_tipo'] = "No 
  tiene permisos para visualizar";
}
//gastos fin

//indicadores
if (permiso_ver('263') == '1') {

  $_SESSION['mantenimiento_tipo_indicadores'] = "...";
} else {
  $_SESSION['mantenimiento_tipo_indicadores'] = "No 
  tiene permisos para visualizar";
}

$Id_objeto = 255;


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
                           window.location = "../vistas/menu_mantenimientos_jefatura_principal.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A MENU MANTENIMIENTOS JEFATURA.');


 
}

ob_end_flush();


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">MANTENIMIENTOS JEFATURA</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/g_planificacionjefatura_vista.php">Jefatura</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->


      <div class="card card-default">
          <div class="card-header">
          
          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
            <div class="col-md-12">
              
     
        

      <!-- /. tipo de recursos operativos de jefatura -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">
            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Tipo Recurso</h4>
                  <p><?php echo $_SESSION['recursos_tipo']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/recursos_tipo.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <!-- /.info-box -->
            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Recursos </h4>
                  <p><?php echo $_SESSION['mantenimiento_tipos_recursos']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_tipos_recursos.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

            </div>
            <!-- /.row -->
          </div>
          <!--/. termina las cajas de recursos operativos -->
        </div>

      </section>
      <!-- /.content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

           
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid  aqui termina requerimientos-->
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Tipo de Gastos Operativos</h4>
                  <p><?php echo $_SESSION['gastos_tipo']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/gastos_tipo.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Gastos </h4>
                  <p><?php echo $_SESSION['gastos_tipo']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i> 
                </div>

                <a href="../vistas/mantenimiento_tipo_gastos_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.row -->
          </div>
          <!--/. container-fluid aqui termina gastos operativos-->
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">

            <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Crear Indicador de Gestión </h4>
                  <p><?php echo $_SESSION['indicador_tipo']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-plus-square"></i>
                </div>

                <a href="../vistas/indicador_tipo.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-4">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>Mantenimiento Indicador de Gestión </h4>
                  <p><?php echo $_SESSION['mantenimiento_tipo_indicadores']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-edit"></i>
                </div>

                <a href="../vistas/mantenimiento_tipo_indicadores.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

            </div>

            <!-- /.row -->
          </div>
          <!--/. container-fluid aqui termina indicadores de gestión-->
        </div>

<!-- /.form-group -->
       </div>  
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          </div>
  </div>
  </div>
</body>
</html>