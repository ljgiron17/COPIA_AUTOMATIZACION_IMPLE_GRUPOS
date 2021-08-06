<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

$Id_objeto = 125;


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
                           window.location = "../vistas/poa_vista.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A LOS DETALLES DE GASTOS.');


 
}

ob_end_flush();

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
                        <h1>GESTIÓN DE GASTOS OPERATIVOS DE JEFATURA</h1>
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
                        <h3 class="card-title">DETALLES DE REGISTRO DE GASTOS</h3>
                    </div>
                    <div class="col-3">
                        <a href="../vistas/agregar_detalles_gastos.php" class="btn btn-success btn-m">Agregar Detalles Gastos</a>
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
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">RECURSOS DETALLES</a>
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
                                            <table id="tabla_detalles_gastos" class="table table-bordered table-striped" cellpadding="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">NOMBRE</th>
                                                        <th scope="col">CANTIDAD</th>
                                                        <th scope="col">DESCRIPCION</th>
                                                        <th scope="col">PRECIO</th>
                                                        <th scope="col">TOTAL</th>
                                                        <th scope="col">NOMBRE GASTO</th>
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
            var table = $("#tabla_detalles_gastos").DataTable({
                "lengthMenu": [
                    [5],
                    [5]
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
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Datos Exportados',
                        text: 'Excel <i class="fas fa-file-excel"></i>',
                        messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
                        messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Datos Exportados',
                        text: 'PDF <i class="fas fa-file-pdf"></i>',
                        messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
                        messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                ],
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
                    "url": "../clases/tabla_detalles_gastos.php",
                    "type": "POST",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id_detalle_tipo_gasto"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": "precio_aprox"
                    },
                    {
                        "data": "cantidad"
                    },
                    {
                        "data": "total"
                    },
                    {
                        "data": "nombre_gasto"
                    },
                    {
                        "data": null,
                        defaultContent: '<center> <button id="eliminar_datell_gasto" class="btn btn-danger">Eliminar</center>'
                    },

                ],
            });

            table.columns([0]).visible(false);

            $('#tabla_detalles_gastos tbody').on('click', '#eliminar_datell_gasto', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id_detalle_tipo_gasto = fila.id_detalle_tipo_gasto;
                console.log(id_detalle_tipo_gasto);

                const formulario_datell_gastos = new FormData();
                formulario_datell_gastos.append('eliminar_detalle_gasto', 1);
                formulario_datell_gastos.append('id_detalle_tipo_gasto', id_detalle_tipo_gasto);

                fetch('../Controlador/action.php', {
                        method: 'POST',
                        body: formulario_datell_gastos
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                        if (data == 'exito') {
                            swal(
                                'Exito...',
                                'Datos guardados!',
                                'success'
                            )
                            $('#tabla_detalles_gastos').DataTable().ajax.reload();
                        } else {
                            swal(
                                'Oops...',
                                'Something went wrong!',
                                'error'
                            )
                        }
                    })

            });

            // $('#tabla_academica tbody').on('click', '#descarga', function() {
            //     var fila = table.row($(this).parents('tr')).data();
            //     var nombre_archivo = fila.nombre_archivo;
            //     console.log(nombre_archivo);

            //     var url = `../archivos/file_academica/${nombre_archivo}`;
            //     download(url);

            // });
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