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
                                <div class="form-group d-flex">
                                    <div class="ml-auto p-2">
                                        <button class="btn btn-primary" id="guardar_metas">Guardar</button>
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


<script type="text/javascript">
    // SmartWizard initialize
    $('#metas_smart').smartWizard({
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