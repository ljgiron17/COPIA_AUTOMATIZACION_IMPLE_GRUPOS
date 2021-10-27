<?php

require_once('../clases/Conexion.php');





if (session_status() === PHP_SESSION_NONE) {
   session_start();
}






$sql_permisos = "select pu.visualizar ,p.id_objeto from tbl_permisos_usuarios pu ,tbl_objetos p,tbl_usuarios u ,tbl_roles r where r.id_rol=pu.id_rol and r.id_rol=u.id_rol and pu.id_objeto=p.id_objeto and id_usuario=" . $_SESSION['id_usuario'] . " ";

$resultado_permisos = $mysqli->query($sql_permisos);

/*Botones principales*/
$_SESSION['btn_seguridad'] = 'none';
$_SESSION['btn_vinculacion'] = 'none';
$_SESSION['btn_solicitudes'] = 'none';
$_SESSION['btn_coordinacion'] = 'none';
$_SESSION['btn_docentes'] = 'none';
$_SESSION['btn_mantenimientos'] = 'none';
$_SESSION['btn_ayuda'] = 'none';
$_SESSION['btn_mantenimiento'] = 'none';
$_SESSION['btn_jefatura'] = 'none';

/*Menu laterales*/
$_SESSION['pregunta_vista'] = 'none';
$_SESSION['usuarios_vista'] = 'none';
$_SESSION['roles_vista'] = 'none';
$_SESSION['permisos_usuario_vista'] = 'none';
$_SESSION['parametro_vista'] = 'none';
$_SESSION['bitacora_vista'] = 'none';
$_SESSION['practica_vista'] = 'none';
$_SESSION['supervision_vista'] = 'none';
$_SESSION['egresados_vista'] = 'none';
$_SESSION['proyectos_vinculacion_vista'] = 'none';
$_SESSION['final_practica'] = 'none';
$_SESSION['cambio_carrera'] = 'none';
$_SESSION['carta_egresado'] = 'none';
$_SESSION['equivalencias'] = 'none';
$_SESSION['cancelar_clases'] = 'none';
$_SESSION['solicitud_practica'] = 'none';
$_SESSION['solicitud_final_practica'] = 'none';
$_SESSION['solicitud_cambio_carrera'] = 'none';
$_SESSION['solicitud_carta_egresado'] = 'none';
$_SESSION['solicitud_equivalencias'] = 'none';
$_SESSION['solicitud_cancelar_clases'] = 'none';
$_SESSION['carga_academica_vista'] = 'none';
$_SESSION['docentes_vista'] = 'none';
$_SESSION['mantemiento_carga_academica'] = 'none';
$_SESSION['mantemiento_carga_academica1'] = 'none';
$_SESSION['plan_estudio_vista'] = 'none';
$_SESSION['mantenimiento_plan'] = 'none';
$_SESSION['gestion_carga'] = 'none';
$_SESSION['gestion_reasignacion'] = 'none';
$_SESSION['gestion_planificacion '] = 'none';

while ($fila = $resultado_permisos->fetch_row()) {
   /*
   	echo '<script> alert("Bienvenido a nuestro sistema :  ' .$fila[0], $fila[1]. '")</script>';
       */
   if ($fila[0] == '1') {
      $_SESSION['confirmacion_ver'] = "block";
   } else {
      $_SESSION['confirmacion_ver'] = "none";
   }
   permisos_a_roles_visualizar($fila[1], $_SESSION['confirmacion_ver']);
}




function  permisos_a_roles_visualizar($pantalla, $confirmacion)
{
   $_SESSION['confirmacion'] = $confirmacion;
   $_SESSION['pantalla'] = $pantalla;


   /* $_SESSION['historial_registro']='none';*/



   if ($_SESSION['pantalla'] >= '1' and $_SESSION['pantalla'] <= '10') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_seguridad'] = "block";
      }
   }


   if ($_SESSION['pantalla'] == '14' or $_SESSION['pantalla'] == '20'  or $_SESSION['pantalla'] == '21') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_vinculacion'] = "block";
      }
   }

   if ($_SESSION['pantalla'] >= '51') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_docentes'] = "block";
      }
   }
   if ($_SESSION['pantalla'] >= '51') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_docentes'] = "block";
      }
   }

   if ($_SESSION['pantalla'] >= '71') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_ayuda'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '1' or $_SESSION['pantalla'] == '2') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['pregunta_vista'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '3' or $_SESSION['pantalla'] == '4') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['usuarios_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '5' or $_SESSION['pantalla'] == '6') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['roles_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '7') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['parametro_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '8') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['bitacora_vista'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '9' or $_SESSION['pantalla'] == '10') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['permisos_usuario_vista'] = "block";
      }
   }


   if ($_SESSION['pantalla'] == '14'  or $_SESSION['pantalla'] == '18' or $_SESSION['pantalla'] == '20' or $_SESSION['pantalla'] == '21' or $_SESSION['pantalla'] == '26' or $_SESSION['pantalla'] == '27' or $_SESSION['pantalla'] == '28') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['practica_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '14'  or $_SESSION['pantalla'] == '18' or $_SESSION['pantalla'] == '20' or $_SESSION['pantalla'] == '21' or $_SESSION['pantalla'] == '26' or $_SESSION['pantalla'] == '27' or $_SESSION['pantalla'] == '28') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['supervision_vista'] = "block";
      }
   }


   if ($_SESSION['pantalla'] == '13' or $_SESSION['pantalla'] == '15' or $_SESSION['pantalla'] == '16' or $_SESSION['pantalla'] == '17' or $_SESSION['pantalla'] == '19' or $_SESSION['pantalla'] == '39' or  $_SESSION['pantalla'] == '40') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['solicitud_practica'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '22' or $_SESSION['pantalla'] == '23') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['egresados_vista'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '24' or $_SESSION['pantalla'] == '25') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['proyectos_vinculacion_vista'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '29') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['solicitud_final_practica'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '30') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['solicitud_cambio_carrera'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '31') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['solicitud_carta_egresado'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '32') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['solicitud_equivalencias'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '33') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['solicitud_cancelar_clases'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '34') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['final_practica'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '35') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['cambio_carrera'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '36') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['carta_egresado'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '37') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['equivalencias'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '38') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['cancelar_clases'] = "block";
      }
   }



   // boton de solicitudes */
   if ($_SESSION['pantalla'] >= '29' and $_SESSION['pantalla'] <= '33' or $_SESSION['pantalla'] == '13' or $_SESSION['pantalla'] == '15' or $_SESSION['pantalla'] == '16' or $_SESSION['pantalla'] == '17' or $_SESSION['pantalla'] == '19' or $_SESSION['pantalla'] == '39' or  $_SESSION['pantalla'] == '40') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_solicitudes'] = "block";
      }
   }
   // boton de coordinacion */
   //** las pantallas son el id de la tbl_objetos */
   if ($_SESSION['pantalla'] >= '34' and $_SESSION['pantalla'] <= '38') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_coordinacion'] = "block";
      }
   }




   //AGREGANDO CARGA ACADEMICA
   if ($_SESSION['pantalla'] == '45' or $_SESSION['pantalla'] == '47' or $_SESSION['pantalla'] == '48') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['carga_academica_vista'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '49' or $_SESSION['pantalla'] == '50' or $_SESSION['pantalla'] == '54' or $_SESSION['pantalla'] == '53' or $_SESSION['pantalla'] == '51') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['docentes_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '94') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantemiento_carga_academica1'] = "block";
      }
   }

   if ($_SESSION['pantalla'] == '70') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantemiento_carga_academica'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '95') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantenimiento_plan'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '103') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['plan_estudio_vista'] = "block";
      }
   }

   if ($_SESSION['pantalla'] = '55') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['btn_mantenimiento'] = "block";
      }
   }
   //----agregando vistas de GESTION DEL MODULO DE JEFATURA----//
   if ($_SESSION['pantalla'] = '266') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['jefatura'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '236') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_cargajefatura_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '249') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_reasignacionjefatura_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '250') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_reasignacion_solicitud'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '251') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_reasignacion_retroalimentacion'] = "block";
      }
   }
   
   if ($_SESSION['pantalla'] == '252') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_planificacionjefatura_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '245') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_carga_cargaacademica_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '241') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_carga_recontratacion_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '237') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_carga_declaracionjurada_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '247') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['responsables_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '253') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_solicitud_reasignacion_docentes'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '254') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_retroalimentacion_docentes'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '239') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_generardeclaracion_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '243') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_generarrecontratacion_vista'] = "block";
      }
   }
   //nuevas pantallas de poa
   if ($_SESSION['pantalla'] == '238') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['poa_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '240') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['objetivos_poa'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '242') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['indicadores_poa'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '244') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['metas_poa'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '246') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['actividades_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '255') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['menu_mantenimientos_jefatura_principal'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '262') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['indicador_tipo'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '263') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantenimiento_tipo_indicadores'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '264') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['responsables_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '262') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['indicador_tipo'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '259') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantenimiento_tipos_recursos'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '258') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['recursos_tipo'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '260') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['gastos_tipo'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '261') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['mantenimiento_tipo_gastos_vista'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '248') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_detalle_recursos'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '256') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_detalle_indicadores'] = "block";
      }
   }
   if ($_SESSION['pantalla'] == '257') {
      if ($_SESSION['confirmacion'] == 'block') {
         $_SESSION['g_detalle_gastos'] = "block";
      }
   }


   // if ($_SESSION['pantalla']=='55')
   // {
   //  if ( $_SESSION['confirmacion']=='block') 
   //  {
   //   $_SESSION['mantemiento_carga_academica']="block";

   //  }
   // }   //--------------------------

}
