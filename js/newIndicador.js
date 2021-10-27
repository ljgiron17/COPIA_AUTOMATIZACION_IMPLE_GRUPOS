console.log('indicador');
const formualrio = document.getElementById('enviar_Datos');
const button = document.getElementById('guardar_indicador');

button.addEventListener('click', function (e) {
    e.preventDefault();
    var form2 = new FormData(formualrio);
    form2.append('agregar_tipo_indicador', 1);

    fetch('../Controlador/action.php', {
        method: 'POST',
        body: form2
    })
        .then(respuesta => respuesta.json())
        .then(data => {
            console.log(data);
            if(data== 'exito'){
                swal();
            }
        })

});


function eliminar(id) {
    swal({
        title: 'Seguro que quiere eliminar este Indicador de Gestión Academica?',
        text: "!Este registro no podra ser recuperado!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminarlo!',
        cancelButtonText: 'No, Cancelar!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {

        const form = new FormData();
        form.append('eliminar', 1);
        form.append('id', id);

        fetch('../Controlador/action.php', {
            method: 'POST',
            body: form
        })
            .then(res => res.json())
            .then(data => {
                if (data == 'exito') {
                    swal(
                        'Eliminado!',
                        '!Su registro ha sido eliminado!',
                        'success'
                    )
                    $('#tabla_indicadores_tipo').DataTable().ajax.reload();
                } else {
                    swal(
                        'Error',
                        'A ocurrido un error en la consulta!',
                        'error'
                    )
                }
            })
    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelado',
                'Su registro esta en la base de datos!',
                'error'
            )
        }
    })

}
function cambiarEstado(id, estado) {
    swal({
        title: 'Seguro que quiere cambiar este Indicador de Gestión Academica?',
        text: "!Este registro podra ser cambiado!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Cambiarlo!',
        cancelButtonText: 'No, Cancelar!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {

        const formEstado = new FormData();
        formEstado.append('cambiar_estado', 1);
        formEstado.append('id', id);
        formEstado.append('estado', estado);

        fetch('../Controlador/action.php', {
            method: 'POST',
            body: formEstado
        })
            .then(res => res.json())
            .then(data => {
                if (data == 'exito') {
                    swal(
                        'Cambiado!',
                        '!Su registro ha sido cambiado!',
                        'success'
                    )
                    $('#tabla_indicadores_tipo').DataTable().ajax.reload();
                } else {
                    swal(
                        'Error',
                        'A ocurrido un error en la consulta!',
                        'error'
                    )
                }
            })
    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelado',
                'Su registro sigue intacto!',
                'error'
            )
        }
    })

}
const buttonGuardar = document.getElementById('guardar_indicador');
const formulario_datos = document.getElementById('enviar_Datos');

buttonGuardar.addEventListener('click', function (e) {
    //alert('hola_indicadores');
    e.preventDefault();
    const form2 = new FormData(formulario_datos);
    form2.append('tipo_indicadores', 1);

    if (enviar_Datos.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        enviar_Datos.classList.add('was-validated')
    } else {

        fetch('../Controlador/action.php', {
            method: 'POST',
            body: form2
        }
        )
            .then(res => res.json())
            .then(data => {
                if (data == 'exito') {
                    swal.queue([{
                        title: 'Exito!',
                        confirmButtonText: 'Regresar',
                        text:
                            'Los datos han sido agregados exitosamente',
                        showLoaderOnConfirm: true,
                        preConfirm: function () {
                            location.href = "../vistas/mantenimiento_tipo_indicadores.php";
                        }
                    }]);

                    //     swal(
                    //         'Exito!',
                    //         'Los datos han sido agregados!',
                    //         'success'
                    //     )
                    //     $('#modal').modal('toggle');
                    //     // $('#tabla_recursos_tipo').DataTable().ajax.reload();
                    //     document.getElementById("enviar_Datos").reset();
                    //    // location.href ="../vistas/mantenimiento_tipos_recursos.php";

                } else {

                }
                console.log(data);
            })
    }
});