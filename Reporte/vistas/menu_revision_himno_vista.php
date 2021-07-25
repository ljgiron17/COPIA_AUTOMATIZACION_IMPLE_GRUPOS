<?php
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_visualizar.php');


if (permiso_ver('44')=='1'){
  $_SESSION['equivalencias']="...";
}else{
$_SESSION['equivalencias']="No 
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
            <h1 class="m-0 text-dark"> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active"></li>
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
        <div class="row" style="  display: flex; 00oo8ualign-items: center; justify-content: center;">
          
          <div class="col-12 col-sm-6 col-md-6">
               <div class="small-box bg-light">
                  <div class="inner">
                    <h4>Jornada Matutina</h4>
                    <p></p>
                  </div>
                <div class="icon">
                  <i class="fas fa-user-edit"></i>
                </div>
                <a href="../vistas/lista_alumnos_himno_vista.php?jornada=matutina" class="small-box-footer">
                Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
          </div>
            <!-- /.info-box -->
        </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

    
          <div class="col-12 col-sm-6 col-md-6">
               <div class="small-box bg-primary">
                  <div class="inner">
                    <h4>Jornada Vespertina</h4>
                    <p>
                    </p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-edit"></i>
                  </div>
                  <a href="../vistas/lista_alumnos_himno_vista.php?jornada=vespertina" class="small-box-footer">
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
