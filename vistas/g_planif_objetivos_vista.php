<html>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="tabla2" class="table table-bordered table-striped" cellpadding="0" width="100%">
                <thead>
                  <tr>
                    <th>DESCRIPCIÓN</th>
                    <th >ACCIÓN</th>
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

  <script type="text/javascript">
  

    $(function () {
   
      $('#tabla2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });


  </script> 
  
</html>