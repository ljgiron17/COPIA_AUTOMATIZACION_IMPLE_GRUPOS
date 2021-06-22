<?php 
session_start();
require_once ('../clases/Conexion.php');
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/funcion_bitacora.php');
  require_once ('../clases/funcion_visualizar.php');

  if (permiso_ver('115')=='1')
  {
   
   $_SESSION['g_cargararchivosdecargaacademica_vista']="...";
 }
 else
 {
 $_SESSION['g_cargararchivosdecargaacademica_vista']="No 
   tiene permisos para visualizar";
 
 }


        $Id_objeto=115 ; 

        $visualizacion= permiso_ver($Id_objeto);

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

    <div class="card card-default">
          <div class="card-header">
            <h3> Cargar archivo de carga academica</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabla" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ARCHIVO</th>
                  <th>CARGAR</th>
                  <th>VALIDAR ARCHIVO</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                   <td>CARGA DE COORDINACIÓN ACADÉMICA </td>
                   <td>
                      <div class=" px-6">
                      <button class="btn btn-success " id="cargar"> <i class="fas fa-file-upload"></i></button>
                   
                      </div>
                    </td>
                    <td>
                      <div class=" px-6">
                        <button class="btn btn-primary " id="Validar"> Validar </button>
                   
                      </div>
                    </td>
                 </tr>
                 </tbody>
                 <tbody>
                <tr>
                   <td>CARGA DE CRAED </td>
                   <td>
                      <div class=" px-6">
                      <button class="btn btn-success " id="cargar"> <i class="fas fa-file-upload"></i></button>
                   
                      </div>
                    </td>
                    <td>
                      <div class=" px-6">
                        <button class="btn btn-primary " id="Validar"> Validar </button>
                   
                      </div>
                    </td>
                 </tr>
                 </tbody>
              </table>
              <br>
              
              <div class="px-12 float-sm-right">
                <a href="../vistas/g_guardarreportedecarga_vista.php" class="btn btn-secondary"><i class="zmdi zmdi-floppy"></i>Siguiente</a>
              </div>
              <div class=" px-12 text-center">
              <A style="vertical-align: inherit;" class="fas fa-download" HREF="otra_pagina.html"> Descargar formato de "carga de coordinacion academica"   </A> 
              </div>
              <div class=" px-12 text-center">
              <A style="vertical-align: inherit;" class="fas fa-download" HREF="otra_pagina.html"> Descargar formato de "carga CRAED"   </A> 
              </div>

              
            </div> <!-- /.card-bodyr -->
          </div> <!-- /.container-fluid -->



      </div>
      <div class="RespuestaAjax"></div>
  </div>
</body>
</html>
                    
                    
                      
                      
                     

              
                     




           



