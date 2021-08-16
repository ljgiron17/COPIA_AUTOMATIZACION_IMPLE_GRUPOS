<?php

ob_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

$Id_objeto = 113;


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
                                    <input type="text" class="form-control" id="primer_trimestre" name="primer_trimestre" maxlength="3" value="" onkeyup="DobleEspacio(this, event);  MismaLetra('ind_indicador');" onkeypress="return solonumeros(event)" placeholder="Primero">
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

    function solonumeros(e){
        
        key=e.keyCode || e.wich;
    
        teclado= String.fromCharCode(key).toUpperCase();
    
        letras= "1234567890";
        
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

  
</script>
</html>