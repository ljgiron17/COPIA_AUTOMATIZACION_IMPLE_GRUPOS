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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
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


                        <!-- inicio del modal -->
                        <div id="modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Envio de datos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editar_datos" class="needs-validation">
                                            <!-- inicio del form -->
                                            <div class="card card-default">
                                                <!--inciio primer card -->
                                                <div class="card-header" style="background-color: #ced2d7;">
                                                    <h3 class="card-title"><strong>TIPOS DE INDICADORES</strong> </h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="">Fecha</label><br>
                                                            <input type="text" class="form-control" id="datepicker" name="fecha_recurso_ed" placeholder="dd/mm/yyyy" required> <br>
                                                            <label for="">Nombre guardar_indicador</label><br>
                                                            <input type="text" class="form-control" id="nombre_recurso_ed" name="nombre_recurso_ed" required><br>
                                                        </div>
                                                        <br>
                                                        <div class="col-12">
                                                            <label for="">Descripción</label><br>
                                                            <textarea cols="20" rows="5" class="form-control" id="descripcion_ed" name="descripcion_ed" maxlength="50" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- fin primer card -->
                                        </form> <!-- fin del form -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" id="">Enviar</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin del modal -->

                        <h1>Gestión de Tipos de Indicadores de Gestión</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/menu_mantenimientos_jefatura_principal.php">Mantenimientos Jefatura</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/indicador_tipo.php">Nuevo Indicador</a></li>
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

            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Recursos</a>
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
                                            <table id="tabla_indicadores_tipo" class="table table-bordered table-striped" cellpadding="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">NUM INDICADOR</th>
                                                        <th scope="col">NOMBRE</th>
                                                        <th scope="col">DESCRIPCIÓN</th>
                                                        <th scope="col">FECHA</th>
                                                        <th scope="col">ESTADO</th>
                                                        <th scope="col">ACCIÓN</th>
                                                        <th scope="col">ELIMINAR</th>
                                                        <th scope="col">EDICIÓN</th>
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

    <script src="../js/newIndicador.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $("#tabla_indicadores_tipo").DataTable({
                "lengthMenu": [
                    [10],
                    [10]
                ],
                "order": [
                    [0, 'desc']
                ],
                "responsive": true,
                                     //desde aqui
        dom: 'Bfrtip',
        "buttons": [{
            extend: 'copyHtml5',
            title: 'Datos Exportados',
            text: 'Copiar <i class="fas fa-copy"></i>',
            messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            exportOptions: {
              columns: [0, 1, 2, 3]
            }
          },
          {
            extend: 'excelHtml5',
            title: 'Datos Exportados',
            text: 'Excel <i class="fas fa-file-excel"></i>',
            messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            exportOptions: {
              columns: [0, 1, 2, 3]
            }
          },
          {
            extend: 'pdfHtml5',
            title: 'Datos Exportados',
            text: 'PDF <i class="fas fa-file-pdf"></i>',
            messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            exportOptions: {
              columns: [0, 1, 2, 3]
            }
          },
        ],
        //hasta aqui

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
                    "url": "../clases/tabla_indicadores_tipo.php",
                    "type": "POST",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id_indicadores_gestion"
                    },
                    {
                        "data": "nombre_indicador"
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
                    {
                        "data": null,
                        defaultContent: '<center><div class="btn-group"> <button id="editar" data-toggle="modal" data-target="#modal" class="ver btn btn-warning btn - m" ><i class="fas fa-edit"></i></button><div></center>'
                    },
                ],

            });
            
            table.columns([0]).visible(false);

            $('#tabla_indicadores_tipo tbody').on('click', '#estado', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id = fila.id_indicadores_gestion;
                var estado = fila.estado;
                console.log(id, estado);
                cambiarEstado(id, estado);
                //eliminar(id_recurso_tipo);
            });

            $('#tabla_indicadores_tipo tbody').on('click', '#editar', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id = fila.id_indicadores_gestion;
                var descripcion = fila.descripcion;
                var fecha = fila.fecha;
                var nombre_indicador = fila.nombre_indicador;
                document.getElementById('descripcion_ed').value = descripcion;
                document.getElementById("datepicker").value = fecha;
                document.getElementById("nombre_indicador_ed").value = nombre_indicador;

            });


            $('#tabla_indicadores_tipo tbody').on('click', '#eliminar', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id_indicadores_gestion = fila.id_indicadores_gestion;
                console.log(id_indicadores_gestion + 'eliminar');
                eliminar(id_indicadores_gestion);
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