<?php
require_once("../clases/conexion2.php");
class db extends conexion2
{
    public function addfileAcademica($periodo_ca, $descrip_ca, $nombre_archivo, $fecha, $periodo_cr, $descripcion_cr, $nombre_archivo_cr, $fecha_cr)
    {
        $sql = "INSERT INTO tbl_coordinacion_academica (periodo,descripcion,nombre_archivo, fecha) VALUES (:periodo_ca, :descrip_ca, :nombre_archivo, :fecha)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'periodo_ca' => $periodo_ca,
            'descrip_ca' => $descrip_ca,
            'nombre_archivo' => $nombre_archivo,
            'fecha' => $fecha
        ]);

        $sql = "INSERT INTO tbl_craed_jefatura (periodo_cr, descripcion_cr, nombre_archivo_cr, fecha_cr) VALUES (:periodo_cr, :descripcion_cr, :nombre_archivo_cr, :fecha_cr )";
        $stmt = $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'periodo_cr' => $periodo_cr,
            'descripcion_cr' => $descripcion_cr,
            'nombre_archivo_cr' => $nombre_archivo_cr,
            'fecha_cr' => $fecha_cr
        ]);
        return "exito";
    }
}
