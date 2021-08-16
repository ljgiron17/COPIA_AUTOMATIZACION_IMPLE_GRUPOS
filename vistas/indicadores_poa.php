<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

$Id_objeto = 111;
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
                           window.location = "../vistas/indicadores_poa.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'INDICADORES POA.');


 
}

ob_end_flush()


?>


<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../js/smart_wizard_arrows.css" rel="stylesheet">

    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 500px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }

        .tab-content {
            display: block;
            height: auto !important;
            position: relative;
            margin: 0;
            padding: 0;
            border: 0 solid #CCC;
            overflow-x: hidden;
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

                        <!-- inicio modal metas -->
                        <div class="modal fade " id="metas_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Metas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="modal_actividades">
                                        <?php require '../vistas/metas_poa.php' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin modal metas -->

                        <!-- inicio modal actividdades -->
                        <div class="modal fade " id="actividades_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Actividades</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="modal_actividades">
                                        <?php require '../vistas/actividades_vista.php' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin modal actividades -->


                        <!-- inicio modal responsables     -->
                        <div class="modal fade responsables_modal" id="exampleResponsablesLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleResponsablesLabel">Responsables</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="smartwizard">
                                            <ul class="nav">
                                                <li>
                                                    <a class="nav-link" href="#step-1">
                                                        Responsables
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="#step-2">
                                                        Agregar Responsables
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div id="step-1" class="tab-pane" role="tabpanel">
                                                    <table id="tabla_responsables" class="table table-sm table-dark table-striped needs-validation" cellpadding="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">ID RESPONSABLE</th>
                                                                <th scope="col">RESPONSABLE</th>
                                                                <th scope="col">ACCIONES</th>
                                                                <th scope="col">ACCIONES</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                                <div id="step-2" class="tab-pane" role="tabpanel">
                                                    <div class="card card-default">
                                                        <!--inciio primer card -->
                                                        <div class="card-header" style="background-color: #ced2d7;">
                                                            <h3 class="card-title"><strong>AGREGAR RESPONSABLES</strong> </h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                            </div>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <div id="container">
                                                                <form id="agregar_responsables">
                                                                    <div class="form-group">
                                                                        <label for="formGroupExampleInput">Responsable</label>
                                                                        <input type="text" class="form-control" id="responsable_rs" name="responsable_rs" placeholder="Agregar responsable" required>
                                                                        <input type="text" id="id_indicador_res" name="id_indicador_res" hidden>
                                                                    </div>
                                                                    <div id="mensaje_responsable">

                                                                    </div>
                                                                    <div class="form-group d-flex">
                                                                        <div class="ml-auto p-2">
                                                                            <!-- <button class="btn btn-warning" id="guardar_edicion">Guardar edicion</button> -->
                                                                            <button class="btn btn-primary" id="guardar_responsable">Guardar</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- inicio del modal -->

                        <!-- Modal -->
                        <div class="modal fade ind_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="ind_form">
                                            <div class="container">
                                                <label for="">Nombre indicador</label>
                                                <textarea class="form-control" id="ind_indicador" name="ind_indicador" rows="3" maxlength="255" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('ind_indicador');" onkeypress="return sololetras(event)" required></textarea>
                                                <label for="">Resultado esperado</label>
                                                <textarea class="form-control" id="ind_resultado" name="ind_resultado" rows="3" maxlength="255" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('ind_resultado');" onkeypress="return sololetras(event)" required></textarea>
                                                <input type="text" id="id_indicador_edit" name="id_indicador_edit" hidden>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button class="btn btn-warning" id="edit_indicador">Guardar Edición</button>
                                        <button type="button" class="btn btn-primary" id="guardar_ind">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin del modal-->
                        <h1>Gestión de Indicadores</h1>
                    </div>
                    <!-- fin modal responsables     -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/planificacion_academica_vista.php">POA</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">

            </div>
        </section>
        <!--Pantalla 2-->
        <div class="card card-default">
            <div class="card-body  ">
                <div class="row">
                    <div class="col-9">
                        <h3 class="card-title">Registro de indicadores</h3>
                    </div>
                    <div class="col-3">
                        <!-- <button class="btn btn-warning" onclick="clearData();">Limpiar data</button>
                        <button class="btn btn-primary" onclick="updateTable();">Cargar data</button> -->
                        <a href="#" class="btn btn-success btn-m" id="new_objetivo" data-toggle="modal" data-target=".ind_modal" onclick="limpiarForm(); cambiarNombre();">Nuevo Indicador</a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item"><a class="page-link" href="../vistas/poa_vista.php">Planificaciones</a></li>
            <li class="page-item"><a class="page-link" href="../vistas/objetivos_poa.php">Objetivos</a></li>
            <li class="page-item active">
                <span class="page-link">
                    Indicadores
                    <span class="sr-only">(current)</span>
                </span>
            </li>
        </ul>

        <div class=" card-body">
            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            <strong>Indicadores</strong>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row justify-content-center">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="tabla_indicadores" class="table table-sm table-dark table-striped needs-validation" cellpadding="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID INDICADOR</th>
                                                        <th scope="col">DESCRIPCIÓN</th>
                                                        <th scope="col">RESULTADOS</th>
                                                        <th scope="col">ID_OBJETIVOS</th>
                                                        <th scope="col">ACCIONES</th>
                                                        <th scope="col">METAS</th>
                                                        <th scope="col">ACTIVIDAD</th>
                                                        <th scope="col">RESPONSABLE</th>
                                                    </tr>
                                                </thead>
                                            </table>

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
    </div>
    <div class="card-footer">

    </div>
    </div>

    </div>

    </section>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
    <script src="../js/gstion_indicadores.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>

    <script>
        var retrievedObject = localStorage.getItem('datos');
        const datos_ind = JSON.parse(retrievedObject);

        var table = $('#tabla_indicadores').DataTable({
            data: datos_ind,
            columns: [{
                    data: 'id_indicador'
                },
                {
                    data: 'descripcion'
                },
                {
                    data: 'resultados'
                },
                {
                    data: 'id_objetivo'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<center>' +
                            '<button class="btn btn-danger" id="delete_indicador" ><i class="fa fa-times" aria-hidden="true"></i></button>' + '&nbsp' +
                            '<button class="btn btn-warning" id="editar_indicador" data-toggle="modal" data-target=".ind_modal"><i class="fas fa-edit"></i></button></center>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<center><button class="btn btn-primary" id="metas_poa" data-toggle="modal" data-target="#metas_modal"><i class="fas fa-arrow-right"></i></button></center>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<center><button class="btn btn-primary" id="actividades" data-toggle="modal" data-target="#actividades_modal"><i class="fas fa-arrow-right"></i></button></center>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<center><button class="btn btn-primary" id="responsables" data-toggle="modal" data-target=".responsables_modal"><i class="fas fa-arrow-right"></i></button></center>';
                    }
                }
            ]
        });

        //?guardando las metas
        $('#tabla_indicadores tbody').on('click', '#metas_poa', function() {
            var fila = table.row($(this).parents('tr')).data();
            var id_indicador_meta = fila.id_indicador;
            //console.log(id_indicador_meta);

            localStorage.removeItem('id_indicador_meta');
            localStorage.setItem('id_indicador_meta', id_indicador_meta);
            $('#tabla_metas tbody').empty(); //limpiar la tabla despues de cada llamdo

            const form_metas = new FormData();
            form_metas.append('getData_metas', 1);
            form_metas.append('id_indicador_meta', localStorage.getItem('id_indicador_meta'));
            fetch('../Controlador/action.php', {
                    method: "POST",
                    body: form_metas
                })
                .then(res => res.json())
                .then(r => {
                    console.log(r);
                    if (r.length == 0) {
                        var tr_body = "<tr> <td align='center' colspan='7'>No hay datos en tabla</td> </tr>";
                        $("#tabla_metas tbody").append(tr_body);
                    } else {
                        //console.log('si hay data');
                        var len = r.length;
                        for (var i = 0; i < len; i++) {
                            id_metas
                            var id_metas = r[i].id_metas;
                            var trimestre_1 = r[i].trimestre_1;
                            var trimestre_2 = r[i].trimestre_2;
                            var trimestre_3 = r[i].trimestre_3;
                            var trimestre_4 = r[i].trimestre_4;

                            var tr_body = "<tr>" +
                                "<td align='center' class=''>" + id_metas + "</td>" +
                                "<td align='center' class=''>" + trimestre_1 + "</td>" +
                                "<td align='center' class=''>" + trimestre_2 + "</td>" +
                                "<td align='center' class=''>" + trimestre_3 + "</td>" +
                                "<td align='center' class=''>" + trimestre_4 + "</td>" +
                                "<td align='center'><button type='button' class='btn btn-success btn-sm' id='editar_metas' ><i class='fas fa-edit' ></i></button></td>" +
                                "<td align='center'><button type='button' class='btn btn-danger btn-sm' id='eliminar_meta' ><i class='fas fa-times' ></i></button></td>"
                            "</tr>";
                            $("#tabla_metas tbody").append(tr_body);
                        }
                    }
                }) //final del r
        });
        //?guardando las metas

        //! tabla de actividades
        $('#tabla_indicadores tbody').on('click', '#actividades', function() {

            var fila = table.row($(this).parents('tr')).data();
            var id_indicador_act = fila.id_indicador;
            //console.log(id_indicador_act);

            localStorage.removeItem('id_indicador_act');
            localStorage.setItem('id_indicador_act', id_indicador_act)

            $('#tabla_actividades tbody').empty(); //limpiar la tabla despues de cada llamdo
            const form_actividades = new FormData();
            form_actividades.append('id_indicador_act', id_indicador_act);
            form_actividades.append('getdata_Act', 1);
            fetch('../Controlador/action.php', {
                    method: "POST",
                    body: form_actividades
                })
                .then(res => res.json())
                .then(r => {
                    //console.log(r);
                    if (r.length == 0) {
                        var tr_body = "<tr> <td align='center' colspan='7'>No hay datos en tabla</td> </tr>";
                        $("#tabla_actividades tbody").append(tr_body);
                    } else {
                        //console.log('si hay data');
                        var len = r.length;
                        for (var i = 0; i < len; i++) {
                            var id_actividades_poa = r[i].id_actividades_poa;
                            var actividad = r[i].actividad;
                            var id_verificacion = r[i].id_verificacion;
                            var medio_veri = r[i].medio_veri;
                            var pobla_objetivo = r[i].pobla_objetivo;

                            var tr_body = "<tr>" +
                                "<td align='center' class=''>" + id_actividades_poa + "</td>" +
                                "<td align='center' class=''>" + actividad + "</td>" +
                                "<td align='center' class=''>" + id_verificacion + "</td>" +
                                "<td align='center' class=''>" + medio_veri + "</td>" +
                                "<td align='center' class=''>" + pobla_objetivo + "</td>" +
                                "<td align='center'><button type='button' class='btn btn-success btn-sm' id='editar_act' ><i class='fas fa-edit' ></i></button></td>" +
                                "<td align='center'><button type='button' class='btn btn-danger btn-sm' id=''eliminar_act' ><i class='fas fa-times' ></i></button></td>"
                            "</tr>";
                            $("#tabla_actividades tbody").append(tr_body);
                        }
                    }

                }) //fin ultimo then
        });
        //!fin tabla de actividades

        //!add responsables
        $('#tabla_indicadores tbody').on('click', '#responsables', function() {
            var fila = table.row($(this).parents('tr')).data();
            var id_indicador_res = fila.id_indicador;
            //console.log(id_indicador_res);        
            localStorage.removeItem('id_indicador_res');
            localStorage.setItem('id_indicador_res', id_indicador_res);
            document.getElementById('id_indicador_res').value = id_indicador_res;
            var get_data_res = 'get_data_res';
            removeTableBody();
            $.ajax({
                type: "POST",
                url: "../Controlador/action.php",
                data: {
                    id_indicador: id_indicador_res,
                    get_data_res: get_data_res
                },
                dataType: 'JSON',
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ':' + xhr.statusText
                    alert('Error - ' + errorMessage);
                },
                success: function(r) {
                    // console.log(r);
                    if (r.length == 0) {
                        var tr_body = "<tr> <td align='center' colspan='4'>No hay datos en tabla</td> </tr>";
                        $("#tabla_responsables tbody").append(tr_body);
                    } else {
                        var len = r.length;
                        for (var i = 0; i < len; i++) {
                            var descripcion = r[i].id_responsables;
                            var cantidad = r[i].descripcion_responsable;

                            var tr_body = "<tr>" +
                                "<td class='des'>" + descripcion + "</td>" +
                                "<td align='center' class='cant'>" + cantidad + "</td>" +
                                "<td align='center'><button type='button' id='edit_responsable' class='btn btn-success'><i class='fas fa-edit' ></i></button></td>" +
                                "<td align='center'><button type='button' id='delete_responsable' class='btn btn-danger'><i class='fas fa-times' ></i></button></td>"
                            "</tr>";
                            $("#tabla_responsables tbody").append(tr_body);
                        }
                    }

                }
            });

        });
        //! fin add responsables

        $('#tabla_indicadores tbody').on('click', '#editar_indicador', function() {
            var fila = table.row($(this).parents('tr')).data();
            var id_indicador_edit = fila.id_indicador;
            var descripcion = fila.descripcion;
            var resultados = fila.resultados;
            //console.log(id_indicador_edit);
            document.getElementById('exampleModalLabel').innerHTML = "Editar indicador";
            document.getElementById('ind_indicador').value = descripcion;
            document.getElementById('ind_resultado').value = resultados;

            document.getElementById('id_indicador_edit').value = id_indicador_edit;

            document.getElementById('guardar_ind').style.display = 'none';
            if ($('#edit_indicador').css('display') == 'none') {
                document.getElementById('edit_indicador').style.display = '';
            }
        });


        $('#tabla_indicadores tbody').on('click', '#delete_indicador', function() {
            var fila = table.row($(this).parents('tr')).data();
            var id_indicador = fila.id_indicador;
            var id_objetivo = fila.id_objetivo;

            localStorage.removeItem('ID_objetivo');
            localStorage.setItem('ID_objetivo', id_objetivo);
            delete_Indicador(id_indicador);


        });
        // table.columns([0]).visible(false);
        table.columns([3]).visible(false);

        function delete_Indicador(id_indicador) {
            swal({
                title: '¿Desea eliminar este registro?',
                text: "¡no será capaz de recuperarlo!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¿Si, Eliminar!',
                cancelButtonText: '¿No, cancelar!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function() {
                const form_delete_indicador = new FormData();
                form_delete_indicador.append('indicador_delete', 1);
                form_delete_indicador.append('id_indicador', id_indicador)
                fetch('../Controlador/action.php', {
                        method: "POST",
                        body: form_delete_indicador
                    })
                    .then(res => res.json())
                    .then(data => {
                        //console.log(data);
                        if (data == 'exito') {
                            actualizar_table_indicadores();
                        }
                    })
            }, function(dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelado',
                        '¡El proceso se ha cancelado!',
                        'warning'
                    )
                }
            })
        }

        function actualizar_table_indicadores() {
            const form_update_indicadores = new FormData();
            form_update_indicadores.append('get_data_indicador', 1);
            form_update_indicadores.append('id_obj_send', localStorage.getItem('ID_objetivo'));

            fetch('../clases/tabla_indicadores.php', {
                    method: 'POST',
                    body: form_update_indicadores
                })
                .then(res => res.json())
                .then(data => {
                    //console.log(data);
                    if (data.length == 0) {
                        //console.log('sin datos');
                        var table = $('#tabla_indicadores').DataTable();
                        table
                            .clear()
                            .draw();
                        swal(
                            'Exito!',
                            '¡Datos eliminados correctamente!',
                            'success'
                        )
                    } else {
                        clearData();
                        localStorage.removeItem('datos');
                        localStorage.setItem('datos', JSON.stringify(data));
                        updateTable();
                        swal(
                            '¡Exito!',
                            '¡Datos eliminados correctamente!',
                            'success'
                        );
                    }

                })
        }

        function updateTable() {
            var retrievedObject = localStorage.getItem('datos');
            const datos_ind = JSON.parse(retrievedObject);
            $('#tabla_indicadores').dataTable().fnClearTable();
            $('#tabla_indicadores').dataTable().fnAddData(datos_ind);
        }

        function limpiarForm() {
            document.getElementById('ind_form').reset();
        }

        function cambiarNombre() {
            document.getElementById('exampleModalLabel').innerHTML = "Nuevo indicador";
            document.getElementById('ind_form').reset();
            document.getElementById('edit_indicador').style.display = 'none';
            if ($('#guardar_ind').css('display') == 'none') {
                document.getElementById('guardar_ind').style.display = '';
            }

        }

        function removeTableBody() {
            $('#tabla_responsables tbody').empty();
        }
    </script>
    <script type="text/javascript">
        // // SmartWizard initialize
        $('#smartwizard').smartWizard({
            theme: 'arrows',
            transitionEffect: 'fade',
            transitionSpeed: '300',
            lang: { // Language variables for button
                next: 'Siguiente',
                previous: 'Anterior'
            }
        });

        function call_wizard() {
            $('#smartwizard').smartWizard("reset");
        }
    </script>

    <script>
        //?opciones de eliminacion tabla responsables
        //Modal detalle pedidos segundo modal
        $('#tabla_responsables tbody').on('click', '#delete_responsable', function() {
            var fila = $(this).closest('tr');
            var id_responsable = fila.find('td:eq(0)').text();
            // var cod_pedido = fila.find('td:eq(3)').text();
            // var cod_tienda = $('#codigo_oculto').val();
            console.log(id_responsable);

            swal({
                title: '¿Seguro que desea borrar este registro?',
                text: "¡No podrá recuperar este registro!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'No, cancelar!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function() {
                const form_responsables_delete = new FormData();
                form_responsables_delete.append('dele_responsable', 1);
                form_responsables_delete.append('id_responsable', id_responsable)
                fetch('../Controlador/action.php', {
                        method: 'POST',
                        body: form_responsables_delete
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                        if (data == 'exito') {
                            actualizr_responsables();
                            $('#tabla_responsables tbody').empty();
                            swal(
                                'Eliminado!',
                                'Su registro se a eliminado',
                                'success'
                            )
                        } else {
                            swal(
                                'Alto!',
                                'Algo ocurrio mal.',
                                'error'
                            )
                        }
                    })
            }, function(dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelado!',
                        'Su registro sigue en la base de datos',
                        'info'
                    )
                }
            })

        });
        //?opciones de eliminacion tabla responsables

        //?opcion es de edicion responsables
        $('#tabla_responsables tbody').on('click', '#edit_responsable', function() {
            var fila = $(this).closest('tr');
            var id_responsable = fila.find('td:eq(0)').text();
            var descripcion_responsable = fila.find('td:eq(1)').text();
            console.log(descripcion_responsable);
            // document.getElementById('responsable_rs').value = descripcion_responsable;
            // $('#smartwizard').smartWizard("next");
        });
        //?opcion es de edicion responsables
        
        
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
    function letrasynumeros(e){
        
        key=e.keyCode || e.wich;
    
        teclado= String.fromCharCode(key).toUpperCase();
    
        letras= "ABCDEFGHIJKLMNOPQRSTUVWXYZÑ1234567890";
        
        especiales ="8-37-38-46-164";
    
        teclado_especial=false;
    
        for (var i in especiales) {
          
          if(key==especiales[i]){
            teclado_especial= true;break;
          }
        }
    
        if (letras.indexOf(teclado)==-1 && !teclado_especial) {
          return false;
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

</body>

</html>