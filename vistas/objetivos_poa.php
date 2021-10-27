<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

$Id_objeto = 240;
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
                           window.location = "../vistas/objetivos_poa.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'OBJETIVOS POA.');


 
}

ob_end_flush();

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
                        <!-- Modal -->
                        <div class="modal fade obj_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="obj_form">
                                            <div class="container">
                                                <label for="">Nombre objetivo</label>
                                                <input type="text" id="n_objetivo" name="n_objetivo" class="form-control" maxlength="100" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('n_objetivo');" onkeypress="return sololetras(event)" required>
                                                <label for="">Descripción</label>
                                                <textarea class="form-control" id="obj_descripción" name="obj_descripción" rows="3" maxlength="255" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('obj_descripción');" onkeypress="return sololetras(event)" required></textarea>
                                                <input type="text" id="id_objetivo" name="id_objetivo_edit" hidden>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button class="btn btn-warning" id="edicion_obj">Guardar Edición</button>
                                        <button type="button" class="btn btn-primary" id="guardar_objetivo">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin del modal-->
                        <h1>Gestión de Objetivos</h1>
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

        <section class="content">
            <div class="container-fluid">

            </div>
        </section>
        <!--Pantalla 2-->
        <div class="card card-default">
            <div class="card-body  ">
                <div class="row">
                    <div class="col-9">
                        <h3 class="card-title">Registro de objetivos</h3>
                    </div>
                    <div class="col-3">
                        <!-- <button class="btn btn-warning" onclick="clearData();">Limpiar data</button>
                        <button class="btn btn-primary" onclick="updateTable();">Cargar data</button> -->
                        <a href="#" class="btn btn-success btn-m" id="new_objetivo" data-toggle="modal" data-target=".obj_modal" onclick="limpiarForm(); cambiarNombre();">Nuevo Objetivo</a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item"><a class="page-link" href="../vistas/poa_vista.php">Planificaciones</a></li>
            <li class="page-item active">
                <span class="page-link">
                    Objetivos
                    <span class="sr-only">(current)</span>
                </span>
            </li>
            <li class="page-item"><label class="page-link">Indicadores</label></li>
        </ul>
        <div class=" card-body">
            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            <strong>Objetivos</strong>
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
                                            <table id="tabla_objetivos" class="table table-sm table-dark table-striped needs-validation" cellpadding="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID OBJETIVO</th>
                                                        <th scope="col">NOMBRE OBJETIVO</th>
                                                        <th scope="col">DESCRIPCIÓN</th>
                                                        <th scope="col">FECHA</th>
                                                        <th scope="col">ID PLANIFICACIÓN</th>
                                                        <th scope="col">ELIMINAR</th>
                                                        <th scope="col">EDITAR</th>
                                                        <th scope="col">CREAR INDICADORES</th>
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
    <script src="../js/gestion_objetivos.js"></script>

    <script>
        var retrievedObject = localStorage.getItem('data');
        const data = JSON.parse(retrievedObject);

        var table = $('#tabla_objetivos').DataTable({
            data: data,
            columns: [{
                    data: 'id_objetivo'
                },
                {
                    data: 'nombre_objetivo'
                },
                {
                    data: 'descripcion'
                },
                {
                    data: 'fecha'
                },
                {
                    data: 'id_planificacion'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<center><button class="btn btn-danger" id="delete_obj"><i class="fas fa-times-circle"></i></button></center>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<center><button class="btn btn-warning" id="edit_objetivo" data-toggle="modal" data-target=".obj_modal" data-placement="top" title="Editar"><i class="fas fa-edit"></i></button></center>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<center><button class="btn btn-primary" id="get_ID"><i class="fas fa-arrow-right"></i></button></center>';
                    }
                }
            ]
        });
        table.columns([0]).visible(false);
        table.columns([4]).visible(false); //oculta la fila

        //!edicion de un objetivo
        $('#tabla_objetivos tbody').on('click', '#edit_objetivo', function() {
            var fila = table.row($(this).parents('tr')).data();
            var id_obj_edit = fila.id_objetivo;
            var nombre_objetivo = fila.nombre_objetivo;
            var descripcion = fila.descripcion;
            console.log(id_obj_edit);

            document.getElementById('n_objetivo').value = nombre_objetivo;
            document.getElementById('obj_descripción').value = descripcion;
            document.getElementById('id_objetivo').value = id_obj_edit;

            document.getElementById('exampleModalLabel').innerHTML = "Editar Objetivo";
            
            document.getElementById('guardar_objetivo').style.display = 'none';
            if ($('#edicion_obj').css('display') == 'none') {
                document.getElementById('edicion_obj').style.display = '';
            }
        });
        //! fin edicion de una objetivo

        $('#tabla_objetivos tbody').on('click', '#get_ID', function() {
            var fila = table.row($(this).parents('tr')).data();
            var id_obj_send = fila.id_objetivo;
            console.log(id_obj_send);
            //window.location.href = "../vistas/indicadores_poa.php";
            const form_indicadores_get = new FormData();
            form_indicadores_get.append('get_data_indicador', 1);
            form_indicadores_get.append('id_obj_send', id_obj_send)
            fetch('../clases/tabla_indicadores.php', {
                    method: 'POST',
                    body: form_indicadores_get
                })
                .then(res => res.json())
                .then(datos => {
                    console.log(datos);
                    localStorage.setItem('id_objetivo_send', id_obj_send);
                    localStorage.setItem('datos', JSON.stringify(datos));
                    window.location.href = "../vistas/indicadores_poa.php";
                })
            // localStorage.setItem('id_objetivo', id_obj_snd);            
        });

        $('#tabla_objetivos tbody').on('click', '#delete_obj', function() {
            //LECTURA DEL EVENTO PARA ELIMINAR UN REGISTRO
            var fila = table.row($(this).parents('tr')).data();
            var id_delete = fila.id_objetivo;
            var id_planificacion = fila.id_planificacion;
            localStorage.removeItem('id_planificacion');
            localStorage.setItem('id_planificacion', id_planificacion);
            
            delete_Obj(id_delete);
        });

        function delete_Obj(id_delete) {
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
                const form_delete_obj = new FormData();
                form_delete_obj.append('obj_delete', 1);
                form_delete_obj.append('id_delete', id_delete)
                fetch('../Controlador/action.php', {
                        method: "POST",
                        body: form_delete_obj
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                        if (data == 'exito') {
                            actualizardataTable_Obj();
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

        function actualizardataTable_Obj() {
            const form_update = new FormData();
            form_update.append('datos_plani', 1);
            form_update.append('id_plani', localStorage.getItem('id_planificacion'));

            fetch('../clases/tabla_objetivos.php', {
                    method: 'POST',
                    body: form_update
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data.length == 0) {
                        console.log('sin datos');
                        var table = $('#tabla_objetivos').DataTable();
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
                        localStorage.removeItem('data');
                        localStorage.setItem('data', JSON.stringify(data));
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
            var retrievedObject = localStorage.getItem('data');
            const data = JSON.parse(retrievedObject);
            $('#tabla_objetivos').dataTable().fnClearTable();
            $('#tabla_objetivos').dataTable().fnAddData(data);
        }
    </script>

    <script>
        function limpiarForm() {
            document.getElementById('obj_form').reset();
        }

        function cambiarNombre() {
            document.getElementById('exampleModalLabel').innerHTML = "Nuevo Objetivo";
            document.getElementById('obj_form').reset();
            document.getElementById('edicion_obj').style.display = 'none';
            if ($('#guardar_objetivo').css('display') == 'none') {
                document.getElementById('guardar_objetivo').style.display = '';
            }
        }

        $("#datepicker, #datepicker1").datepicker({
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
        //este script srive para validar los campos del modal
        $("#n_objetivo, #obj_descripción").keypress(function(key) {
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