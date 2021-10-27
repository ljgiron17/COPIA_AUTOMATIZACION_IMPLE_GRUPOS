var tabla; 

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}


//Función limpiar
function limpiar()
{
	$("#id_tipo_gastos").val("")
	$("#fecha").val("");
	$("#descripcion").val("");
	;
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../Controlador/g_tipo_gastos_controlador.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../Controlador/g_tipo_gastos_controlador.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
              title: datos,
              icon: "success",
              button: "OK",
              }).then(function() {
                        location.href = '../vistas/mantenimiento_tipo_gastos_vista.php';
                    });

	    }

	});
	limpiar();
}

function mostrar(id_tipo_gastos)
{
	$.post("../Controlador/g_tipo_gastos_controlador.php?op=mostrar",{id_tipo_gastos : id_tipo_gastos}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#fecha").val(data.fecha);
		$("#descripcion").val(data.descripcion);
		$("#id_dia_feriado").val(data.id_dia_feriado);
 		

 	})
}

//Función para desactivar registros
function desactivar(id_dia_feriado)
{
	bootbox.confirm("¿Está Seguro de desactivar el Gasto?", function(result){
		if(result)
        {
        	$.post("../Controlador/g_tipo_gastos_controlador.php?op=desactivar", {id_dia_feriado : id_dia_feriado}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(id_dia_feriado)
{
	bootbox.confirm("¿Está Seguro de activar este nuevo Gasto?", function(result){
		if(result)
        {
        	$.post("../Controlador/g_tipo_gastos_controlador.php?op=activar", {id_dia_feriado : id_dia_feriado}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}




init();