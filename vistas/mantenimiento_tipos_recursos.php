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
                                                    <h3 class="card-title"><strong>TIPOS DE RECURSOS</strong> </h3>
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
                                                            <label for="">Nombre Recurso</label><br>
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

                        <h1>Gestión de Tipos de Recursos </h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/menu_mantenimiento_recursos.php">Recursos</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/recursos_tipo.php">Nuevo Recurso</a></li>
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


            <!-- <div class="card-body  ">
                <div class="row">
                    <div class="col-9">
                        <h3 class="card-title">Registros de Tipos de recurso</h3>
                    </div>
                    <div class="col-3">
                        <a href="../vistas/recursos_tipo.php" class="btn btn-success btn-m" >Nuevo Tipo de Recurso</a>
                    </div>

                </div>

               

            </div> -->

        </div>
        <!-- /.card-header -->
        <div class=" card-body">
            <!-- <table id="tabla" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>PERIODO</th>
            <th>DESCRIPCIÓN</th>
            <th>FECHA</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
            <td>
            <td>
            <td>
              <div class="btn-group"> <button class="ver btn btn-primary btn - m">
                  <i class="fas fa-eye"></i>
                </button>
                <button class="editar btn btn-success btn-m">
                  <i class="fas fa-edit"></i>
                </button>
                <div>

        </tbody>
      </table> -->
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
                                            <table id="tabla_recursos_tipo" class="table table-bordered table-striped" cellpadding="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">NUM RECURSO</th>
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

    <script src="../js/tipos_recursos.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $("#tabla_recursos_tipo").DataTable({
                "lengthMenu": [
                    [10],
                    [10]
                ],
                "order": [
                    [0, 'desc']
                ],
                "responsive": true,
                "ajax": {
                    "url": "../clases/tabla_recursos_tipo.php",
                    "type": "POST",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id_recurso_tipo"
                    },
                    {
                        "data": "nombre_recurso"
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

            $('#tabla_recursos_tipo tbody').on('click', '#estado', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id = fila.id_recurso_tipo;
                var estado = fila.estado;
                console.log(id, estado);
                cambiarEstado(id, estado);
                //eliminar(id_recurso_tipo);
            });

            $('#tabla_recursos_tipo tbody').on('click', '#editar', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id = fila.id_recurso_tipo;
                var descripcion = fila.descripcion;
                var fecha = fila.fecha;
                var nombre_recurso = fila.nombre_recurso;
                document.getElementById('descripcion_ed').value = descripcion;
                document.getElementById("datepicker").value = fecha;
                document.getElementById("nombre_recurso_ed").value = nombre_recurso;

            });


            $('#tabla_recursos_tipo tbody').on('click', '#eliminar', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id_recurso_tipo = fila.id_recurso_tipo;
                console.log(id_recurso_tipo + ' eliminar');
                eliminar(id_recurso_tipo);
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