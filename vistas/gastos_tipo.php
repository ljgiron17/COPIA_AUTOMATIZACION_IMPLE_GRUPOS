<?php

ob_start();


session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');

$Id_objeto = 129;


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
                           window.location = "../vistas/gastos_tipo.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A LOS TIPOS DE GASTOS.');


 
}

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


                        <h1>CREAR UN NUEVO TIPO DE GASTO</h1>
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
                        <h3 class="card-title">NUEVO TIPO DE GASTO</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="row">
                            <form id="enviar_Datos">
                                <!-- inicio del form -->
                                <div class="card card-default">
                                    <!--inciio primer card -->
                                    <div class="card-header" style="background-color: #ced2d7;">
                                        <h3 class="card-title"><strong>TIPOS DE GASTOS</strong> </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="">Fecha</label><br>
                                                <input type="text" class="form-control" id="datepicker" name="fecha_gasto" placeholder="dia/mes/año" required> <br>
                                                <label for="">Nombre Gasto</label><br>
                                                <input type="text" class="form-control" id="nombre_gasto" name="nombre_gasto"  maxlength="20" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('nombre_gasto');" onkeypress="return sololetras(event)" required>
                                                <!-- <label for="">Gastos Tipos</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="1">Vaitico</option>
                                                    <option value="2">Mantenimiento</option>
                                                    <option value="3">Pasajes</option>
                                                    <option value="4">Eventos/Capacitaciones</option>
                                                </select> -->
                                            </div>
                                            <br>
                                            <div class="col-12">
                                                <label for="">Descripción</label><br>
                                                <textarea cols="20" rows="5" class="form-control" id="descripcion" name="descripcion" maxlength="50" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('descripcion');" onkeypress="return sololetras(event)" required></textarea>
                                            </div>

                                            <div class="col-12">
                                                <br>
                                                <button class="btn btn-primary" id="guardar_gasto">Guardar</button>
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
<script src="../js/newGasto.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
<script>
    $("#datepicker").datepicker({
        // format: " yyyy", // Notice the Extra space at the beginning
        // viewMode: "years",
        // minViewMode: "years"
    });
</script>
<script type="text/javascript" language="javascript">
    function MismaLetra(id_input) {
        var valor = $('#' + id_input).val();
        var longitud = valor.length;
        //console.log(valor+longitud);
        if (longitud > 2) {
            var str1 = valor.substring(longitud - 3, longitud - 2);
            var str2 = valor.substring(longitud - 2, longitud - 1);
            var str3 = valor.substring(longitud - 1, longitud);
            nuevo_valor = valor.substring(0, longitud - 1);
            if (str1 == str2 && str1 == str3 && str2 == str3) {
                swal('Error', 'No se permiten 3 letras consecutivamente', 'error');

                $('#' + id_input).val(nuevo_valor);
            }
        }
    }
    function validate(s){
        if (/^(\w+\s?)*\s*$/.test(s)){
          return s.replace(/\s+$/,  '');
        }
        return 'NOT ALLOWED';
        }
        
        validate('tes ting')      //'test ing'
        validate('testing')       //'testing'
        validate(' testing')      //'NOT ALLOWED'
        validate('testing ')      //'testing'
        validate('testing  ')     //'testing'
        validate('testing   ')   

    function sololetras(e) {

        key = e.keyCode || e.wich;

        teclado = String.fromCharCode(key).toUpperCase();

        letras = " ABCDEFGHIJKLMNOPQRSTUVWXYZÑ";

        especiales = "8-37-38-46-164";

        teclado_especial = false;

        for (var i in especiales) {

            if (key == especiales[i]) {
                teclado_especial = true;
                break;
            }
        }

        if (letras.indexOf(teclado) == -1 && !teclado_especial) {
            return false;
        }

    }
</script>