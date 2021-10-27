<?php
//generando la conexion a la base de datos
function conexion(){ 
    $db_host="localhost";
 	$db_nombre="informat_desarrollo_automatizacion";
 	$db_usuario="root";
 	$db_contra="";

 	$conexion = mysqli_connect($db_host,$db_usuario,$db_contra);

 	//error al buscar la direccion del host
 	if(mysqli_connect_errno()){
 		echo "Fallo al conectar con la Base de datos";
 		exit();
 	}

	 
 	//Error al conectar con la base de datos
 	mysqli_select_db($conexion,$db_nombre) or die("No se encuentra la base de datos");

 	mysqli_set_charset($conexion, "utf8");

 	return $conexion;
	
}
/*
	if (conexion()){
		echo "conectado new";

	}else{
		echo "No conectado new";
	}
*/
  
?>