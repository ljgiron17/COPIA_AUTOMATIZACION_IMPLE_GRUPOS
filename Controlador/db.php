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


    public function insertTipoGasto($descripcion, $estado, $fecha, $nombre_gasto)
    {
        $sql = "INSERT INTO tbl_tipo_gastos(descripcion,estado, fecha, nombre_gasto)  VALUES (:descripcion, :estado, :fecha, :nombre_gasto) ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'descripcion' => $descripcion,
            'estado' => $estado,
            'fecha' => $fecha,
            'nombre_gasto' => $nombre_gasto
        ]);
        return 'exito';
    }
    //eliminar los gastos
    public function eliminarGastos($id)
    {
        $sql = "DELETE FROM  tbl_tipo_gastos  WHERE id_tipo_gastos = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return 'exito';
    }
    //cambiar los gastos funcion activo y desactivar
    public function cambiarEstadog($id, $estado)
    {
        $sql = "UPDATE tbl_tipo_gastos set estado = :estado WHERE id_tipo_gastos = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'estado' => $estado
        ]);
        return 'exito';
    }
    public function insertTipoindicador($descripcion, $estado, $fecha, $nombre_gasto)
    {
        $sql = "INSERT INTO tbl_tipo_gastos(descripcion,estado, fecha, nombre_gasto)  VALUES (:descripcion, :estado, :fecha, :nombre_gasto) ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'descripcion' => $descripcion,
            'estado' => $estado,
            'fecha' => $fecha,
            'nombre_gasto' => $nombre_gasto
        ]);
        return 'exito';
    }
    //eliminar los indicadores de gestion
    public function eliminarGestion($id)
    {
        $sql = "DELETE FROM  tbl_indicadores_gestion  WHERE id_indicadores_gestion = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return 'exito';
    }

    //cambiar los indicadores funcion activo y desactivar
    public function cambiarEstadogg($id, $estado)
    {
        $sql = "UPDATE  tbl_indicadores_gestion set estado = :estado WHERE id_indicadores_gestion = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'estado' => $estado
        ]);
        return 'exito';
    }

    public function contarArchivo($id)
    {
        $sql = "SELECT COUNT(`id_coordAcademica`)AS cuenta FROM `tbl_carga_academica_temporal` WHERE `id_coordAcademica` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        $fila = $stmt->fetch();
        return $fila;
    }

    public function contarArchivoCR($id)
    {
        $sql = "SELECT COUNT(`id_craed_jefa`)AS cuenta FROM `tbl_carga_craed` WHERE `id_craed_jefa` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        $fila = $stmt->fetch();
        return $fila;
    }

    //aqui empieza el poa db.php
    public function retro($id_retro)
    {
        $sql = "SELECT * FROM tbl_retroalimentacion WHERE id_retroalimentacion =:id_retro";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_retro' => $id_retro
        ]);
        $fila = $stmt->fetch();
        return $fila;
    }


    public function addPlanificaion($nombre, $descripcion, $anio)
    {
        $sql = "INSERT INTO tbl_planificaciones (nombre, descripcion, anio) VALUES (:nombre, :descripcion, :anio)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'anio' => $anio
        ]);
        return 'exito';
    }

    public function addObjetivo($nombre_objetivo, $descripcion, $id_planificacion)
    {
        $sql = "INSERT INTO tbl_objetivos_estrategicos (nombre_objetivo, descripcion, id_planificacion ) VALUES (:nombre_objetivo, :descripcion, :id_planificacion)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'nombre_objetivo' => $nombre_objetivo,
            'descripcion' => $descripcion,
            'id_planificacion' => $id_planificacion
        ]);
        return 'exito';
    }

    public function deleteObj($id)
    {
        $sql = "DELETE FROM `tbl_objetivos_estrategicos` WHERE id_objetivo = :id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return 'exito';
    }

    public function new_indicador($descripcion, $resultados, $id_objetivo)
    {
        $sql = "INSERT INTO tbl_indicadores (descripcion, resultados, id_objetivo) VALUES (:descripcion, :resultados, :id_objetivo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'descripcion' => $descripcion,
            'resultados' => $resultados,
            'id_objetivo' => $id_objetivo
        ]);
        return 'exito';
    }

    public function deletePlan($id_planificacion)
    {
        $sql = "DELETE FROM tbl_planificaciones WHERE id_planificacion = :id_planificacion";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_planificacion' => $id_planificacion
        ]);
        return 'exito';
    }

    public function editPlan($id_plan, $descripcion, $anio, $nombre_plan)
    {
        $sql = "UPDATE tbl_planificaciones set nombre = :nombre_plan, descripcion = :descripcion, anio = :anio WHERE id_planificacion = :id_plan";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_plan' => $id_plan,
            'descripcion' => $descripcion,
            'anio' => $anio,
            'nombre_plan' => $nombre_plan
        ]);
        return 'exito';
    }

    public function editObj($id_objetivo, $nombre_objetivo, $descripcion)
    {
        $sql = "UPDATE tbl_objetivos_estrategicos set nombre_objetivo = :nombre_objetivo, descripcion= :descripcion WHERE id_objetivo = :id_objetivo";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_objetivo' => $id_objetivo,
            'nombre_objetivo' => $nombre_objetivo,
            'descripcion' => $descripcion
        ]);
        return 'exito';
    }

    public function delete_Indicador($id_indicador)
    {
        $sql = "DELETE FROM `tbl_indicadores` WHERE id_indicador = :id_indicador";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador' => $id_indicador
        ]);
        return 'exito';
    }


    public function edit_indicador($id_indicador, $descripcion, $resultados)
    {
        $sql = "UPDATE tbl_indicadores SET descripcion = :descripcion, resultados= :resultados WHERE id_indicador = :id_indicador";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador' => $id_indicador,
            'descripcion' => $descripcion,
            'resultados' => $resultados
        ]);
        return 'exito';
    }


    public function get_data_responsables($id_indicador)
    {
        $sql = "select r.id_responsables, r.descripcion_responsable from tbl_responsables r, tbl_indica_responsables ir, tbl_indicadores i 
    WHERE r.id_responsables = ir.id_responsables AND i.id_indicador = ir.id_indicador AND i.id_indicador = :id_indicador";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador' => $id_indicador
        ]);
        $filas = $stmt->fetchAll();
        return $filas;
    }


    public function insert_responsable($id_indicador, $responsable)
    {
        $sql = "INSERT INTO tbl_responsables (descripcion_responsable) VALUES (:responsable)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'responsable' => $responsable
        ]);
        $id_responsable = $this->conn->lastInsertId();

        $sql = "INSERT INTO  tbl_indica_responsables(id_responsables, id_indicador) VALUES(:id_responsable, :id_indicador)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador' => $id_indicador,
            'id_responsable' => $id_responsable
        ]);
        return 'exito';
    }

    //!ACTIVIDADES
    public function getData_actividades($id_indicador)
    {
        $sql = "SELECT ap.id_actividades_poa, ap.nombre_actividad as actividad, mv.id_verificacion, mv.descripcion as medio_veri, po.descripcion as pobla_objetivo 
    from tbl_indicadores i, tbl_actividades_poa ap, tbl_medio_verificacion mv, tbl_act_verficacion av, tbl_poblacion_objetivo po, tbl_act_poblacion_objetivo apo 
    WHERE i.id_indicador = ap.id_indicador 
    AND ap.id_actividades_poa = apo.id_actividades_poa
    AND po.id_poblacion_objetivo = apo.id_act_poblacion_objetivo
    AND ap.id_actividades_poa = av.id_actividades_poa 
    AND av.id_verificacion = mv.id_verificacion 
    AND i.id_indicador = :id_indicador";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador' => $id_indicador
        ]);
        $fila = $stmt->fetchAll();
        return $fila;
    }


    public function guardar_actividad($nombre_actividad, $id_indicador)
    {
        $sql = "INSERT INTO tbl_actividades_poa (nombre_actividad, id_indicador) VALUES (:nombre_actividad, :id_indicador)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'nombre_actividad' => $nombre_actividad,
            'id_indicador' => $id_indicador
        ]);
        $id_actividad = $this->conn->lastInsertId();
        return $id_actividad;
    }

    public function guardar_medioVerificacion($descripcion)
    {
        $sql = "INSERT INTO tbl_medio_verificacion (descripcion) VALUES (:descripcion)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'descripcion' => $descripcion
        ]);
        $id_Medio_veri = $this->conn->lastInsertId();
        return $id_Medio_veri;
    }

    public function add_poblacion_objetivo($descripcion)
    {
        $sql = "INSERT INTO tbl_poblacion_objetivo (descripcion) VALUES (:descripcion)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'descripcion' => $descripcion
        ]);
        $id_pob_obj = $this->conn->lastInsertId();
        return $id_pob_obj;
    }


    public function add_actividad_verificacion($id_actividades_poa, $id_verificacion)
    {
        $sql = "INSERT INTO tbl_act_verficacion (id_actividades_poa, id_verificacion ) VALUES (:id_actividades_poa, :id_verificacion )";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_actividades_poa' => $id_actividades_poa,
            'id_verificacion' => $id_verificacion
        ]);
        return 'exito';
    }

    public function add_actividad_poblacion($id_poblacion_objetivo, $id_actividades_poa)
    {
        $sql = "INSERT INTO tbl_act_poblacion_objetivo(id_poblacion_objetivo, id_actividades_poa) VALUES (:id_poblacion_objetivo, :id_actividades_poa )";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_poblacion_objetivo' => $id_poblacion_objetivo,
            'id_actividades_poa' => $id_actividades_poa
        ]);
        return 'exito';
    }

    //!FIN ACTIVIDADES

    //? METAS

    public function getData_Metas($id_indicador_meta)
    {
        $sql = "SELECT `id_metas`,`trimestre_1`,`trimestre_2`,`trimestre_3`,`trimestre_4` FROM tbl_metas WHERE `id_indicador`= :id_indicador_meta";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador_meta' => $id_indicador_meta
        ]);
        $filas = $stmt->fetchAll();
        return $filas;
    }

    public function contar_metas($id_indicador_meta)
    {
        $sql = "SELECT COUNT(id_indicador)as total from tbl_metas WHERE id_indicador = :id_indicador_meta";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador_meta' => $id_indicador_meta
        ]);
        $filas = $stmt->fetch();
        return $filas;
    }

    public function insertData_metas($primer_trimestre, $segundo_trimestre, $tercer_trimestre, $cuarto_trimestre, $id_indicador)
    {
        $sql = "INSERT INTO `tbl_metas`(`trimestre_1`, `trimestre_2`, `trimestre_3`, `trimestre_4`, `id_indicador`) 
    VALUES (:primer_trimestre, :segundo_trimestre, :tercer_trimestre, :cuarto_trimestre, :id_indicador)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'primer_trimestre' => $primer_trimestre,
            'segundo_trimestre' => $segundo_trimestre,
            'tercer_trimestre' => $tercer_trimestre,
            'cuarto_trimestre' => $cuarto_trimestre,
            'id_indicador' => $id_indicador
        ]);
        return 'exito';
    }

    //?FIN METAS

    public function delete_responsable($id_responsable)
    {
        $sql = "DELETE FROM `tbl_responsables` WHERE `id_responsables` = :id_responsable";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_responsable' => $id_responsable
        ]);
        return 'exito';
    }

    public function delete_actividad($id_actividad)
    {
        $sql = "DELETE FROM `tbl_actividades_poa` WHERE `id_actividades_poa` =:id_actividad";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_actividad' => $id_actividad
        ]);
        return 'exito';
    }

    public function delete_meta($id_meta)
    {
        $sql = "DELETE FROM `tbl_metas` WHERE `id_metas` =:id_meta";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_meta' => $id_meta
        ]);
        return 'exito';
    }


    public function get_data($id_planificacion)
    {
        $sql = "SELECT id_objetivo, nombre_objetivo from tbl_objetivos_estrategicos WHERE id_planificacion =:id_planificacion";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_planificacion' => $id_planificacion
        ]);
        $row = $stmt->fetchAll();
        //$filas = $stmt->fetchAll();
        return $row;
    }
}
