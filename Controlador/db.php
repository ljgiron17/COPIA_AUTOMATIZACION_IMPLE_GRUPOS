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


    public function getDatosReac($id_reac)
    {
        $sql = "SELECT * FROM tbl_reasignacion_academica WHERE id_reac_academica  = :id_reac";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_reac' => $id_reac
        ]);
        $fila = $stmt->fetch();
        return $fila;
    }

    // public function getDatosCliente(){
    //     $sql = "";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([

    //     ]);
    //     $fila = $stmt->fetch();
    //     return $fila;
    // }


    public function updateSolicitudDenegada($id_solicitud)
    {
        $sql = "UPDATE tbl_reasignacion_academica set estado = 'Denegada' WHERE id_reac_academica = :id_solicitud";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_solicitud' => $id_solicitud
        ]);
        return 'exito';
    }

    public function updateSolicitudAceptada($id_solicitud)
    {
        $sql = "UPDATE tbl_reasignacion_academica set estado = 'Aceptada' WHERE id_reac_academica = :id_solicitud";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_solicitud' => $id_solicitud
        ]);
        return 'exito';
    }

    public function newTipoRecurso($descripcion, $fecha, $nombre_recurso, $estado)
    {
        $sql = "INSERT INTO tbl_recursos_tipo (descripcion,fecha, nombre_recurso,estado) VALUES (:descripcion, :fecha, :nombre_recurso, :estado)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'descripcion' => $descripcion,
            'fecha' => $fecha,
            'nombre_recurso' => $nombre_recurso,
            'estado' => $estado
        ]);
        return 'exito';
    }

    public function eliminarRecurso($id)
    {
        $sql = "DELETE FROM tbl_recursos_tipo WHERE id_recurso_tipo = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return 'exito';
    }

    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE tbl_recursos_tipo set estado = :estado WHERE id_recurso_tipo = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'estado' => $estado
        ]);
        return 'exito';
    }
}
