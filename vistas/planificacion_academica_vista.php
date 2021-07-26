<?php
ob_start();
session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
// require_once('../clases/funcion_bitacora.php');
// require_once('../clases/funcion_visualizar.php');
// require_once('../clases/funcion_permisos.php');

// if (permiso_ver('118') == '1') {

//   $_SESSION['g_reasignacionjefatura_vista'] = "...";
// } else {
//   $_SESSION['ayuda_menu'] = "No 
//   tiene permisos para visualizar";
// }

// if (permiso_ver('115') == '1') {

//   $_SESSION['g_cargararchivosdecargaacademica_vista'] = "...";
// } else {
//   $_SESSION['g_cargararchivosdecargaacademica_vista'] = "No 
//   tiene permisos para visualizar";
// }

// if (permiso_ver('119') == '1') {

//   $_SESSION['g_reasignacion_solicitud'] = "...";
// } else {
//   $_SESSION['g_reasignacion_solicitud'] = "No 
//   tiene permisos para visualizar";
// }


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
                            <h1 class="m-0 text-dark">Plan Operativo Anual (POA)</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Jefatura</li>
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
                        <div class="col-6 col-sm-6 col-md-4">
                            <div class="small-box bg-light">
                                <div class="inner">
                                    <h4>Plan Operativo Anual (POA)</h4>
                                    <p><?php echo "..."; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <a href="../vistas/poa_vista.php" class="small-box-footer">
                                    Ir <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- <div class="col-6 col-sm-6 col-md-4">
              <div class="small-box bg-light">
                <div class="inner">
                  <h4>Consultas</h4>
                  <p><?php echo $_SESSION['']; ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div> -->

                        <!-- <div class="col-6 col-sm-6 col-md-4"> -->
                        <!-- <div class="small-box bg-light">
                <div class="inner">
                  <h4>Retroalimentacion</h4>
                  <p><?php //echo $_SESSION['ayuda_menu'];
                        //echo '...';
                        ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <a href="g_vista_retroalimentacionJefatura.php" class="small-box-footer">
                  Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div> -->


                        <!-- /.info-box -->
                        <!-- </div> -->
                        <!-- /.col -->
                        <!-- /.row -->
                    </div>
                    <!--/. container-fluid -->
                </div>
            </section>
            <!-- /.content -->
        </div>

    </div>

</body>

</html>