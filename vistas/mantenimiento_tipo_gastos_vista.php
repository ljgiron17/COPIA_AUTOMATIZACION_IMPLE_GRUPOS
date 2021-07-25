<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
//require_once('../clases/funcion_visualizar.php');

// if (permiso_ver('114') == '1') {

//   $_SESSION['g_cargaacademica_vista'] = "...";
// } else {
//   $_SESSION['g_cargaacademica_vista'] = "No 
//    tiene permisos para visualizar";
// }


// $Id_objeto = 114;

// $visualizacion = permiso_ver($Id_objeto);

// $visualizacion == 0;

// if ($visualizacion == 0) {
//   header('location:  ../vistas/pagina_principal_vista.php');
// } else {
//   bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A Bitacora del sistema');
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

                        <h1>Gestión de Tipos de Gastos Operativos </h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/menu_mantenimientos_jefatura_principal.php">Mantenimientos Jefatura</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/gastos_tipo.php">Nuevo Gasto</a></li>
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
        </div>
        <!-- /.card-header -->
        <div class=" card-body">
      
      </table>
            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">MANTENIMIENTO GASTOS OPERATIVOS</a>
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
                                            <table id="tabla_gastos_tipo" class="table table-bordered table-striped" cellpadding="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">NUM GASTO</th>
                                                        <th scope="col">NOMBRE</th>
                                                        <th scope="col">DESCRIPCIÓN</th>
                                                        <th scope="col">FECHA</th>
                                                        <th scope="col">ESTADO</th>
                                                        <th scope="col">ACCIÓN</th>
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
                    <!-- <div class="tab-pane fade" id="movimientos" role="tabpanel" aria-labelledby="profile-tab">
                        <?php
                        //require 'vista_craed.php';
                        ?>
                    </div> -->
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

    <script src="../js/newGasto.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $("#tabla_gastos_tipo").DataTable({
                "lengthMenu": [
                    [4],
                    [4]
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
                    "url": "../clases/tabla_gastos_tipo.php",
                    "type": "POST",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id_tipo_gastos"
                    },
                    {
                        "data": "nombre_gasto"
                    },
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": "fecha"
                    },
                    {
                        "data": "estado"
                    },
                    {
                        "data": null,
                        defaultContent: '<center><div class="btn-group"> <button id="estado" class="ver btn btn-success btn - m" ><i class="fas fa-question-circle"</button><div></center>'
                    },
                    // {
                    //     "data": null,
                    //     defaultContent: '<center><div class="btn-group"> <button id="estado" class="ver btn btn-primary btn - m" ><i class="fas fa-question-circle"></i></button><div></center>'
                    // },
                    {
                        "data": null,
                        defaultContent: '<center><div class="btn-group"> <button id="eliminar" class="ver btn btn-danger btn - m" ><i class="fas fa-trash"></i></button><div></center>'
                    },
                ],
            });

            table.columns([0]).visible(false);

            $('#tabla_gastos_tipo tbody').on('click', '#estado', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id = fila.id_tipo_gastos;
                var estado = fila.estado;
                console.log(id, estado);
                cambiarEstado(id, estado);
                //eliminar(id_recurso_tipo);
            });


            $('#tabla_gastos_tipo tbody').on('click', '#eliminar', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id_tipo_gastos = fila.id_tipo_gastos;
                console.log(id_tipo_gastos + ' eliminar');
                eliminar(id_tipo_gastos);
            });
        });
    </script>

    <script>
        $("#datepicker").datepicker({
            // format: " yyyy", // Notice the Extra space at the beginning
            // viewMode: "years",
            // minViewMode: "years"
        });
    </script>
</body>
</html>