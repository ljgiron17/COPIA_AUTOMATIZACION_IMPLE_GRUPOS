console.log('hola');

const button_enviar = document.getElementById('tipos_recursos');
const formulario_datos = document.getElementById('enviar_Datos');

button_enviar.addEventListener('click', function (e) {
    e.preventDefault();
    const form2 = new FormData(formulario_datos);
    form2.append('tipo_recursos', 1);


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
                    swal(
                        'Exito!',
                        'Los datos han sido agregados!',
                        'success'
                    )
                    $('#modal').modal('toggle');
                    $('#tabla_recursos_tipo').DataTable().ajax.reload();
                    document.getElementById("enviar_Datos").reset();
                } else {

                }
                console.log(data);
            })
    }

})

function eliminar(id) {
    swal({
        title: 'Seguro que quiere eliminar este recurso?',
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
                    $('#tabla_recursos_tipo').DataTable().ajax.reload();
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
        title: 'Seguro que quiere cambiar este recurso?',
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
                    $('#tabla_recursos_tipo').DataTable().ajax.reload();
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
