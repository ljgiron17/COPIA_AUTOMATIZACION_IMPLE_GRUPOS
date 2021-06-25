<?php

ob_start();


session_start();

require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/funcion_visualizar.php');


$id_objeto=125;

$visualizacion= permiso_ver($id_objeto);

if ($visualizacion==0)
{
  echo '<script type="text/javascript">
                          swal({
                                title:"",
                                text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                type: "error",
                                showConfirmButton: false,
                                timer: 3000
                              });
                            window.location = "../vistas/mantenimiento_tipos_recursos_vista.php";

                            </script>';
}

else 

{

      bitacora::evento_bitacora($id_objeto, $_SESSION['id_usuario'], 'Ingresó' , 'a mantenimiento de tipos de resursos');


}




ob_end_flush();



?>