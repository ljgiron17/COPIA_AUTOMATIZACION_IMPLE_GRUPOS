console.log('indicadores');

const button_indi = document.getElementById('guardar_ind');
const ind_form = document.getElementById('ind_form');
const edit_button = document.getElementById('edit_indicador');
const guardar_responsable = document.getElementById('guardar_responsable');
const agregar_responsables = document.getElementById('agregar_responsables');

button_indi.addEventListener('click', function (e) {

    if (ind_form.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        ind_form.classList.add('was-validated')
    } else {
        const form_send_indi = new FormData(ind_form);
        form_send_indi.append('new_indicador', 1);
        form_send_indi.append('id_objetivo', localStorage.getItem('id_objetivo_send'));
        fetch('../Controlador/action.php', {
            method: 'POST',
            body: form_send_indi
        })
            .then(res => res.json())
            .then(data => {
                //var local = localStorage.getItem('id_objetivo_send')
                //console.log(data + '-' + 'datos:' + local);
                if (data == 'exito') {
                    localStorage.removeItem('datos');
                    actualizardataTable_indicadores();
                }
            })
    }
});

function actualizardataTable_indicadores() {
    const form_update = new FormData();
    form_update.append('get_data_indicador', 1);
    form_update.append('id_obj_send', localStorage.getItem('id_objetivo_send'));

    fetch('../clases/tabla_indicadores.php', {
        method: 'POST',
        body: form_update
    })
        .then(res => res.json())
        .then(datos => {
            //console.log(data);
            clearData();
            localStorage.setItem('datos', JSON.stringify(datos));
            updateTable();
            swal(
                'Exito!',
                '¡Datos subidos correctamente!',
                'success'
            );
            $('.ind_modal').modal('toggle');
            document.getElementById("ind_form").reset();
        })

}

function clearData() {
    var table = $('#tabla_indicadores').DataTable();
    table
        .clear()
        .draw();
}

function updateTable() {
    var retrievedObject = localStorage.getItem('datos');
    const datos_ind = JSON.parse(retrievedObject);
    $('#tabla_indicadores').dataTable().fnClearTable();
    $('#tabla_indicadores').dataTable().fnAddData(datos_ind);
}

//! INICIO EDITAR UN INDICADOR
edit_button.addEventListener('click', function (e) {
    if (ind_form.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        ind_form.classList.add('was-validated')
    } else {
        const form_edit_ind = new FormData(ind_form);
        form_edit_ind.append('edit_indicador', 1);
        fetch('../Controlador/action.php', {
            method: 'POST',
            body: form_edit_ind
        })
            .then(res => res.json())
            .then(data => {
                //console.log(data);
                if (data == 'exito') {
                    localStorage.removeItem('datos');
                    actualizardataTable_indicadores();
                } else {

                }
            })

    }
});

//!FIN EDITAR UN INDICADOR


//!guardar responsables
guardar_responsable.addEventListener('click', function (e) {
    e.preventDefault();
    if (agregar_responsables.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        agregar_responsables.classList.add('was-validated')
    } else {
        const add_responsables = new FormData(agregar_responsables);
        add_responsables.append('add_res', 1)
        fetch('../Controlador/action.php', {
            method: 'POST',
            body: add_responsables
        })
            .then(res => res.json())
            .then(data => {
                //console.log(data);
                if (data == 'exito') {
                    document.getElementById('agregar_responsables').reset();
                    $('#tabla_responsables tbody').empty();
                    actualizr_responsables();
                    $("#mensaje_responsable").html(showMEssage('success', 'Se agrego el registro a la tabla'));
                    $("#mensaje_responsable").fadeTo(2000, 500).slideUp(500, function () {
                        $("#mensaje_responsable").slideUp(500);
                    });
                } else {
                    $("#mensaje_responsable").html(showMEssage('danger', 'Algo ocurrio mal'));
                    $("#mensaje_responsable").fadeTo(2000, 500).slideUp(500, function () {
                        $("#mensaje_responsable").slideUp(500);
                    });
                }
            })
    }
})
//!FIN guardar responsables

function actualizr_responsables() {
    const form_up_res = new FormData();
    form_up_res.append('get_data_res', 1);
    form_up_res.append('id_indicador', localStorage.getItem('id_indicador_res'));
    fetch('../Controlador/action.php', {
        method: 'POST',
        body: form_up_res
    })
        .then(res => res.json())
        .then(r => {
            //console.log(data);
            if (r.length == 0) {
                var tr_body = "<center> <TR><TH COLSPAN='4' style='text-align:center;'>No hay datos</TH></TR></center>";
                $("#tabla_responsables tbody").append(tr_body);
            } else {
                var len = r.length;
                for (var i = 0; i < len; i++) {
                    var descripcion = r[i].id_responsables;
                    var cantidad = r[i].descripcion_responsable;

                    var tr_body = "<tr>" +
                        "<td class='des'>" + descripcion + "</td>" +
                        "<td align='center' class='cant'>" + cantidad + "</td>" +
                        "<td align='center'><button type='button' id='edit_responsable' class='btn btn-success'><i class='fas fa-edit' ></i></button></td>" +
                        "<td align='center'><button type='button' id='delete_responsable' class='btn btn-danger'><i class='fas fa-times' ></i></button></td>"
                    "</tr>";
                    $("#tabla_responsables tbody").append(tr_body);
                }
            }
        })
}


function showMEssage(type, message) {
    return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
        <strong>${message}</strong>  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>`
}

//!boton actividades 
const guardar_actividad = document.getElementById('guardar_actividad');
const agregar_actividades = document.getElementById('agregar_actividades');

guardar_actividad.addEventListener('click', function (e) {
    e.preventDefault();
    if (agregar_actividades.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        agregar_actividades.classList.add('was-validated')
    } else {
        const form_send_actividad = new FormData(agregar_actividades);
        form_send_actividad.append('send_data_act', 1);
        form_send_actividad.append('id_indicador_act', localStorage.getItem('id_indicador_act'));

        fetch('../Controlador/action.php', {
            method: 'POST',
            body: form_send_actividad
        })
            .then(res => res.json())
            .then(data => {
                //console.log(data);
                if (data == 'exito') {
                    $('#tabla_actividades tbody').empty(); //limpiar la tabla despues de cada llamdo
                    update_actividades();
                    $("#mensaje_actividades").html(showMEssage('success', 'Se agrego el registro a la tabla'));
                    $("#mensaje_actividades").fadeTo(2000, 500).slideUp(500, function () {
                        $("#mensaje_actividades").slideUp(500);
                    });
                    document.getElementById('agregar_actividades').reset();
                } else {
                    $("#mensaje_actividades").html(showMEssage('danger', 'Algo ocurrio mal'));
                    $("#mensaje_actividades").fadeTo(2000, 500).slideUp(500, function () {
                        $("#mensaje_actividades").slideUp(500);
                    });

                }
            })
    }
})

function update_actividades() {
    const form_actividades = new FormData();
    form_actividades.append('id_indicador_act', localStorage.getItem('id_indicador_act'));
    form_actividades.append('getdata_Act', 1);

    fetch('../Controlador/action.php', {
        method: 'POST',
        body: form_actividades
    })
        .then(res => res.json())
        .then(r => {
            //console.log(r);
            if (r.length == 0) {
                var tr_body = "<tr> <td align='center' colspan='5'>No hay datos en tabla</td> </tr>";
                $("#tabla_actividades tbody").append(tr_body);
            } else {
                // console.log('si hay data');
                var len = r.length;
                for (var i = 0; i < len; i++) {
                    var id_actividades_poa = r[i].id_actividades_poa;
                    var actividad = r[i].actividad;
                    var id_verificacion = r[i].id_verificacion;
                    var medio_veri = r[i].medio_veri;
                    var pobla_objetivo = r[i].pobla_objetivo;

                    var tr_body = "<tr>" +
                        "<td align='center' class=''>" + id_actividades_poa + "</td>" +
                        "<td align='center' class=''>" + actividad + "</td>" +
                        "<td align='center' class=''>" + id_verificacion + "</td>" +
                        "<td align='center' class=''>" + medio_veri + "</td>" +
                        "<td align='center' class=''>" + pobla_objetivo + "</td>" +
                        "<td align='center'><button type='button' class='btn btn-success btn-sm' id='editar_act' ><i class='fas fa-edit' ></i></button></td>" +
                        "<td align='center'><button type='button' class='btn btn-danger btn-sm' id='eliminar_act' ><i class='fas fa-times' ></i></button></td>"
                    "</tr>";
                    $("#tabla_actividades tbody").append(tr_body);
                }
            }
        })
}
//!fin guardar actividades


//*guardar metas
const save_metas = document.getElementById('guardar_metas');
const form_metas_send = document.getElementById('agregar_metas');


save_metas.addEventListener('click', function (e) {
    e.preventDefault();
    const form_add_metas = new FormData(form_metas_send);
    form_add_metas.append('addNew_meta', 1);
    form_add_metas.append('id_indicador_meta', localStorage.getItem('id_indicador_meta'));
    fetch('../Controlador/action.php', {
        method: 'POST',
        body: form_add_metas
    })
        .then(res => res.json())
        .then(data => {
            //console.log(data);            
            if (data == 'exito') {
                console.log(data);
                $("#mensaje_meta").html(showMEssage('success', '¡Metas han sido agregadas!'));
                $("#mensaje_meta").fadeTo(2000, 500).slideUp(500, function () {
                    $("#mensaje_meta").slideUp(500);
                });
                $('#tabla_metas tbody').empty();
                update_metas();
                document.getElementById('agregar_metas').reset();

            } else if (data == 'cuenta_mayor') {
                $("#mensaje_meta").html(showMEssage('danger', '¡Cantidades ingresadas suman mas de 100%, verifique los campos!'));
                $("#mensaje_meta").fadeTo(2000, 500).slideUp(500, function () {
                    $("#mensaje_meta").slideUp(500);
                });
            } else if (data == 'tiene_datos') {
                $("#mensaje_meta").html(showMEssage('danger', '¡Este indicador ya tiene metas establecidas!'));
                $("#mensaje_meta").fadeTo(2000, 500).slideUp(500, function () {
                    $("#mensaje_meta").slideUp(500);
                });
            } else if (data == 'menor_cuenta') {
                $("#mensaje_meta").html(showMEssage('danger', '¡Sus porcentaje de metas no suma el 100%!'));
                $("#mensaje_meta").fadeTo(2000, 500).slideUp(500, function () {
                    $("#mensaje_meta").slideUp(500);
                });
            }
        })

})


function update_metas() {
    const form_metas = new FormData();
    form_metas.append('getData_metas', 1);
    form_metas.append('id_indicador_meta', localStorage.getItem('id_indicador_meta'));
    fetch('../Controlador/action.php', {
        method: "POST",
        body: form_metas
    })
        .then(res => res.json())
        .then(r => {
            console.log(r);
            if (r.length == 0) {
                var tr_body = "<tr> <td align='center' colspan='7'>No hay datos en tabla</td> </tr>";
                $("#tabla_metas tbody").append(tr_body);
            } else {
                //console.log('si hay data');
                var len = r.length;
                for (var i = 0; i < len; i++) {
                    id_metas
                    var id_metas = r[i].id_metas;
                    var trimestre_1 = r[i].trimestre_1;
                    var trimestre_2 = r[i].trimestre_2;
                    var trimestre_3 = r[i].trimestre_3;
                    var trimestre_4 = r[i].trimestre_4;

                    var tr_body = "<tr>" +
                        "<td align='center' class=''>" + id_metas + "</td>" +
                        "<td align='center' class=''>" + trimestre_1 + "</td>" +
                        "<td align='center' class=''>" + trimestre_2 + "</td>" +
                        "<td align='center' class=''>" + trimestre_3 + "</td>" +
                        "<td align='center' class=''>" + trimestre_4 + "</td>" +
                        "<td align='center'><button type='button' class='btn btn-success btn-sm' id='editar_metas' ><i class='fas fa-edit' ></i></button></td>" +
                                "<td align='center'><button type='button' class='btn btn-danger btn-sm' id='eliminar_meta' ><i class='fas fa-times' ></i></button></td>"
                    "</tr>";
                    $("#tabla_metas tbody").append(tr_body);
                }
            }
        })//final del r
}
//*fin guardar metas


$('#tabla_actividades tbody').on('click', '#eliminar_act', function () {
    //alert('hola');
    var fila = $(this).closest('tr');
    var id_actividad = fila.find('td:eq(0)').text();
    console.log(id_actividad);

    swal({
        title: '¿Seguro que desea borrar este registro?',
        text: "¡No podrá recuperar este registro!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {
        const form_actividad_delete = new FormData();
        form_actividad_delete.append('dele_actividad', 1);
        form_actividad_delete.append('id_actividad', id_actividad)

        fetch('../Controlador/action.php', {
            method: 'POST',
            body: form_actividad_delete
        })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data == 'exito') {
                    $('#tabla_actividades tbody').empty();
                    update_actividades();
                    swal(
                        'Eliminado!',
                        'Su registro se a eliminado',
                        'success'
                    )
                } else {
                    swal(
                        'Alto!',
                        'Algo ocurrio mal.',
                        'error'
                    )
                }
            })
    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelado!',
                'Su registro sigue en la base de datos',
                'info'
            )
        }
    })
});

$('#tabla_metas tbody').on('click', '#eliminar_meta', function () {
    var fila = $(this).closest('tr');
    var id_meta = fila.find('td:eq(0)').text();
    //console.log(id_meta);
    swal({
        title: '¿Seguro que desea borrar este registro?',
        text: "¡No podrá recuperar este registro!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {
        const form_meta_delete = new FormData();
        form_meta_delete.append('dele_meta', 1);
        form_meta_delete.append('id_meta', id_meta)

        fetch('../Controlador/action.php', {
            method: 'POST',
            body: form_meta_delete
        })
            .then(res => res.json())
            .then(data => {
                //console.log(data);
                if (data == 'exito') {
                    $('#tabla_metas tbody').empty();
                    update_metas();
                    swal(
                        'Eliminado!',
                        'Su registro se a eliminado',
                        'success'
                    )
                } else {
                    swal(
                        'Alto!',
                        'Algo ocurrio mal.',
                        'error'
                    )
                }
            })
    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelado!',
                'Su registro sigue en la base de datos',
                'info'
            )
        }
    })
});

