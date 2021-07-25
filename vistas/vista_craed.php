<style>
  table,
  tbody {
    text-align: center;
  }

  .modal-header.edit {
    background-color: #ff5733;
  }

  .modal-header.create {
    background-color: #aed2ef;
  }
</style>
<html>

<div class="container-fluid">
  <!-- inicio del modal2 -->
  <div id="modal" class="modal fade bd-example-modal-lg archivos_craed" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Archivo de CRAED</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="table-wrapper-scroll-y my-custom-scrollbar" id="cargar_excel_cr">

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Generar WORD</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- fin del modal2 -->

  <div class="row justify-content-center">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="tabla_craed" class="table table-bordered table-striped table-dark" cellpadding="0" width="100%">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID ARCHIVO</th>
                  <th scope="col">PERIODO</th>
                  <th scope="col">DESCRIPCIÓN</th>
                  <th scope="col">ARCHIVO</th>
                  <th scope="col">AÑO PERIODO</th>
                  <th scope="col">FECHA SUBIDA</th>
                  <th scope="col">ACCIÓN</th>
                  <th scope="col">SUBIR</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</html>

<script type="text/javascript">
  $(document).ready(function() {
    var table = $("#tabla_craed").DataTable({
      "lengthMenu": [
        [5],
        [5]
      ],
      "order": [
        [0, 'desc']
      ],
      "responsive": true,
      "language": {
            "lengthMenu": "Mostrar _MENU_ Registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando la pagina de _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de _MAX_ Registros Totales)",
            "search": "Buscar:",
            "pagingType": "full_numbers",
            "oPaginate": {
              "sNext":"Siguiente",
              "sPrevious": "Anterior"
            },
          },
      "ajax": {
        "url": "../clases/tabla_craed.php",
        "type": "POST",
        "dataSrc": ""
      },
      "columns": [{
          "data": "id_craed_jefa"
          },
        {
          "data": "periodo_cr"
        },
        {
          "data": "descripcion_cr"
        },
        {
          "data": "nombre_archivo_cr"
        },
        {
          "data": "fecha_cr"
        },
        {
          "data": "fecha_subida"
        },
        {
          "data": null,
          defaultContent: '<center><div class="btn-group"> <button id="ver_archivo_craed" class="ver btn btn-primary btn - m" data-toggle="modal" data-target=".archivos_craed"><i class="fas fa-eye"></i></button><button id="descarga_cr" class=" btn btn-success btn - m"><i class="fas fa-file-download"></i></button><div></center>'
        },
        {
            "data": null,
            defaultContent: '<button id="upload1" class="btn btn-warning"><i class="fas fa-upload"></i></button>'
          },

        // { "data": "ip" },
        // { "data": "cambio" },                                                    
      ],
    });

    $('#tabla_craed tbody').on('click', '#ver_archivo_craed', function() {
      var fila = table.row($(this).parents('tr')).data();
      var nombre_archivo_cr = fila.nombre_archivo_cr;
      console.log(nombre_archivo_cr);
      //comienza ajax
      var ver_excel_cr = "ver_excel_cr";

      $.ajax({
        url: "../Controlador/action.php",
        type: "POST",
        dataType: "html",
        data: {
          nombre_archivo_cr: nombre_archivo_cr,
          ver_excel_cr: ver_excel_cr
        },
        success: function(r) {
         // console.log(r);
          //document.getElementById('cargar_excel').innerHTML = r;
          $('#cargar_excel_cr').html(r);
        } //FIN SUCCES
      });
      //FIN  AJAX
    });

    $('#tabla_craed tbody').on('click', '#descarga_cr', function() {
      var fila = table.row($(this).parents('tr')).data();
      var nombre_archivo_cr = fila.nombre_archivo_cr;
      console.log(nombre_archivo_cr);

      var url = `../archivos/file_craed/${nombre_archivo_cr}`;
      download(url);

    });

    $('#tabla_craed tbody').on('click','#upload1', function() {
        var fila = table.row($(this).parents('tr')).data();
        var nombre_archivo_cr = fila.nombre_archivo_cr;
        var id_archivo_cr = fila.id_craed_jefa;

        console.log(nombre_archivo_cr, id_archivo_cr);

        const formulario = new FormData();
        formulario.append('subir_excel_cr', 1);
        formulario.append('nombre_archivo_cr', nombre_archivo_cr);
        formulario.append('id_archivo_cr', id_archivo_cr);

        fetch('../Controlador/action.php', {
            method: 'POST',
            body: formulario
          })
          .then(res => res.json())
          .then(data => {
            console.log(data);
            if (data == 'exito') {
              swal(
                'Exito!',
                '¡Datos subidos correctamente!',
                'success'
              ) 
            } else if (data == "archivo_subidoCR") {
              swal(
                'Existe!',
                '¡Archivo ya existe en la base de datos!',
                'warning'
              )
            }
          });
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