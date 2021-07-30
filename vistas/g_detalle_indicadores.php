<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

//if (permiso_ver('140') == '1') {
//
  //  $_SESSION['g_detalle_indicadores'] = "...";
  //} else {
    //$_SESSION['g_detalle_indicadores'] = "No 
    //tiene permisos para visualizar";
 // }

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
                        <h1>INDICADORES DE GESTIÓN ACADEMICA DE JEFATURA</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/g_planificacionjefatura_vista.php">Jefatura</a></li>
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
                        <h3 class="card-title">DETALLES INDICADORES DE GESTIÓN</h3>
                    </div>
                    <div class="col-3">
                        <a href="../vistas/agregar_detalles_indicadores.php" class="btn btn-success btn-m">Agregar Nuevo Detalle Indicador</a>
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.card-header -->
        <div class=" card-body">
            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">INDICADORES ACADEMICOS DETALLES</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row justify-content-center">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="tabla_detalles_indicador" class="table table-bordered table-striped" cellpadding="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">DESCRIPCION</th>
                                                        <th scope="col">NOMBRE INDICADOR</th>
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
            var table = $("#tabla_detalles_indicador").DataTable({
                "lengthMenu": [
                    [10],
                    [10]
                ],
                "order": [
                    [0, 'desc']
                ],
                "responsive": true,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar    _MENU_    Filas",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ ",
                    "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 ",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                },
                "ajax": {
                    "url": "../clases/tabla_detalles_indicador.php", 
                    "type": "POST",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id_detalles_tipo_indicador"
                    },    
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": "nombre_indicador"
                    },
                    {
                        "data": null,
                        defaultContent: '<center><div class="btn-group">'+ 
                        '<button id="ver_detalle" class="ver btn btn-danger btn - m" data-toggle="modal" data-target=".archivosAcademica"><i class="fas fa-trash"></i></button><div></center>'
                    },
                    
                ],
            });

            //table.columns([0]).visible(false);

            $('#tabla_academica tbody').on('click', '#ver_detalle', function() {
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

            $('#tabla_detalles_indicador tbody').on('click', '#descarga', function() {
                var fila = table.row($(this).parents('tr')).data();
                var nombre_archivo = fila.nombre_archivo;
                console.log(nombre_archivo);

                var url = `../archivos/file_academica/${nombre_archivo}`;
                download(url);

            });
        });
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