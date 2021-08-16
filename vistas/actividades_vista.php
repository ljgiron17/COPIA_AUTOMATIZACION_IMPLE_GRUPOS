<?php
ob_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

$Id_objeto = 115;


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
                           window.location = "../vistas/actividades_vista_poa.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A LAS ACTIVIDADES DEL POA.');


 
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
    <div id="vista_smart">
        <ul class="nav">
            <li>
                <a class="nav-link" href="#step-1">
                    Actividades
                </a>
            </li>
            <li>
                <a class="nav-link" href="#step-2">
                    Agregar Actividades
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="step-1" class="tab-pane" role="tabpanel">
                <table id="tabla_actividades" class="table table-sm table-dark table-striped needs-validation" cellpadding="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">ID ACTIVIDAD</th>
                            <th scope="col">ACTIVIDAD</th>
                            <th scope="col">ID VERIFICAÓN</th>
                            <th scope="col">MEDIO VERIFICACIÓN</th>
                            <th scope="col">POBLACION OBJETIVO</th>
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
                            <form id="agregar_actividades">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nombre Actividad</label>
                                    <input type="text" class="form-control" id="n_actividad" name="n_actividad" maxlength="200" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('n_actividad');" onkeypress="return sololetras(event)" placeholder="Actividad" required>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Medios de verificacion</label>
                                    <input type="text" class="form-control" id="m_verificacion" name="m_verificacion" maxlength="255" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('m_verificacion');" onkeypress="return sololetras(event)" placeholder="Verificación" required>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput3">Población objetivo</label>
                                    <input type="text" class="form-control" id="p_objetivo" name="p_objetivo" maxlength="255" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('p_objetivo');" onkeypress="return sololetras(event)" placeholder="Población" required>
                                </div>
                                <div class="form-group d-flex">
                                    <div class="ml-auto p-2">
                                        <button class="btn btn-primary" id="guardar_actividad">Guardar</button>
                                    </div>                                    
                                </div>
                                <div id="mensaje_actividades"></div>
                            </form>
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
    $('#vista_smart').smartWizard({
        theme: 'arrows',
        transitionEffect: 'fade',
        transitionSpeed: '400',
        lang: { // Language variables for button
                next: 'Siguiente',
                previous: 'Anterior'
            }
    });
    

    // function call_wizard2() {
    //     $('#vista_smart').smartWizard("reset");
    // }
</script>

</html>