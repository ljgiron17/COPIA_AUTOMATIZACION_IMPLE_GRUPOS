<?php 
session_start();
require_once ('../clases/Conexion.php');
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/funcion_bitacora.php');
  require_once ('../clases/funcion_visualizar.php');

  if (permiso_ver('114')=='1')
  {
   
   $_SESSION['g_cargaacademica_vista']="...";
 }
 else
 {
 $_SESSION['g_cargaacademica_vista']="No 
   tiene permisos para visualizar";
 
 }


        $Id_objeto=114 ; 

        $visualizacion= permiso_ver($Id_objeto);



if ($visualizacion==0)
 {
   header('location:  ../vistas/pagina_principal_vista.php'); 
}

else

{
        bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'Ingreso' , 'A Bitacora del sistema');

      }


if (isset($_REQUEST['msj'])) 
{
	$msj=$_REQUEST['msj'];

		if ($msj==1)
		  {
		           echo '<script> alert("Fecha invalidas favor verificar.")</script>';

		  }

      if ($msj==2)
      {
               echo '<script> alert("Datos por rellenar, por favor verificar.")</script>';

      }
       if ($msj==3)
      {
               echo '<script> alert("Por favor verificar fechas.")</script>';

      }

}

 ?>


 <!DOCTYPE html>
<html>
<head>
  <title></title>
</head>


<body >


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">


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
      
<form action="../Controlador/filtrar_bitacora_controlador.php" method="post"  data-form="save" autocomplete="off" >

 <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Datos</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>


          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
                     
                           
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Fecha Inicio</label>
                    <input class="form-control" type="date" id="txt_fecha_inicio" name="txt_fecha_inicio"  >
                </div>


              </div>
                <div class="col-sm-6">
                 <div class="form-group">
                  <label>Fecha Final</label>
                    <input class="form-control" type="date" id="txt_fecha_final" name="txt_fecha_final"  >
                </div>


                </select>
                </div>

              <p class="text-center" style="margin-top: 10px;">
                <button type="submit" class="btn btn-primary sm" id="btn_filtrar_cargas" ></i> Filtrar</button>
              </p>
         
</form>

  </div>
</section>
<!--Pantalla 2-->
 <div class="card card-default">
           
            
            <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title">Registros de Cargas Académicas</h3>
						<a href="#" class="btn btn-success btn-m">Nueva Gestión de Carga</a>
					</div>
           
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabla" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>PERIODO</th>
                  <th>DESCRIPCIÓN</th>
                  <th>FECHA</th>
                  <th>ACCIONES</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                   <td>
                    <td>
                     <td>
                      <td> <div class="btn-group"> <button class="ver btn btn-primary btn - m">
                      <i class="fas fa-eye"></i>
                      </button>
                    <button class = "editar btn btn-success btn-m">
                    <i class="fas fa-edit"></i>
                    </button>
                      <div>
                      
             </tbody>
            </table>
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




<script type="text/javascript">
  

 $(function () {
   
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


</script>
</body>
</html>