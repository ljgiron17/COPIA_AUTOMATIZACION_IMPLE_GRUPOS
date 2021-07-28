<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
// require_once('../clases/funcion_bitacora.php');
// require_once('../clases/funcion_visualizar.php');

// if (permiso_ver('114') == '1') {

//   $_SESSION['g_cargaacademica_vista'] = "...";
// } else {
//   $_SESSION['g_cargaacademica_vista'] = "No 
//    tiene permisos para visualizar";
// }


// $Id_objeto = 114;

// $visualizacion = permiso_ver($Id_objeto);



// if ($visualizacion == 0) {
//   header('location:  ../vistas/pagina_principal_vista.php');
// } else {
//   bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A Bitacora del sistema');
// }


// if (isset($_REQUEST['msj'])) {
//   $msj = $_REQUEST['msj'];

//   if ($msj == 1) {
//     echo '<script> alert("Fecha invalidas favor verificar.")</script>';
//   }

//   if ($msj == 2) {
//     echo '<script> alert("Datos por rellenar, por favor verificar.")</script>';
//   }
//   if ($msj == 3) {
//     echo '<script> alert("Por favor verificar fechas.")</script>';
//   }
// }

// 
?>


<!DOCTYPE html>
<html>

<head>
    <title></title>

    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 500px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
</head>


<body>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión de Carga Académica</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/g_cargajefatura_vista.php">Jefatura</a></li>
                        </ol>
                    </div>



                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- pantalla 1 -->



            </div>
        </section>
        <!--Pantalla 2-->
        <div class="card card-default">


            <div class="card-body  ">
                <div class="row">
                    <div class="col-9">
                        <h3 class="card-title">Registro de detalle recursos</h3>
                    </div>
                    <div class="col-3">
                        <a href="../vistas/agregar_detalles_recursos.php" class="btn btn-success btn-m">Agregar Detalle recursos</a>
                    </div>

                </div>

                <!-- <a href="../vistas/g_cargararchivosdecargaacademica_vista.php" class="btn btn-success btn-m">Nueva Gestión de Carga</a> -->

            </div>

        </div>
        <!-- /.card-header -->
        <div class=" card-body">

            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detalle Recurso</a>
                    </li>
                    <!-- <li class="nav-item">
            <a class="nav-link" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab" aria-controls="movimientos" aria-selected="false">CRAED</a>
          </li> -->
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row justify-content-center">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="tabla_detalles_recursos" class="table table-bordered table-striped" cellpadding="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">NOMBRE</th>
                                                        <th scope="col">CANTIDAD</th>
                                                        <th scope="col">DESCRIPCION</th>
                                                        <th scope="col">PRECIO</th>
                                                        <th scope="col">TOTAL</th>
                                                        <th scope="col">NOMBRE RECURSO</th>
                                                        <th scope="col">ELIMINAR</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <!--Tabla de informacion de  usuarios-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">

            </div>


        </div>


        <!-- /.card-body -->
    </div>


    <!-- /.card-body -->
    <div class="card-footer">

    </div>
    </div>

    </div>

    </section>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />



    <script src="../js/jefatura.js"></script>
    <!-- <script type="text/javascript">
    $(function() {

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
  </script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $("#tabla_detalles_recursos").DataTable({
                "lengthMenu": [
                    [5],
                    [5]
                ],
                "order": [
                    [0, 'desc']
                ],
                "responsive": true,
                "ajax": {
                    "url": "../clases/tabla_detalles_recursos.php",
                    "type": "POST",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id_detalle_tipo_recurso"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "cantidad"
                    },
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": "precio_aprox"
                    },
                    {
                        "data": "total"
                    },
                    {
                        "data": "nombre_recurso"
                    },
                    {
                        "data": null,
                        defaultContent: '<center><div class="btn-group">'+ 
                        '<button id="ver_detail" class="ver btn btn-danger btn - m" data-toggle="modal" data-target=".archivosAcademica"><i class="fas fa-trash"></i></button><div></center>'
                    },
                ],
            });

            $('#tabla_academica tbody').on('click', '#ver_detail', function() {
                var fila = table.row($(this).parents('tr')).data();
                var nombre_archivo = fila.nombre_archivo;
                console.log(nombre_archivo);
                //comienza ajax
                var ver_excel_ca = "ver_excel_ca";
                $.ajax({
                    url: "../Controlador/action.php",
                    type: "POST",
                    dataType: "html",
                    data: {
                        nombre_archivo: nombre_archivo,
                        ver_excel_ca: ver_excel_ca
                    },
                    success: function(r) {
                        console.log(r);
                        //document.getElementById('cargar_excel').innerHTML = r;
                        $('#cargar_excel').html(r);
                    } //FIN SUCCES
                });
                //FIN  AJAX
            });

            $('#tabla_academica tbody').on('click', '#descarga', function() {
                var fila = table.row($(this).parents('tr')).data();
                var nombre_archivo = fila.nombre_archivo;
                console.log(nombre_archivo);

                var url = `../archivos/file_academica/${nombre_archivo}`;
                download(url);

            });
        });

        // function download(url) {
        //     var link = document.createElement("a");
        //     $(link).click(function(e) {
        //         e.preventDefault();
        //         window.location.href = url;
        //     });
        //     $(link).click();
        // }
    </script>

    <script>
        $("#datepicker, #datepicker1").datepicker({
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
</body>

</html>


<script>
    //este script srive para validar los campos del modal
    $("#descrp_ca, #descrip_cr").keypress(function(key) {
        if ((key.charCode < 97 || key.charCode > 122) //letras mayusculas
            &&
            (key.charCode < 65 || key.charCode > 90) //letras minusculas
            &&
            (key.charCode != 45) //retroceso
            &&
            (key.charCode != 241) //ñ
            &&
            (key.charCode != 209) //Ñ
            &&
            (key.charCode != 225) //á
            &&
            (key.charCode != 233) //é
            &&
            (key.charCode != 237) //í
            &&
            (key.charCode != 243) //ó
            &&
            (key.charCode != 250) //ú
            &&
            (key.charCode != 193) //Á
            &&
            (key.charCode != 201) //É
            &&
            (key.charCode != 205) //Í
            &&
            (key.charCode != 211) //Ó
            &&
            (key.charCode != 218) //Ú 
            &&
            (key.charCode != 95) //_
            &&
            (key.charCode != 32) //espacio
        )
            return false;
    });
    //fin validacion  
</script>