<?php

    $servidor= "localhost";
    $usuario= "root";
    $password = "";
    $base= "informat_desarrollo_automatizacion";

	$mysqli = new mysqli($servidor,$usuario,$password,$base);
	$connection = mysqli_connect($servidor,$usuario,$password,$base) or die("Error " . mysqli_error($connection));
	
	if($mysqli->connect_error){
		echo "Nuestro sitio presenta fallas....";
		die('Error en la conexion' . $mysqli->connect_error);
		exit();	
	}
 $connect = new PDO("mysql:localhost;dbname=informat_desarrollo_automatizacion", "root", "");

if (!mysqli_set_charset($mysqli, "utf8")) {
        printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($mysqli));
        exit();
    } else {
        printf("");
    }

    
	

?>