console.log('hola');

const button_denegar = document.getElementById('solictud_denegar');
const form_solictiud = document.getElementById('form_solictiud');
const button_aceptar = document.getElementById('aceptar_solicitud');


button_denegar.addEventListener('click', function (e) {
    //alert('denegada');
    const form_denegada = new FormData(form_solictiud);
    form_denegada.append('denegada', 1);

    swal({
        title: '¿Desea denegar la solicitud?',
        text: "¡Se cancelara la solicitud de la persona seleccionada!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Denegar!',
        cancelButtonText: '¡No, cancelar!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {
        $('#modal').modal('toggle');
        swal({
            title: '¿Razón por al cual se niega la petición?',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            showLoaderOnConfirm: true,
            preConfirm: function (text) {
                return new Promise(function (resolve, reject) {
                    setTimeout(function () {
                        if (text === '') {
                            reject('No puede enviar el campo vacio')
                        } else {
                            resolve()
                        }
                    }, 2000)
                })
            },
            allowOutsideClick: false
        }).then(function (text) {
            // swal({
            //     type: 'success',
            //     title: 'Ajax request finished!',
            //     html: 'Submitted email: ' + text
            // })
            form_denegada.append('razon_negada', text);
            fetch('../Controlador/action.php', {
                method: 'POST',
                body: form_denegada
            })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data == 'exito') {
                        swal(
                            'Listo!',
                            'La revisión fue realizada con exito!',
                            'success'
                        )
                        //$('#modal').modal('toggle');
                        $('#tabla_solicitud').DataTable().ajax.reload();
                    } else {
                        swal(
                            '¡Error!',
                            '¡Algo ha salido mal!',
                            'error'
                        )
                    }
                });
        })

        //!fin del fetch


    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal(
                '¡Cancelado!',
                '¡Se ha cancelado el proceso!',
                'error'
            )
        }
    })
});
//!accion denegada


button_aceptar.addEventListener('click', function (e) {
    //alert('denegada');
    const form_aceptada = new FormData(form_solictiud);
    form_aceptada.append('aceptada', 1);

    swal({
        title: '¿Desea aceptar la solicitud?',
        text: "¡Se aceptará la solicitud de la persona seleccionada!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Aceptar!',
        cancelButtonText: '¡No, cancelar!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {
        // swal(
        //     'Deleted!',
        //     'Your file has been deleted.',
        //     'success'
        // )
        fetch('../Controlador/action.php', {
            method: 'POST',
            body: form_aceptada
        })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data == 'exito') {
                    swal(
                        'Listo!',
                        'La revisión fue realizada con exito!',
                        'success'
                    )
                    $('#modal').modal('toggle');
                    $('#tabla_solicitud').DataTable().ajax.reload();
                    // $('#tabla_craed').DataTable().ajax.reload();
                } else {
                    swal(
                        '¡Error!',
                        '¡Algo ha salido mal!',
                        'error'
                    )
                }
            });

    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal(
                '¡Cancelado!',
                '¡Se ha cancelado el proceso!',
                'error'
            )
        }
    })
});
//?accion aceptada