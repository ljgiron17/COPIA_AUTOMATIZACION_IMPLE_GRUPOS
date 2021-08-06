<?php
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');

$Id_objeto = 114;
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
                           window.location = "../vistas/g_carga_cargaacademica_vista.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A GESTIÓN DE CARGA ACADÉMICA DE JEFATURA.');


    // if (permisos::permiso_insertar($Id_objeto) == '1') {
    //   $_SESSION['btn_guardar_registro_docentes'] = "";
    // } else {
    //   $_SESSION['btn_guardar_registro_docentes'] = "disabled";
    // }
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
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> -->
  <!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script> -->

  <!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> -->


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
</head>

<body>
  <!-- modal de presentacion de word -->
  <!-- Modal -->
  <div class="modal fade" id="modal_final" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="datos_form_ca" method="get">
            <label for="">Nombre del MASTER</label>
            <input type="text" class="form-control" id="master_n" name="master_n" required onkeyup="mayusculas(this)">
            <label for="">N° de Oficio</label>
            <input type="text" class="form-control" id="numero_fi" name="numero_ofi" required onkeyup="mayusculas(this);">
            <input type="text" id="numero_archivo" hidden readonly>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="enviar_reporte_word">Enviar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- fin modal de presentacion de word -->




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
                    <h5 class="modal-title">Carga de archivos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="archivos_send" class="needs-validation">
                      <!-- inicio del form -->

                      <div class="card card-default">
                        <!--inciio primer card -->
                        <div class="card-header" style="background-color: #ced2d7;">
                          <h3 class="card-title"><strong>CARGA DE COORDINACIÓN ACADÉMICA</strong> </h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12">
                              <label for="">Seleccione el archivo Coordinación Académica:</label><br>
                              <input type="file" name="file_ca" id="file_ca" class="form-control" required>
                            </div>
                            <center>
                              <div id="message_alert"></div>
                            </center>
                          </div>
                          <br>
                          <div class="container">
                            <div class="row">
                              <div class="col-sm">
                                <label for="">PERIODO</label><br>
                                <select name="periodo_ca" id="periodo_ca" class="form-control">
                                  <option value="PERIODO I">PERIODO I</option>
                                  <option value="PERIODO II">PERIODO II</option>
                                  <option value="PERIODO III">PERIODO III</option>
                                </select>
                                <!-- <input type="text" class="form-control" name="periodo_ca" id="periodo_ca" required> -->
                              </div>
                              <div class="col-sm">
                                <label for="">DESCRIPCIÓN</label><br>
                                <input type="text" class="form-control" name="descrp_ca" id="descrp_ca" required onkeyup="mayusculas(this);">
                              </div>
                              <div class="col-sm">
                                <label for="">AÑO PERIODO</label><br>
                                <input type="text" id="datepicker" name="txt_fecha_ingreso_ca" onkeydown="return false" class="form-control" placeholder="AÑO PERIODO" required>
                                <!-- <input class="form-control" type="date" id="txt_fecha_ingreso_ca" name="txt_fecha_ingreso_ca" onkeydown="return false" max="2021-06-22" min="1970-01-01" required> -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- fin primer card -->


                      <div class="card card-default">
                        <div class="card-header" style="background-color: #ced2d7;">
                          <h3 class="card-title"><strong>CARGA DE CRAED</strong> </h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12">
                              <label for="">Seleccione el archivo CRAED:</label><br>
                              <input type="file" name="file_cr" id="file_cr" class="form-control" required>
                            </div>
                            <center>
                              <div id="message_alert2"></div>
                            </center>
                          </div>
                          <br>
                          <div class="container">
                            <div class="row">
                              <div class="col-sm">

                                <label for="">PERIODO</label><br>
                                <select name="periodo_cr" id="periodo_cr" class="form-control">
                                  <option value="PERIODO I">PERIODO I</option>
                                  <option value="PERIODO II">PERIODO II</option>
                                  <option value="PERIODO III">PERIODO III</option>
                                </select>
                                <!-- <input type="text" class="form-control" name="periodo_cr" id="periodo_cr" required> -->
                              </div>
                              <div class="col-sm">
                                <label for="">DESCRIPCIÓN</label><br>
                                <input type="text" class="form-control" name="descrip_cr" id="descrip_cr" required>
                              </div>
                              <div class="col-sm">
                                <label for="">AÑO PERIODO</label><br>
                                <input type="text" id="datepicker1" name="txt_fecha_ingreso_cr" onkeydown="return false" class="form-control" placeholder="AÑO PERIODO" required>
                                <!-- <input class="form-control" type="date" id="datepicker" name="txt_fecha_ingreso_cr" required="" onkeydown="return false" max="2021-06-22" min="1970-01-01" required> -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form> <!-- fin del form -->

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="enviar_archivos">Enviar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- fin del modal -->

            <!-- inicio del modal2 -->
            <div id="modal" class="modal fade bd-example-modal-lg archivosAcademica" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Archivo de Académica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <div class="table-wrapper-scroll-y my-custom-scrollbar" id="cargar_excel">

                    </div>

                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-primary">Generar WORD</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- fin del modal2 -->


            <h1>Gestión de Carga Académica</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/g_cargajefatura_vista.php">Jefatura</a></li>
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
            <h3 class="card-title">Registro de Cargas Académicas</h3>
          </div>
          <div class="col-3">
            <a href="#" class="btn btn-success btn-m" data-toggle="modal" data-target=".bd-example-modal-lg">Nueva Gestión de Carga</a>
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
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Académica</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab" aria-controls="movimientos" aria-selected="false">CRAED</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row justify-content-center">
              <div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="tabla_academica" class="table table-bordered table-striped" cellpadding="0" width="100%">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">PERIODO</th>
                            <th scope="col">DESCRIPCIÓN</th>
                            <th scope="col">ARCHIVO</th>
                            <th scope="col">AÑO PERIODO</th>
                            <th scope="col">FECHA SUBIDA</th>
                            <th scope="col">ACCIÓN</th>
                            <th scope="col">Generar WORD</th>
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
          <div class="tab-pane fade" id="movimientos" role="tabpanel" aria-labelledby="profile-tab">
            <?php
            require 'vista_craed.php';
            ?>
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
      var table = $("#tabla_academica").DataTable({
        "lengthMenu": [
          [5],
          [5]
        ],
        "order": [
          [0, 'desc']
        ],
        "responsive": true,
        dom: 'Bfrtip',
        "buttons": [{
            extend: 'copyHtml5',
            title: 'Datos Exportados',
            text: 'Copiar <i class="fas fa-copy"></i>',
            messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            exportOptions: {
              columns: [0, ':visible']
            }
          },
          {
            extend: 'excelHtml5',
            title: 'Datos Exportados',
            text: 'Excel <i class="fas fa-file-excel"></i>',
            messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            exportOptions: {
              columns: ':visible'
            }
          },
          {
            extend: 'pdfHtml5',
            title: 'Datos Exportados',
            text: 'PDF <i class="fas fa-file-pdf"></i>',
            messageTop: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            messageBottom: 'La información contenida en este documento pertenece a, UNAH 2021-2022',
            exportOptions: {
              columns: [0, 1, 2, 3]
            }
          },
          //'colvis'
        ],
        "ajax": {
          "url": "../clases/tabla_academica.php",
          "type": "POST",
          "dataSrc": ""
        },
        "columns": [{
            "data": "id_coordAcademica",
            "visible": false,
          },
          {
            "data": "periodo"
          },
          {
            "data": "descripcion"
          },
          {
            "data": "nombre_archivo"
          },
          {
            "data": "fecha"
          },
          {
            "data": "fecha_subida"
          },
          {
            "data": null,
            defaultContent: '<center><div class="btn-group"> <button id="ver_detail" class="ver btn btn-primary btn - m" data-toggle="modal" data-target=".archivosAcademica"><i class="fas fa-eye"></i></button><button id="descarga" class=" btn btn-success btn - m"><i class="fas fa-file-download"></i></button><div></center>'
          },
          {
            "data": null,
            defaultContent: '<center><button class="btn btn-primary" id="generar_word" data-toggle="modal" data-target="#modal_final">Generar WORD</button></center>'
          }
        ],
      });
      //table(0).columns['hidden'];

      //!modificaciones 2/08/2021
      $('#tabla_academica tbody').on('click', '#generar_word', function() {
        var fila = table.row($(this).parents('tr')).data();
        var id_archivo = fila.id_coordAcademica;
        console.log(id_archivo);
        document.getElementById('numero_archivo').value = id_archivo;
        //window.location.href = '../Reporte/reporte_word.php?enviar=enviar&id_archivo='+id_archivo+'';
      });


      const button_sendW = document.getElementById('enviar_reporte_word');
      button_sendW.addEventListener('click', function(e) {
        e.preventDefault();
        var master = document.getElementById("master_n").value;
        var numero_ofi = document.getElementById("numero_fi").value;
        var id_archivo = document.getElementById("numero_archivo").value;
        window.location.href = '../Reporte/reporte_word.php?enviar=enviar&id_archivo=' + id_archivo + '&master=' + master + '&numero_ofi=' + numero_ofi + '';
        document.getElementById('datos_form_ca').reset();
        $('#modal_final').modal('toggle');
      });

      //!modificaciones 2/08/2021

      $('#tabla_academica tbody').on('click', '#ver_detail', function() {
        var fila = table.row($(this).parents('tr')).data();
        var nombre_archivo = fila.nombre_archivo;
        console.log(nombre_archivo);
        //comienza ajax
        var ver_excel_ca = "ver_excel_ca";
        $.ajax({
          url: "../Controlador/action.php",
          type: "POST",
          dataType: "html",
          data: {
            nombre_archivo: nombre_archivo,
            ver_excel_ca: ver_excel_ca
          },
          success: function(r) {
            //console.log(r); 
            //document.getElementById('cargar_excel').innerHTML = r;
            $('#cargar_excel').html(r);
          } //FIN SUCCES
        });
        //FIN  AJAX
      });

      $('#tabla_academica tbody').on('click', '#descarga', function() {
        var fila = table.row($(this).parents('tr')).data();
        var nombre_archivo = fila.nombre_archivo;
        console.log(nombre_archivo);

        var url = `../archivos/file_academica/${nombre_archivo}`;
        download(url);

      });
    });

    function download(url) {
      var link = document.createElement("a");
      $(link).click(function(e) {
        e.preventDefault();
        window.location.href = url;
      });
      $(link).click();
    }
  </script>

  <script>
    $("#datepicker, #datepicker1").datepicker({
      format: "yyyy", // Notice the Extra space at the beginning
      viewMode: "years",
      minViewMode: "years",
      yearRange: "2021:2100"
    });
  </script>
</body>

</html>


<script>
  function mayusculas(e) {
    e.value = e.value.toUpperCase();
  }
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