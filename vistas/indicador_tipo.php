<?php

ob_start();


session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
// require_once('../clases/funcion_visualizar.php');
// require_once('../clases/funcion_permisos.php');

// $Id_objeto = 64;

// bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A Mantenimiento/Crear Comision');

// $visualizacion = permiso_ver($Id_objeto);

// if ($visualizacion == 0) {
//     //header('location:  ../vistas/menu_roles_vista.php');

//     echo '<script type="text/javascript">
//                               swal({
//                                    title:"",
//                                    text:"Lo sentimos no tiene permiso de visualizar la pantalla",
//                                    type: "error",
//                                    showConfirmButton: false,
//                                    timer: 3000
//                                 });
//                            window.location = "../vistas/menu_roles_vista.php";

//                             </script>';
// } else {

//     if (permisos::permiso_insertar($Id_objeto) == '1') {
//         $_SESSION['btn_guardar_comision'] = "";
//     } else {
//         $_SESSION['btn_guardar_comision'] = "disabled";
//     }
/*

 if (isset($_REQUEST['msj']))
 {
      $msj=$_REQUEST['msj'];
        if ($msj==1)
            {
            echo '<script> alert("Lo sentimos el rol a ingresar ya existe favor intenta con uno nuevo")</script>';
            }
   
               if ($msj==2)
                  {
                  echo '<script> alert("Rol agregado correctamente")</script>';
                  }
 }

*/
//}


ob_end_flush();


?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CREAR UN NUEVO TIPO DE INDICADOR DE GESTIÓN</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="#">Menu Mantenimiento</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/menu_mantenimientos_jefatura_principal.php"> Mantenimiento Jefatura</a></li>
                        </ol>
                    </div>

                    <div class="RespuestaAjax"></div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid ">
                <!-- pantalla 1 -->

                <div class="card card-default ">
                    <div class="card-header center">
                        <h3 class="card-title">NUEVO TIPO DE INDICADOR DE GESTIÓN</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="row">
                            <form id="enviar_Datos" class="needs-validation">
                                <!-- inicio del form -->
                                <div class="card card-default">
                                    <!--inciio primer card -->
                                    <div class="card-header" style="background-color: #ced2d7;">
                                        <h3 class="card-title"><strong>TIPOS DE INDICADORES DE GESTIÓN</strong> </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="">Fecha</label><br>
                                                <input type="text" class="form-control" id="datepicker" name="fecha_indicador" placeholder="dd/mm/yyyy" required> <br>
                                                <label for="">Nombre Recurso</label><br>
                                                <input type="text" class="form-control" id="nombre_indicador" name="nombre_indicador" required><br>
                                            </div>
                                            <br>
                                            <div class="col-12">
                                                <label for="">Descripción</label><br>
                                                <textarea cols="20" rows="5" class="form-control" id="descripcion" name="descripcion" maxlength="50" required></textarea>
                                            </div>

                                            <div class="col-12">
                                                <br>
                                                <button class="btn btn-primary" id="guardar_indicador">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- fin primer card -->
                            </form> <!-- fin del form -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
<script src="../js/tipos_indicadores.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
<script>
    $("#datepicker").datepicker({
        // format: " yyyy", // Notice the Extra space at the beginning
        // viewMode: "years",
        // minViewMode: "years"
    });
</script>