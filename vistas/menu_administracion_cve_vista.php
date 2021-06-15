<?php
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_visualizar.php');


if (permiso_ver('138')=='1') {
  $_SESSION['mantenimiento_ambitos_actividad_vista']="...";
} else {
  $_SESSION['mantenimiento_ambitos_actividad_vista']="No 
            tiene permisos para visualizar";
}

if (permiso_ver('139')=='1') {
  $_SESSION['mantenimiento_estados_actividad_vista']="...";
} else {
  $_SESSION['mantenimiento_estados_actividad_vista']="No 
            tiene permisos para visualizar";
}

if (permiso_ver('140')=='1') {
  $_SESSION['mantenimiento_tipos_repositorios_vista']="...";
} else {
  $_SESSION['mantenimiento_tipos_repositorios_vista']="No 
            tiene permisos para visualizar";
}

if (permiso_ver('141')=='1') {
  $_SESSION['mantenimiento_tipos_faltas_vista']="...";
} else {
  $_SESSION['mantenimiento_tipos_faltas_vista']="No 
            tiene permisos para visualizar";
}


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
            <h1 class="m-0 text-dark">Administración del Módulo del CVE</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active">Administración del Módulo CVE</li>
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
        <div class="row" style="display: flex; align-items: center; justify-content: center;">

          <!-- Box 1 -->
          <div class="col-6 col-sm-6 col-md-4">
            <div class="small-box bg-primary">
              <div class="inner">
                <h5>Mantenimiento <br> Ámbitos de Actividad </h5>
                <p><?php echo $_SESSION['mantenimiento_ambitos_actividad_vista']; ?></p> 
              </div>
              <div class="icon">
                <i class="fas fa-user-edit"></i>
              </div>
              <a href="../vistas/gestion_dias_feriados_vista.php" class="small-box-footer">
                Ir <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- Box 2 -->    
          <div class="col-6 col-sm-6 col-md-4">
            <div class="small-box bg-light">
              <div class="inner">
                <h5>Mantenimiento <br> Estados de Actividad </h5>
                <p><?php echo $_SESSION['mantenimiento_estados_actividad_vista']; ?></p> 
              </div>
              <div class="icon">
                <i class="fas fa-user-edit"></i>
              </div>
              <a href="../vistas/gestion_asistencia_charla_vista.php" class="small-box-footer">
                Ir <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- Box 3 -->
          <div class="col-6 col-sm-6 col-md-4">
            <div class="small-box bg-light">
              <div class="inner">
                <h5>Mantenimiento <br> Tipos de Repositorios</h5>
                <p><?php echo $_SESSION['mantenimiento_tipos_repositorios_vista'];?></p>
              </div>
              <div class="icon">
                <i class="fas fa-user-edit"></i>
              </div>
              <a href="../vistas/registrar_asignaturas_aprobadas_vista.php" class="small-box-footer">
                Ir <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- Box 4 -->
          <div class="col-6 col-sm-6 col-md-4">
            <div class="small-box bg-light">
              <div class="inner">
                <h5>Mantenimiento <br> Tipos de Faltas</h5>
                <p><?php echo $_SESSION['mantenimiento_tipos_faltas_vista']; ?></p> 
              </div>
              <div class="icon">
                <i class="fas fa-user-edit"></i>
              </div>
              <a href="../vistas/mantenimiento_tipos_faltas_vista.php" class="small-box-footer">
                Ir <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

         <!-- /.row -->
        </div><!--/. container-fluid -->
      </div>
    </section>
  <!-- /.content -->
  </div>
 
</div>

</body>
</html>