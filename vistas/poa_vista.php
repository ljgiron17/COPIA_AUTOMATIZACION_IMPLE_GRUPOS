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

?>


<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap is required -->
    <link href="/path/to/bootstrap-steps.css" rel="stylesheet">
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

                        <!-- inicio modal mostrar poa -->
                        <div class="modal fade bd-example-modal-xl" id="mostrar_poa_final" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myExtraLargeModalLabel">Mostrar POA</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        require_once '../vistas/mostrar_poa.php';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin modal mostra poa -->


                        <!-- inicio del modal -->
                        <!-- Modal -->
                        <div class="modal fade poa_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="poa_form">
                                            <div class="container">
                                                <label for="">Nombre planificación</label>
                                                <input type="text" id="n_planificacion" name="n_planificacion" class="form-control" maxlength="150" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('n_planificacion');" onkeypress="return sololetras(event)" required>
                                                <label for="">Fecha</label>
                                                <input type="text" id="datepicker" name="txt_fecha_ingreso_ca" onkeydown="return false" class="form-control" placeholder="AÑO" required="">

                                                <label for="">Descripción</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" maxlength="255" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('descripcion');" onkeypress="return sololetras(event)" required></textarea>
                                                <input type="text" id="id_plani_edit" name="id_plani_edit" hidden>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-warning" id="edit_plani">Guardar Edición</button>
                                        <button type="button" class="btn btn-primary" id="guardar_plani">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin del modal-->
                        <h1>Gestión de POA</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="../vistas/planificacion_academica_vista.php">POA</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!--Pantalla 2-->
        <div class="card card-default">
            <div class="card-body  ">
                <div class="row">
                    <div class="col-9">
                        <h3 class="card-title">Registro de planificaciones</h3>
                    </div>
                    <div class="col-3">
                        <a href="#" class="btn btn-success btn-m" data-toggle="modal" data-target=".poa_modal" onclick="cambiarNombre();">Nueva planificación</a>
                    </div>
                </div>
            </div>
        </div>

        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item active">
                <span class="page-link">
                    Planificaciones
                    <span class="sr-only">(current)</span>
                </span>
            </li>
            <li class="page-item"><label class="page-link">Objetivos</label></li>
            <li class="page-item"><label class="page-link">Indicadores</label></li>
        </ul>

        <div class=" card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Planificaciones</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row justify-content-center">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tabla_poa" class="table table-bordered table-striped needs-validation" cellpadding="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID PLANIFICACIÓN</th>
                                                    <th scope="col">NOMBRE</th>
                                                    <th scope="col">DESCRIPCIÓN</th>
                                                    <th scope="col">FECHA</th>
                                                    <th scope="col">AÑO</th>
                                                    <th scope="col">CREAR OBJETIVOS</th>
                                                    <th scope="col">VER POA</th>
                                                    <th scope="col">ACCIONES</th>
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
    </div>
    <div class="card-footer">
    </div>
    </div>

    </div>

    </section>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
    <script src="../js/plan_operativo.js"></script>
    <!-- <script src="../js/popper.min.js"></script> -->

    <script>
        $(document).ready(function() {
            var table = $("#tabla_poa").DataTable({
                "lengthMenu": [
                    [5],
                    [5]
                ],
                "order": [
                    [0, 'desc']
                ],
                "responsive": true,
                "ajax": {
                    "url": "../clases/tabla_planificacion.php",
                    "type": "POST",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id_planificacion"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": "fecha"
                    },
                    {
                        "data": "anio"
                    },
                    {
                        "data": null,
                        defaultContent: '<center><button id="add_objetivos" class="btn btn-primary"><i class="fas fa-link"></i></button></center>'
                    },
                    {
                        "data": null,
                        defaultContent: '<center><button class="btn btn-success" id="detalles_poa" data-toggle="modal" data-target="#mostrar_poa_final"><i class="fas fa-eye"></i></button></center>'
                    },
                    {
                        "data": null,
                        defaultContent: '<center>' +
                            '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">' +
                            '<div class="btn-group mr-2" role="group" aria-label="First group">' +
                            '<button class="btn btn-danger" id="delete_plani"><i class="fas fa-trash-alt"></i></i></button>' +
                            '</div>' +
                            '<div class="btn-group mr-2" role="group" aria-label="Second group">' +
                            '<button class="btn btn-warning" id="edit_plani" data-toggle="modal" data-target=".poa_modal" data-placement="top" title="Editar"><i class="fas fa-edit"></i></button>' +
                            '</div>' +
                            '</div>' +
                            '</center>'
                    },
                ],
            });
            table.columns([0]).visible(false);

            $('#tabla_poa tbody').on('click', '#detalles_poa', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id_planificacion = fila.id_planificacion;
                console.log(id_planificacion);

                const form_detalles_poa = new FormData();
                form_detalles_poa.append('get_detalle_poa', 1);
                form_detalles_poa.append('id_planificacion', id_planificacion);

                fetch('../Controlador/action.php', {
                        method: 'POST',
                        body: form_detalles_poa
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                    })
            });

            $('#tabla_poa tbody').on('click', '#add_objetivos', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id_planificacion = fila.id_planificacion;
                //console.log(id_planificacion);
                window.localStorage.clear();
                localStorage.setItem('id_planifi', id_planificacion);

                const form_plani = new FormData();
                form_plani.append('datos_plani', 1);
                form_plani.append('id_plani', id_planificacion);
                fetch('../clases/tabla_objetivos.php', {
                        method: "POST",
                        body: form_plani
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                        localStorage.setItem('data', JSON.stringify(data));
                        window.location.href = "../vistas/objetivos_poa.php";
                    })

                //window.location.href = "../vistas/objetivos_poa.php";
            });

            $('#tabla_poa tbody').on('click', '#delete_plani', function() {
                var fila = table.row($(this).parents('tr')).data();
                var id_plani = fila.id_planificacion;
                console.log(id_plani);
                swal({
                    title: '¿Esta seguro de eliminar este plan?',
                    text: "¡No podrá ser revertido!",
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
                    const form_eliminar = new FormData();
                    form_eliminar.append('delete_plani', 1);
                    form_eliminar.append('id_plan', id_plani);

                    fetch('../Controlador/action.php', {
                            method: 'POST',
                            body: form_eliminar
                        })
                        .then(res => res.json())
                        .then(datos_eliminar => {
                            //console.log(datos_eliminar);
                            if (datos_eliminar == 'exito') {
                                $('#tabla_poa').DataTable().ajax.reload();
                                swal(
                                    'Eliminado!',
                                    'Su plan fue eliminado!',
                                    'success'
                                )
                            } else {
                                swal(
                                    'Opps!',
                                    'algo a salido mal!',
                                    'error'
                                )
                            }
                        });
                }, function(dismiss) {
                    // dismiss can be 'cancel', 'overlay',
                    // 'close', and 'timer'
                    if (dismiss === 'cancel') {
                        swal(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                        )
                    }
                })




            });

            $('#tabla_poa tbody').on('click', '#edit_plani', function() {
                var fila = table.row($(this).parents('tr')).data();
                var nombre = fila.nombre;
                var descripcion = fila.descripcion;
                var anio = fila.anio;
                var id_plan = fila.id_planificacion;
                document.getElementById('exampleModalLabel').innerHTML = "Editar Planificación";
                document.getElementById('n_planificacion').value = nombre;
                document.getElementById('datepicker').value = anio;
                document.getElementById('descripción').value = descripcion;
                document.getElementById('id_plani_edit').value = id_plan;

                document.getElementById('guardar_plani').style.display = 'none';
                if ($('#edit_plani').css('display') == 'none') {
                    document.getElementById('edit_plani').style.display = '';
                }

            });
        }); //!fin del document ready
    </script>

    <script>
        function cambiarNombre() {
            document.getElementById('exampleModalLabel').innerHTML = "Nueva Planificación";
            document.getElementById('poa_form').reset();
            document.getElementById('edit_plani').style.display = 'none';
            if ($('#guardar_plani').css('display') == 'none') {
                document.getElementById('guardar_plani').style.display = '';
            }
        }

        $("#datepicker, #datepicker1").datepicker({
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
        //este script srive para validar los campos del modal
        $("#nombre_proyecto, #descripción").keypress(function(key) {
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
        $(document).ready(function() {
            $('.tooltip-test').tooltip();
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