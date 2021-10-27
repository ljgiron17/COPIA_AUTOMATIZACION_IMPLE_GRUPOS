<?php
require_once("../clases/conexion2.php");
class db extends conexion2
{
    //!modificacion 1/8/2021 ----------------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function addfileAcademica($periodo_ca, $descrip_ca, $nombre_archivo, $fecha/*, $periodo_cr, $descripcion_cr, $nombre_archivo_cr, $fecha_cr*/)
    {
        $sql = "INSERT INTO tbl_coordinacion_academica (periodo,descripcion,nombre_archivo, fecha) VALUES (:periodo_ca, :descrip_ca, :nombre_archivo, :fecha)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'periodo_ca' => $periodo_ca,
            'descrip_ca' => $descrip_ca,
            'nombre_archivo' => $nombre_archivo,
            'fecha' => $fecha
        ]);
        $id_ca = $this->conn->lastInsertId();

        // $sql = "INSERT INTO tbl_craed_jefatura (periodo_cr, descripcion_cr, nombre_archivo_cr, fecha_cr) VALUES (:periodo_cr, :descripcion_cr, :nombre_archivo_cr, :fecha_cr )";
        // $stmt = $stmt = $this->conn->prepare($sql);
        // $stmt->execute([
        //     'periodo_cr' => $periodo_cr,
        //     'descripcion_cr' => $descripcion_cr,
        //     'nombre_archivo_cr' => $nombre_archivo_cr,
        //     'fecha_cr' => $fecha_cr
        // ]);
        return $id_ca;
    }

    public function subir_craed($periodo_cr, $descripcion_cr, $nombre_archivo_cr, $fecha_cr)
    {
        $sql = "INSERT INTO tbl_craed_jefatura (periodo_cr, descripcion_cr, nombre_archivo_cr, fecha_cr) VALUES (:periodo_cr, :descripcion_cr, :nombre_archivo_cr, :fecha_cr )";
        $stmt = $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'periodo_cr' => $periodo_cr,
            'descripcion_cr' => $descripcion_cr,
            'nombre_archivo_cr' => $nombre_archivo_cr,
            'fecha_cr' => $fecha_cr
        ]);

        $id_cr = $this->conn->lastInsertId();

        return $id_cr;
    }

    //! fin modificacion 1/8/2021 ----------------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>




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


    public function updateSolicitudDenegada($id_solicitud, $razon)
    {
        $sql = "UPDATE tbl_reasignacion_academica set estado = 'Denegada', razon_negada =:razon WHERE id_reac_academica = :id_solicitud";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_solicitud' => $id_solicitud,
            'razon' => $razon
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

    public function EliminarRecurso($id_recurso)
    {

        $sql = "DELETE FROM `tbl_recursos_tipo` WHERE `tbl_recursos_tipo`.`id_recurso_tipo` =:id_recurso ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_recurso' => $id_recurso
        ]);
        return 'exito';
    }

    // public function eliminarRecurso($id)
    // {
    //     $sql = "DELETE FROM tbl_recursos_tipo WHERE id_recurso_tipo =:id";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([
    //         'id' => $id
    //     ]);
    //     return 'exito';
    // }

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


    public function insertTipoindicador($descripcion, $estado, $fecha, $nombre_indicador)
    {
        $sql = "INSERT INTO tbl_indicadores_gestion(descripcion,estado, fecha, nombre_indicador)  VALUES (:descripcion, :estado, :fecha, :nombre_indicador) ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'descripcion' => $descripcion,
            'estado' => $estado,
            'fecha' => $fecha,
            'nombre_indicador' => $nombre_indicador
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


    //! detalles recursos
    public function getDataTipo_recurso()
    {
        $sql = "SELECT `id_recurso_tipo`, `nombre_recurso` from tbl_recursos_tipo";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([]);
        $filas = $stmt->fetchAll();
        return $filas;
    }

    //Laura recursos
    public function insertar_detalle($nombre, $cantidad, $descripcion, $precio_aprox, $id_recurso_tipo)
    {
        $sql = "INSERT INTO `tbl_detalles_tipo_recurso`(`nombre`, `cantidad`, `descripcion`, `precio_aprox`, `id_recurso_tipo`) 
        VALUES (:nombre, :cantidad, :descripcion, :precio_aprox, :id_recurso_tipo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'cantidad' => $cantidad,
            'descripcion' => $descripcion,
            'precio_aprox' => $precio_aprox,
            'id_recurso_tipo' => $id_recurso_tipo
        ]);
        return 'exito';
    }

    //parte de los indicadores para agregar multiples descripciones
    public function getDataTipo_indicador()
    {
        $sql = "SELECT `id_indicadores_gestion`, `nombre_indicador` from tbl_indicadores_gestion";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([]);
        $filas = $stmt->fetchAll();
        return $filas;
    }

    public function insertar_detalle_gestion($descripcion, $id_indicador_gestion)
    {
        $sql = "INSERT INTO `tbl_detalles_tipo_indicador`(`descripcion`, `id_indicadores_gestion`) VALUES (:descripcion,:id_indicador_gestion)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'descripcion' => $descripcion,
            'id_indicador_gestion' => $id_indicador_gestion
        ]);
        return 'exito';
    }

    public function eliminar_deatlle_gasto($id_detalle_tipo_gasto)
    {
        $sql = "DELETE FROM `tbl_detalles_tipo_gasto` WHERE `id_detalle_tipo_gasto` =:id_detalle_tipo_gasto";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_detalle_tipo_gasto' => $id_detalle_tipo_gasto
        ]);
        return 'exito';
    }
    public function eliminar_detalle_indicador($id_detalles_tipo_indicador)
    {
        $sql = "DELETE FROM `tbl_detalles_tipo_indicador` WHERE `id_detalles_tipo_indicador` =:id_detalles_tipo_indicador";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_detalles_tipo_indicador' => $id_detalles_tipo_indicador
        ]);
        return 'exito';
    }

    public function eliminar_detalle_recurso($id_detalle_tipo_recurso)
    {
        $sql = "DELETE FROM `tbl_detalles_tipo_recurso` WHERE `id_detalle_tipo_recurso` =:id_detalle_tipo_recurso";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_detalle_tipo_recurso' => $id_detalle_tipo_recurso
        ]);
        return 'exito';
    }

    public function eliminar_indicador($id_indicador)
    {
        $sql = "DELETE FROM `tbl_detalles_tipo_indicador` WHERE `id_detalles_tipo_indicador` =:id_indicador ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador' => $id_indicador
        ]);
        return 'exito';
    }
    //!detalles gastos
    public function getDataTipo_gasto()
    {
        $sql = "SELECT `id_tipo_gastos`, `nombre_gasto` from  tbl_tipo_gastos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([]);
        $filas = $stmt->fetchAll();
        return $filas;
    }

    public function insertar_detalle_gasto($nombre, $cantidad, $descripcion, $precio_aprox, $id_tipo_gastos)
    {
        $sql = "INSERT INTO `tbl_detalles_tipo_gasto`(`nombre`, `cantidad`, `descripcion`, `precio_aprox`, `id_tipo_gastos`) 
    VALUES (:nombre, :cantidad, :descripcion, :precio_aprox, :id_tipo_gastos)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'cantidad' => $cantidad,
            'descripcion' => $descripcion,
            'precio_aprox' => $precio_aprox,
            'id_tipo_gastos' => $id_tipo_gastos
        ]);
        return 'exito';
    }

    public function eliminarGestion_indicador($id_detalles_tipo_indicador)
    {
        $sql = "DELETE FROM ` tbl_detalles_tipo_indicador` WHERE id_indicador = :id_indicador";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_detalle_tipo_indicador' => $id_detalles_tipo_indicador
        ]);
        return 'exito';
    }

    public function eliminarGestion_recursos($id_detalle_tipo_recurso)
    {
        $sql = "DELETE FROM `tbl_detalles_tipo_recurso` WHERE id_detalle_tipo_recurso = :id_detalle_tipo_recurso";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_detalle_tipo_recurso' => $id_detalle_tipo_recurso
        ]);
        return 'exito';
    }







    //?ultima modificacion 28/07/2021
    public function getDocentes()
    {
        $sql = "SELECT id_persona, CONCAT(nombres,' ',apellidos)as nombre_completo  from tbl_personas WHERE id_tipo_persona = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([]);
        $filas = $stmt->fetchAll();
        return $filas;
    }

    public function insert_soli($id_docente, $nombre_docente, $nombre_proyecto, $fecha_inicio, $fecha_final, $avance_realizado, $proyec_periodo_actual, $cant_horas, $estado)
    {
        $sql = "INSERT INTO `tbl_reasignacion_academica`(`id_docente`, `nombre_docente`, `nombre_proyecto`, `fecha_inicio`, `fecha_final`, `avance_realizado`, `proyec_periodo_actual`, `cant_horas`, `estado`) 
        VALUES (:id_docente, :nombre_docente, :nombre_proyecto, :fecha_inicio, :fecha_final, :avance_realizado, :proyec_periodo_actual, :cant_horas, :estado)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_docente' => $id_docente,
            'nombre_docente' => $nombre_docente,
            'nombre_proyecto' => $nombre_proyecto,
            'fecha_inicio' => $fecha_inicio,
            'fecha_final' => $fecha_final,
            'avance_realizado' => $avance_realizado,
            'proyec_periodo_actual' => $proyec_periodo_actual,
            'cant_horas' => $cant_horas,
            'estado' => $estado
        ]);
        return 'exito';
    }
    //?ultima modificacion 28/07/2021

    //?modificacion 29/07/2021
    public function get_id($nombre_docente)
    {
        $sql = "SELECT identidad FROM tbl_personas WHERE nombres=:nombre_docente";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'nombre_docente' => $nombre_docente
        ]);
        $fila = $stmt->fetch();
        return $fila;
    }

    public function add_retroalimentacion($periodo, $anio, $docente, $codigo_empleado, $cant_clases_reasignadas, $memorandum, $nombre_proyecto, $fecha_inicio, $fecha_finalizacion, $n_identidad, $estado, $avances)
    {
        $sql = "INSERT INTO `tbl_retroalimentacion`(`periodo`, `anio`, `docente`, `codigo_empleado`, `cant_clases_reasignadas`, `memorandum`, `nombre_proyecto`, `fecha_inicio`, `fecha_finalizacion`, `n_identidad`, `estado`, `avances`) 
    VALUES (:periodo, :anio, :docente, :codigo_empleado, :cant_clases_reasignadas, :memorandum, :nombre_proyecto, :fecha_inicio, :fecha_finalizacion, :n_identidad, :estado, :avances)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'periodo' => $periodo,
            'anio' => $anio,
            'docente' => $docente,
            'codigo_empleado' => $codigo_empleado,
            'cant_clases_reasignadas' => $cant_clases_reasignadas,
            'memorandum' => $memorandum,
            'nombre_proyecto' => $nombre_proyecto,
            'fecha_inicio' => $fecha_inicio,
            'fecha_finalizacion' => $fecha_finalizacion,
            'n_identidad' => $n_identidad,
            'estado' => $estado,
            'avances' => $avances
        ]);
        return 'exito';
    }

    //?fin modificacion 29/07/2021

    public function editar_recurso($id_recurso, $nombre_recurso_ed, $descripcion_ed)
    {
        $sql = "UPDATE `tbl_recursos_tipo` SET `descripcion`= :descripcion_ed,`nombre_recurso`= :nombre_recurso_ed WHERE `id_recurso_tipo` =:id_recurso";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_recurso' => $id_recurso,
            'nombre_recurso_ed' => $nombre_recurso_ed,
            'descripcion_ed' => $descripcion_ed
        ]);

        return 'exito';
    }

    public function edicion_indicador($id_indicador, $nombre_indicador, $descripcion)
    {
        $sql = "UPDATE tbl_indicadores_gestion SET descripcion = :descripcion , nombre_indicador = :nombre_indicador WHERE id_indicadores_gestion = :id_indicador";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador' =>   $id_indicador,
            'nombre_indicador' =>  $nombre_indicador,
            'descripcion' =>  $descripcion
        ]);

        return 'exito';
    }

    public function editar_gasto($id_gasto, $descripcion, $nombre_gasto)
    {
        $sql = "UPDATE tbl_tipo_gastos SET nombre_gasto =:nombre_gasto, descripcion =:descripcion WHERE id_tipo_gastos =:id_gasto";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_gasto' =>  $id_gasto,
            'descripcion' =>  $descripcion,
            'nombre_gasto' =>  $nombre_gasto
        ]);
        return 'exito';
    }

    public function editar_detalle_recurso($id_detalle_recurso, $nombre_detalle, $cant_detalle, $precio_detalle, $desc_detalle)
    {
        $sql = "UPDATE `tbl_detalles_tipo_recurso` SET nombre =:nombre_detalle , descripcion =:desc_detalle , cantidad = :cant_detalle , precio_aprox=:precio_detalle WHERE id_detalle_tipo_recurso =:id_detalle_recurso";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_detalle_recurso' => $id_detalle_recurso,
            'nombre_detalle' =>  $nombre_detalle,
            'cant_detalle' =>   $cant_detalle,
            'precio_detalle' =>   $precio_detalle,
            'desc_detalle' => $desc_detalle
        ]);
        return 'exito';
    }

    
    public function detalle_indicador($id_indicador, $descripcion)
    {
        $sql = "UPDATE `tbl_detalles_tipo_indicador` SET descripcion=:descripcion WHERE id_detalles_tipo_indicador =:id_indicador";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_indicador' => $id_indicador,
            'descripcion' => $descripcion
        ]);
        return 'exito';
    }
}
