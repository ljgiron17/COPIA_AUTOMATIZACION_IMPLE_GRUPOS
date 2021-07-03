<?php 
require_once "../Modelos/gestion_dias_feriados_modelo.php";

$tipogasto=new Tipogastos();

$id_tipo_gastos=isset($_POST["id_tipo_gastos"])? $instancia_conexion->limpiarCadena($_POST["id_tipo_gastos"]):"";
$fecha=isset($_POST["fecha"])? $instancia_conexion->limpiarCadena($_POST["fecha"]):"";
$descripcion=isset($_POST["descripcion"])? $instancia_conexion->limpiarCadena($_POST["descripcion"]):"";
$estado=isset($_POST["estado"])? $instancia_conexion->limpiarCadena($_POST["estado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_tipo_gastos)){
			$rspta=$tipogasto->insertar($fecha,$descripcion);
			echo $rspta ? "Feriado Agregado" : "Feriado no se pudo actualizar";
		}
		else {
			$rspta=$tipogasto->editar($id_tipo_gastos,$fecha,$descripcion);
			echo $rspta ? "Feriado Actualizado" : "Feriado no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipogasto->desactivar($id_tipo_gastos);
 		echo $rspta ? "Feriado Actualizado" : "Feriado no se pudo actualizar";
 		break;
	break;

	case 'activar':
		$rspta=$tipogasto->activar($id_tipo_gastos);
 		echo $rspta ? "Feriado Actualizado" : "Feriado no se pudo actualizar";
 		break;
	break;

	case 'mostrar':
		$rspta=$feriados->mostrar($id_tipo_gastos);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$feriados->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->fecha,
 				"1"=>$reg->descripcion,
 				"2"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',
 				"3"=>($reg->id_tipo_gastos)?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_tipo_gastos.')"><i class="far fa-edit"></i></button>':
 				'<button class="btn btn-primary" onclick="mostrar('.$reg->id_tipo_gastos.')"><i class="far fa-edit"></i></button>',
 				"4"=>($reg->estado)?
 				' <button class="btn btn-danger" onclick="desactivar('.$reg->id_tipo_gastos.')"><i class="fas fa-times"></i></button>':
 				' <button class="btn btn-success" onclick="activar('.$reg->id_tipo_gastos.')"><i class="fas fa-check"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>