console.log('objetivos');
const button_objetivo = document.getElementById('guardar_objetivo');
const form_objetivo = document.getElementById('obj_form');
var id_planifica = localStorage.getItem('id_planifi');
const button_edit = document.getElementById('edicion_obj');

//?CREACION DE UN NUEVO OBJETIVO
button_objetivo.addEventListener('click', function (e) {
    if (obj_form.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        obj_form.classList.add('was-validated')
    } else {
        const formulario_obj = new FormData(form_objetivo);
        formulario_obj.append('crear_obj', 1);
        formulario_obj.append('id_plani', id_planifica)
        fetch('../Controlador/action.php', {
            method: 'POST',
            body: formulario_obj
        })
            .then(res => res.json())
            .then(data => {
                //console.log(data);
                if (data == 'exito') {
                    localStorage.removeItem('data');
                    actualizardataTable();
                    $('.obj_modal').modal('toggle');
                    // $('#tabla_objetivos').DataTable().ajax.reload();
                    // swal(
                    //     'Exito!',
                    //     '¡Datos subidos correctamente!',
                    //     'success'
                    // )
                    document.getElementById("form_objetivo").reset();
                } else {
                    swal(
                        'Oops...',
                        'algo ocurrio mal!',
                        'error'
                    )
                }
            })
    }

});

function actualizardataTable() {
    const form_update = new FormData();
    form_update.append('datos_plani', 1);
    form_update.append('id_plani', id_planifica);

    fetch('../clases/tabla_objetivos.php', {
        method: 'POST',
        body: form_update
    })
        .then(res => res.json())
        .then(data => {
            //console.log(data);
            clearData();
            localStorage.setItem('data', JSON.stringify(data));
            updateTable();
            swal(
                'Exito!',
                '¡Datos subidos correctamente!',
                'success'
            );
            $('.obj_modal').modal('toggle');
            document.getElementById("form_objetivo").reset();
        })

}
function clearData() {
    var table = $('#tabla_objetivos').DataTable();
    table
        .clear()
        .draw();
}
function updateTable() {
    var retrievedObject = localStorage.getItem('data');
    const data = JSON.parse(retrievedObject);
    $('#tabla_objetivos').dataTable().fnClearTable();
    $('#tabla_objetivos').dataTable().fnAddData(data);
}

//?EDICION DE UN OBJETIVOS
button_edit.addEventListener('click', function (e) {
    if (obj_form.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        obj_form.classList.add('was-validated')
    } else {
        const form_edit_obj = new FormData(form_objetivo);
        form_edit_obj.append('edicion_obj_edit', 1);

        fetch('../Controlador/action.php', {
            method: 'POST',
            body: form_edit_obj
        })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data == 'exito') {
                    localStorage.removeItem('data');
                    actualizardataTable();
                    $('.obj_modal').modal('toggle');
                } else {
                    swal(
                        'Oops!',
                        '¡Algo ah salido mal!',
                        'error'
                    );
                }
            })
        }
});

//?FIN EDICION DE UN OBJETIVO