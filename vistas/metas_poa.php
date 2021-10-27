<?php

ob_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

$Id_objeto = 244;


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
                           window.location = "../vistas/metas_poa.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A LAS METAS DEL POA.');


 
}

ob_end_flush();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../js/smart_wizard_dots.css" rel="stylesheet">
</head>

<body>
    <div id="metas_smart">
        <ul class="nav">
            <li>
                <a class="nav-link" href="#step-1">
                    Metas
                </a>
            </li>
            <li>
                <a class="nav-link" href="#step-2">
                    Agregar Metas
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="step-1" class="tab-pane" role="tabpanel">
                <table id="tabla_metas" class="table table-sm table-dark table-striped needs-validation" cellpadding="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">ID METAS</th>
                            <th scope="col">1er TRIMESTRE</th>
                            <th scope="col">2do TRIMESTRE</th>
                            <th scope="col">3er TRIMESTRE</th>
                            <th scope="col">4to TRIMESTRE</th>
                            <th scope="col">EDITAR</th>
                            <th scope="col">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div id="step-2" class="tab-pane" role="tabpanel">
                <div class="card card-default">
                    <!--inciio primer card -->
                    <div class="card-header" style="background-color: #ced2d7;">
                        <h3 class="card-title"><strong>AGREGAR ACTIVIDADES</strong> </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="container">
                            <form id="agregar_metas">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Primer Trimestre</label>
                                    <input type="text" class="form-control" id="primer_trimestre" name="primer_trimestre" maxlength="3" placeholder="Primero">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Segundo Trimestre</label>
                                    <input type="text" class="form-control" id="segundo_trimestre" name="segundo_trimestre" maxlength="3" placeholder="Segundo">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput3">Tercer Trimestre</label>
                                    <input type="text" class="form-control" id="tercer_trimestre" name="tercer_trimestre" maxlength="3" placeholder="Tercero">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput3">Cuarto Trimestre</label>
                                    <input type="text" class="form-control" id="cuarto_trimestre" name="cuarto_trimestre" maxlength="3" placeholder="Cuarto">
                                </div>
                                <div id="mensaje_meta">

                                </div>
                            </form>
                            <div class="form-group d-flex">
                                <div class="ml-auto p-2" id="edicion_metas" hidden>
                                    <button class="btn sw-btn-prev btn btn-danger" id="finalizar_edicion">Finalizar Edición</button>
                                    <button class="btn btn-warning" id="guardar_metas_edicion">Guardar Edición</button>
                                </div>
                                <div class="ml-auto p-2" id="creacion_metas">
                                    <button class="btn sw-btn-prev btn btn-danger">Finalizar</button>
                                    <button class="btn btn-primary" id="guardar_metas">Guardar</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>


<script type="text/javascript">
    // SmartWizard initialize
    $('#metas_smart').smartWizard({
        theme: 'arrows',
        transitionEffect: 'fade',
        transitionSpeed: '400',
        lang: { // Language variables for button
            next: 'SIGUIENTE',
            previous: 'ANTERIOR'
        }
    });
    // function call_wizard2() {
    //     $('#vista_smart').smartWizard("reset");
    // }   
    table.columns([0]).visible(false);

    $('#tabla_metas tbody').on('click', '#editar_metas', function() {
        table.columns([0]).visible(false);
        
        var fila = $(this).closest('tr');
        var id_meta_editar = fila.find('td:eq(0)').text();
        var primer_trimestre = fila.find('td:eq(1)').text();
        var segundo_trimestre = fila.find('td:eq(2)').text();
        var tercer_trimestre = fila.find('td:eq(3)').text();
        var cuarto_trimestre = fila.find('td:eq(4)').text();

        document.getElementById('primer_trimestre').value = primer_trimestre;
        document.getElementById('segundo_trimestre').value = segundo_trimestre;
        document.getElementById('tercer_trimestre').value = tercer_trimestre;
        document.getElementById('cuarto_trimestre').value = cuarto_trimestre;


        localStorage.removeItem('id_meta_editar');
        localStorage.setItem('id_meta_editar', id_meta_editar);
        console.log(id_meta_editar);
        $(".sw-btn-next").trigger("click");
        $("#edicion_metas").attr("hidden", false);
        $("#creacion_metas").attr("hidden", true);
    });

    $('#finalizar_edicion').click(function() {
        document.getElementById('agregar_metas').reset();
        $("#edicion_metas").attr("hidden", true);
        $("#creacion_metas").attr("hidden", false);
    });

    const guardar_metas_edicion = document.getElementById('guardar_metas_edicion'); //boton guardar metas
    const form_metas = document.getElementById('agregar_metas');

    guardar_metas_edicion.addEventListener('click', function(e) {
        e.preventDefault();
        //alert('hola');
        const new_form = new FormData(form_metas);
        new_form.append('editar_meta', 1);
        new_form.append('id_metas', localStorage.getItem('id_meta_editar'));
        fetch('../Controlador/action.php', {
                method: 'POST',
                body: new_form
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data == 'exito') {
                    console.log(data);
                    $("#mensaje_meta").html(showMEssage('success', '¡Metas han sido agregadas!'));
                    $("#mensaje_meta").fadeTo(2000, 500).slideUp(500, function() {
                        $("#mensaje_meta").slideUp(500);
                    });
                    $('#tabla_metas tbody').empty();
                    update_metas();
                    document.getElementById('agregar_metas').reset();

                } else if (data == 'cuenta_mayor') {
                    $("#mensaje_meta").html(showMEssage('danger', '¡Cantidades ingresadas suman mas de 100%, verifique los campos!'));
                    $("#mensaje_meta").fadeTo(2000, 500).slideUp(500, function() {
                        $("#mensaje_meta").slideUp(500);
                    });
                } else if (data == 'menor_cuenta') {
                    $("#mensaje_meta").html(showMEssage('danger', '¡Sus porcentaje de metas no suma el 100%!'));
                    $("#mensaje_meta").fadeTo(2000, 500).slideUp(500, function() {
                        $("#mensaje_meta").slideUp(500);
                    });
                }
            })
    })
</script>

</html>