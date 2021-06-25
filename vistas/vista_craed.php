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
    <div class="row justify-content-center">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabla_craed" class="table table-bordered table-hover table-dark" cellpadding="0" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">PERIODO</th>
                                    <th scope="col">DESCRIPCIÓN</th>
                                    <th scope="col">ARCHIVO</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">ACCIÓN</th>
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
          [3],
          [3]
        ],
        "order": [
          [0, 'desc']
        ],
        "responsive": true,
        "ajax": {
          "url": "../clases/tabla_craed.php",
          "type": "POST",
          "dataSrc": ""
        },
        "columns": [{
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
            "data": null,
            defaultContent: '<center><div class="btn-group"> <button class="ver btn btn-primary btn - m"><i class="fas fa-eye"></i></button><button class="editar btn btn-success btn - m"><i class="fas fa-file-download"></i></button><div></center>'
          },
          // { "data": "ip" },
          // { "data": "cambio" },                                                    
        ],
      });
    });
  </script>