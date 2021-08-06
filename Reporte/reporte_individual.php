<?php
require_once("../Controlador/db.php");
$db = new db;

if (isset($_GET['enviar'])) {
    $id_coordAcademica = $_GET['id_coordAcademica'];
    $nombre_docente = $_GET['nombre_docente'];
    $arrayNombre = explode(" ", $nombre_docente, 3);
    $nombre_buscar = $arrayNombre[0] . " " . $arrayNombre[1];

    $identidad = $db->get_id($nombre_buscar);
    if ($identidad == false) {
        $nombre_buscar = $arrayNombre[0];
        $n_identidad = $db->get_id($nombre_buscar);
        $id_final = $n_identidad['identidad'];
        if ($id_final == false) {
            $id_final = '0000-0000-00000';
        }
    } else {
        $id_final = $identidad['identidad'];
    }

    $nombre_jefe = $_GET['nombre_jefe'];
    $depto = $_GET['depto'];
    $identidad = $_GET['identidad'];
    $periodo = $_GET['periodo'];
    $profesion = $_GET['profesion'];    
}
require '../clases/conexion3.php';
$conexion = conexion();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../">
</head>

<body>
    <?php 
    header('Content-type: application/vnd.ms-word');
    header("Content-Disposition: attachment; filename=docentes_individual.doc");
    header("Pragma: no-cache");
    header("Expires: 0"); ?>
    <div class="container">
        <p align="center" class="f0">
            <strong>DECLARACIÓN JURADA DE ASIGNACIÓN ACADÉMICA</strong><br>
        </p>
        <br>
        <p style="font-family:Calibri; text-align:justify;">
            Nosotros, <u><strong><?php echo $nombre_jefe; ?> </strong> </u> Jefe del Departamento de <u><strong><?php echo $depto; ?> </strong></u>, hondureño (a) mayor de edad, soltero (a), ____________ casado (a)_____X____ con tarjeta de identidad número <u><strong> <?php echo $identidad; ?> </strong></u>, de profesión <u><strong><?php echo $profesion;?> </strong></u>, y de este domicilio, <u><strong><?php echo $nombre_docente; ?></strong>  </u> Profesor por Hora Hondureño (a) mayor de edad, soltero (a), ____x______ casado (a) ______________ con tarjeta de identidad número <u><strong><?php echo $id_final; ?></strong></u>, de profesión Lic. en Informática Administrativa__ y de este domicilio.
            Mediante el presente documento, libre y espontáneamente declaramos bajo juramento, que la carga académica asignada al Lic. <u><strong><?php echo $nombre_docente; ?></strong>  </u> , Profesor por Hora del Departamento de ___Informática_____, durante el <u><strong><?php echo $periodo; ?></strong></u> Período Académico de 2021, es la siguiente:
        </p>

        <br>
        <br>

        <?php
        echo "<table class='table'><tr><th>CODIGO</th><th>ASIGNATURA</th><th>UV</th><th>SECCION</th><th>N° ALUMNOS</th></tr>";
        //$consulta1 = "SELECT Codigo from tbl_carga_academica_temporal WHERE Nombre = '".$row['Nombre']."'"; 
        $consulta1 = "SELECT DISTINCT Codigo, Asignatura,UV,Seccion,N_Alumnos FROM tbl_carga_academica_temporal WHERE Nombre = '" . $nombre_docente . "' AND id_coordAcademica = ".$id_coordAcademica." group by Seccion";
        $resultado = mysqli_query($conexion, $consulta1);
        while ($row = mysqli_fetch_array($resultado)) {
            echo "<tr><td>" . $row['Codigo'] . "</td>";
            echo "<td>" . $row['Asignatura'] . "</td>";
            echo "<td>" . $row['UV'] . "</td>";
            echo "<td>" . $row['Seccion'] . "</td>";
            echo "<td>" . $row['N_Alumnos'] . "</td></tr>";
        }
        echo "</table><br>";
        ?>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>