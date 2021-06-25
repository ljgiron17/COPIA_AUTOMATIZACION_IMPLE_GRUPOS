<?php
ob_start();
session_start();
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/funcion_visualizar.php');
require_once ('../clases/funcion_permisos.php');

if (permiso_ver('121')=='1')
 {
  
  $_SESSION['g_planificacionjefatura_vista']="...";
}
else
{
$_SESSION['ayuda_menu']="No 
  tiene permisos para visualizar";

}

?>
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
            <h1 class="m-0 text-dark">Práctica Profesional Supervisada</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active">Vinculación</li>
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


 <!-- manteniminento indicadores de gestion -->

   <div class="col-6 col-sm-6 col-md-4">
   <div class="small-box bg-primary">
   <div class="inner">
    <h5>Mantenimiento Indicadores Gestión</h5>
   <p><?php echo $_SESSION['mantenimiento_dias_feriados']; ?></p> 
  </div>
  <div class="icon">
    <i class="fas fa-user-edit"></i>
  </div>
  <a href="../vistas/gestion_dias_feriados_vista.php" class="small-box-footer">
    Ir <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>

 <!-- mantenimiento de tipo de recursos -->
<div class="col-6 col-sm-6 col-md-4">
   <div class="small-box bg-primary">
   <div class="inner">
    <h5>Mantenimiento Tipo de Recursos </h5>
   <p><?php echo $_SESSION['mantenimiento_dias_feriados']; ?></p> 
  </div>
  <div class="icon">
    <i class="fas fa-user-edit"></i>
  </div>
  <a href="../vistas/gestion_dias_feriados_vista.php" class="small-box-footer">
    Ir <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>

 <!-- mantenimiento de tipos de gastos-->

<div class="col-6 col-sm-6 col-md-4">
   <div class="small-box bg-primary">
   <div class="inner">
    <h5>Mantenimiento Tipo de Gastos</h5>
   <p><?php echo $_SESSION['mantenimiento_dias_feriados']; ?></p> 
  </div>
  <div class="icon">
    <i class="fas fa-user-edit"></i>
  </div>
  <a href="../vistas/gestion_dias_feriados_vista.php" class="small-box-footer">
    Ir <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>
    
   <div class="col-6 col-sm-6 col-md-4">
   <div class="small-box bg-light">
   <div class="inner">
    <h5>Gestión Inscripción </h5>
   <p><?php echo $_SESSION['gestion_inscripcion_menu']; ?></p> 
  </div>
  <div class="icon">
    <i class="fas fa-user-edit"></i>
  </div>
  <a href="../vistas/gestion_asistencia_charla_vista.php" class="small-box-footer">
    Ir <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>


<div class="col-6 col-sm-6 col-md-4">
  <div class="small-box bg-light">
  <div class="inner">
    <h5>Registro de Asignaturas Aprobadas</h5>
   <p><?php echo $_SESSION['registrar_clases_aprobadas_menu'];?></p>
  </div>
  <div class="icon">
        <i class="fas fa-user-edit"></i>

  </div>
  <a href="../vistas/registrar_asignaturas_aprobadas_vista.php" class="small-box-footer">
   Ir <i class="fas fa-arrow-circle-right"></i>
  </a>
  </div>
 
  </div>

  


   <div class="col-6 col-sm-6 col-md-4">
  <div class="small-box bg-light">
  <div class="inner">
    <h5>Aprobación/Rechazo de PPS</h5>
   <p><?php  echo $_SESSION['aprobacion_rechazo_practica_menu'];?></p>
  </div>
  <div class="icon">
    <i class="fas fa-user-plus"></i>
  </div>
  <a href="../vistas/aprobar_practica_coordinacion_vista.php" class="small-box-footer">
   Ir <i class="fas fa-arrow-circle-right"></i>
  </a>
  </div>
   <!-- /.info-box -->
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