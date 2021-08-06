<?php
if (isset($_GET['enviar'])) {
    $id_coordAcademica = $_GET['id_archivo'];
    $nombre_master = $_GET['master'];
    $numero_ofi = $_GET['numero_ofi'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
</head>

<body>
    <div class="container">
        <p><strong>OFICIO No <?php echo $numero_ofi; ?> </strong> </p>
        <label for=""><strong>27 de enero de 2021</strong></label>

        <h3>MASTER</h3> <br>
        <p><?php echo $nombre_master; ?> </p>

        <p>Decano de la facultad de Ciencias Económicas, Administrativas y Contables </p>
        <p>Su Oficina</p>

        <strong>Estimado Máster:</strong>
        <p style="text-align:justify">De acuerdo con lo solicitado, remito la <strong>Carga Académica completa de profesores</strong> de este Departamento, correspondiente al I PAC 2021</p>
        <p>Sin otro particular, me despido de Usted,</p>
        <p>Atentamente</p>

        <br>
        <br> <br> <br>
        <br> <br> <br>
        <br> <br> <br>
        <br> <br> <br>
        <br> <br> <br>
        <br> <br> <br>
        <br> <br> <br>
        <br>
        <p></p>
        <p></p>
        <p class="f1">
        <table style="border-collapse: collapse; border: none;" style="width:100%;">
            <tr>
                <th style="text-align: center;">MSC. Patricia Ellner Villalonga</th>
                <th style="width:150px"></th>
                <th style="text-align: center;">______________________________</th>
            </tr>
            <tr>
                <td style="text-align: center;">Jefe del departamento de Informática</td>
                <td></td>
                <td style="text-align: center;">Decano de la Facultad de Ciencias Económicas</td>
            </tr>
        </table>
        </p>
        <br> <br>


        <center>
            <h2>Departamento de Informática</h2>
            <h2>CARGA ACADEMICA I PAC 2021</h2>
        </center>


        <?php
        require '../clases/conexion3.php';
        $conexion = conexion();

        header('Content-type: application/vnd.ms-word');
        header("Content-Disposition: attachment; filename=docentes_hora.doc");
        header("Pragma: no-cache");
        header("Expires: 0");

        $consulta = "SELECT DISTINCT Nombre from tbl_carga_academica_temporal WHERE id_coordAcademica = " . $id_coordAcademica . " ";
        $result = mysqli_query($conexion, $consulta);
        while ($row = mysqli_fetch_array($result)) {
            echo "<h3>" . $row['Nombre'] . "</h3>";
            echo "<table class='table'>";
            echo "<tr><th>CODIGO</th><th>ASIGNATURA</th><th>UV</th><th>SECCION</th><th>N° ALUMNOS</th></tr>";
            //$consulta1 = "SELECT Codigo from tbl_carga_academica_temporal WHERE Nombre = '".$row['Nombre']."'"; 
            $consulta1 = "SELECT DISTINCT Codigo, Asignatura,UV,Seccion,N_Alumnos FROM tbl_carga_academica_temporal WHERE Nombre = '" . $row['Nombre'] . "' AND id_coordAcademica = " . $id_coordAcademica . " group by Seccion";
            $resultado = mysqli_query($conexion, $consulta1);
            while ($row = mysqli_fetch_array($resultado)) {
                //echo "Codigo: ".$row['Codigo']."Seccion: ".$row['Seccion']. "<br>" ;

                echo "<tr><td>" . $row['Codigo'] . "</td>";
                echo "<td>" . $row['Asignatura'] . "</td>";
                echo "<td>" . $row['UV'] . "</td>";
                echo "<td>" . $row['Seccion'] . "</td>";
                echo "<td>" . $row['N_Alumnos'] . "</td></tr>";
            }
            echo "</table><br>";
        }
        ?>
    </div>
</body>

</html>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>