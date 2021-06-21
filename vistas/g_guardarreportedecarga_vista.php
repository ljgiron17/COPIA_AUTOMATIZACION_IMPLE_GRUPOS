<?php
ob_start();
session_start();


require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
require_once('../clases/conexion_mantenimientos.php');
//$registro = controlador_registro_docente::ctrRegistro();
$Id_objeto = 50;








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
                           window.location = "../vistas/menu_docentes_vista.php";

                            </script>';
} else {

  bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A REGISTRAR DOCENTE.');


  // if (permisos::permiso_insertar($Id_objeto) == '1') {
  //   $_SESSION['btn_guardar_registro_docentes'] = "";
  // } else {
  //   $_SESSION['btn_guardar_registro_docentes'] = "disabled";
  // }
}

ob_end_flush();

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <title></title>
</head>
<body>
  <form action="" method="POST" id="Formulario" class="FormularioAjax" name="miFormulario" autocomplete="off" role="form" enctype="multipart/form-data">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">

        <div class="container-fluid">

          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>GESTION DE CARGA ACADEMICA</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="../vistas/g_cargajefatura_vista.php">Jefatura</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section>
        <input type="text" name="mayoria_edad" id="mayoria_edad" readonly onload="mayoria_edad()" hidden>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- pantalla  CIUDAD UNVERSITARIA - CARGA -->
           
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">CARGAR ARCHIVOS DE CARGA ACADEMICA</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <!-- PERIODO -->
                      <label>PERIODO</label>
                      <input class="form-control" type="text" id="txt_n_empleado" name="txt_n_empleado" maxlength="6" value="" onkeypress="return solonumeros(event)" onKeyUp="pierdeFoco(this)" required>
                    </div>
                  </div>    
                  <div class="col-sm-2">
                    <div class="form-group">
                      <!-- DESCRIPCION -->
                      <label>DESCRIPCION</label>
                      <input class="form-control" type="text" id="txt_n_empleado" name="txt_n_empleado" maxlength="8" value="" onkeypress="return solonumeros(event)" onKeyUp="pierdeFoco(this)" required>
                    </div>
                  </div>        
                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- FECHA DE INGRESO txt_fecha_ingreso -->
                      <label>Fecha Ingreso</label>
                      <input class="form-control" type="date" id="txt_fecha_ingreso" name="txt_fecha_ingreso" required onkeydown="return false" required>
                    </div>
                  </div>


                  <div class="col-sm-4">
                    <div class="form-group">

                    </div>
                  </div>


                </div>


                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              
            </div>
             <!-- TERMINA  CIUDAD UNVERSITARIA - CARGA -->

             <!-- pantalla  CIUDAD UNVERSITARIA - CRAED -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">CARGAR ARCHIVOS DE CARGA CRAED</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <!-- PERIODO -->
                      <label>PERIODO</label>
                      <input class="form-control" type="text" id="txt_n_empleado" name="txt_n_empleado" maxlength="6" value="" onkeypress="return solonumeros(event)" onKeyUp="pierdeFoco(this)" required>
                    </div>
                  </div> 

                  <div class="col-sm-2">
                    <div class="form-group">
                      <!-- DESCRIPCION -->
                      <label>DESCRIPCION</label>
                      <input class="form-control" type="text" id="txt_n_empleado" name="txt_n_empleado" maxlength="8" value="" onkeypress="return solonumeros(event)" onKeyUp="pierdeFoco(this)" required>
                    </div>
                  </div>    

                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- FECHA DE INGRESO txt_fecha_ingreso -->
                      <label>Fecha Ingreso</label>
                      <input class="form-control" type="date" id="txt_fecha_ingreso" name="txt_fecha_ingreso" required onkeydown="return false" required>
                    </div>
                  </div>
                </div>


                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              
            </div>
            <!-- /.row CRAED- CARGA -->
          </div>
          <!-- INICIO INFORMACION DE AUTORIDADES CORRESPONDIENTES -->
   <!-- pantalla  CIUDAD UNVERSITARIA - CARGA -->
           
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Datos de Autoridades Correspondientes a Gestion de Cargas Acadmicas</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <!-- PERIODO -->
                      <label>Jefe del Departamento</label>
                      <input class="form-control" type="text" id="txt_n_empleado" name="txt_n_empleado" maxlength="6" value="" onkeypress="return solonumeros(event)" onKeyUp="pierdeFoco(this)" required>
                    </div>
                  </div>    
                  <div class="col-sm-2">
                    <div class="form-group">
                      <!-- DESCRIPCION -->
                      <label>Decano de la Facultad</label>
                      <input class="form-control" type="text" id="txt_n_empleado" name="txt_n_empleado" maxlength="8" value="" onkeypress="return solonumeros(event)" onKeyUp="pierdeFoco(this)" required>
                    </div>
                  </div>        
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
             <!-- TERMINA  CIUDAD UNVERSITARIA - CARGA -->
          <!-- FIN /INFORMACION DE AUTORIDADES CORRESPONDIENTES -->
          <!-- /.card-body -->
          <p class="text-center" style="margin-top: 10px;">
            <button type="submit" class="btn btn-primary btn-lg" id="btn_guardar_registro_docentes" name="btn_guardar_registro_docentes" onclick="RegistarDocente($('#txt_nombres').val(), $('#txt_apellidos').val(), $('#cb_genero').val(), $('#identidad').val(), $('#cb_nacionalidad').val(), $('#cb_ecivil').val(), $('#txt_fecha_nacimiento').val(), $('#txt_hi').val(), $('#txt_hf').val(), $('#txt_n_empleado').val(), $('#tipo_docente').val(), $('#txt_fecha_ingreso').val());   ">
              <i class="zmdi zmdi-floppy"></i>GUARDAR</button>
              <button hidden type="submit" class="btn btn-primary btn-lg" id="btn_guardar_registro_docentes2" name="btn_guardar_registro_docentes2" onclick="RegistarDocente2($('#txt_nombres').val(), $('#txt_apellidos').val(), $('#cb_genero').val(), $('#pasaporte').val(), $('#cb_nacionalidad').val(), $('#cb_ecivil').val(), $('#txt_fecha_nacimiento').val(), $('#txt_hi').val(), $('#txt_hf').val(), $('#txt_n_empleado').val(), $('#tipo_docente').val(), $('#txt_fecha_ingreso').val());   ">
              <i class="zmdi zmdi-floppy"></i>GUARDAR</button>
          </p>

        </section>
      </section>
    </div>



  </form>

  <script type="text/javascript" src="../js/funciones_registro_docentes.js"></script>
  <script type="text/javascript" src="../js/validar_registrar_docentes.js"></script>
 <!-- <script type="text/javascript" src="../js/registro_docente.js"></script> -->


</body>



</html>


