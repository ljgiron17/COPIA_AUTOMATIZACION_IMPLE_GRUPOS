<?php
ob_start();
session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');


//if (permiso_ver('124') == '1') {

  //$_SESSION['poa_vista'] = "...";
//} else {
  //$_SESSION['poa_vista'] = "No 
  //tiene permisos para visualizar";
//}

//if (permiso_ver('139') == '1') {

  //$_SESSION['g_detalle_recursos'] = "...";
//} else {
  //$_SESSION['g_detalle_recursos'] = "No 
  //tiene permisos para visualizar";
//}
//if (permiso_ver('140') == '1') {

  //$_SESSION['g_detalle_indicadores'] = "...";
//} else {
  //$_SESSION['g_detalle_indicadores'] = "No 
  //tiene permisos para visualizar";
//}

//if (permiso_ver('140') == '1') {

  //$_SESSION['g_detalle_gastos'] = "...";
//} else {
  //$_SESSION['g_detalle_gastos'] = "No 
  //tiene permisos para visualizar";
//}

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
              <h1 class="m-0 text-dark">PLANIFICACION ACADEMICA DE JEFATURA</h1>
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



      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row" style="  display: flex;
    align-items: center;
    justify-content: center;">



            <div class="col-4 col-sm-4 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h5>PLAN OPERATIVO ANUAL(POA)</h5>
                  <p><?php echo $_SESSION['poa_vista']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-edit"></i>
                </div>
                <a href="../vistas/poa_vista.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>


            <div class="col-4 col-sm-4 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h5>GESTIÓN DE RECURSOS</h5>
                  <p><?php echo $_SESSION['g_detalle_recursos']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-edit"></i>

                </div>
                <a href="../vistas/g_detalle_recursos.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>

            </div>


            <div class="col-4 col-sm-4 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h5>GESTIÓN DE GASTOS OPERATIVOS</h5>
                  <p><?php echo $_SESSION['g_detalle_gastos']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-edit"></i>
                </div>
                <a href="../vistas/g_detalle_gastos.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h5>GESTIÓN DE INDICADORES ACADEMICOS</h5>
                  <p><?php echo $_SESSION['g_detalle_indicadores']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-edit"></i>
                </div>
                <a href="../vistas/g_detalle_indicadores.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!--/. container-fluid -->
        </div>
      </section>
      <!-- /.content -->
    </div>
  </div> <!-- /.info-box -->
  </div> <!-- /.container-fluid -->
  </section>
  </div>
  </div>
</body>
</html>