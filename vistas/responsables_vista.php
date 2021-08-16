<?php
ob_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

$Id_objeto = 133;


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
                           window.location = "../vistas/responsables_vista.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A RESPONSABLES POA.');

}

ob_end_flush();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../js/smart_wizard_arrows.css" rel="stylesheet">
</head>

<body>
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
                            <th scope="col">ID RESPONSANBLE</th>
                            <th scope="col">RESPONSANBLE</th>
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
                                    <label for="formGroupExampleInput">Example label</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Another label</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                                </div>
                                <div class="form-group d-flex">
                                    <div class="ml-auto p-2">
                                        <button class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
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
<script>
    $(document).ready(function() {
        var objeto = localStorage.getItem('datos_responsables');
        const data_responsables = JSON.parse(objeto);

        var table = $('#tabla_responsables').DataTable({
            data: data_responsables,
            columns: [{
                    data: 'id_responsables'
                },
                {
                    data: 'descripcion_responsable'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<center><button class="btn btn-danger">eliminar</button></center>';
                    }
                }
            ]
        });
    });
</script>

<script type="text/javascript">
    // SmartWizard initialize
    $('#smartwizard').smartWizard({
        theme: 'arrows',
        transitionEffect: 'fade',
        transitionSpeed: '400'
    });
</script>

</html>