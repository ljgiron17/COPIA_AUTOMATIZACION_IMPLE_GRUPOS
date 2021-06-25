console.log('jefatura_fila_js')
const archivos_send = document.getElementById('archivos_send');
const Btn_enviar = document.getElementById("enviar_archivos");

//archivos a enviar
const file_ca = document.getElementById("file_ca");
const file_cr = document.getElementById("file_cr");

//**validando el archivo lado del cliente
$("#file_ca").on('change', function () {
    let file_ext = $(this).val().split(".").pop().toLowerCase();//dividiendo la imagen
    let allowed_ext = ["xlsx", "xlsm", "xlsb", "xltx", "xltm", "xls", "xlt", "xls", "xml", "xlam"]; //extension permitida
    let file_size = this.files[0].size;//tamaño de la imagen

    if (allowed_ext.includes(file_ext)) {

        if (file_size <= 4000000) {
            $("#enviar_archivos").prop("disabled", false);
            $("#message_alert").alert('dispose');
        } else {
            $("#message_alert").html(showMEssage('danger', 'El archivo debe ser menor de un 4MB'));
            $("#enviar_archivos").prop("disabled", true);
            $("#message_alert").fadeTo(2000, 500).slideUp(500, function () {
                $("#message_alert").slideUp(500);
            });
        }
    } else {
        $("#message_alert").html(showMEssage('warning', 'Tipo de archivo no soportado! Solamente archivos de excel'));
        $("#enviar_archivos").prop("disabled", true);
        $("#message_alert").fadeTo(2000, 500).slideUp(500, function () {
            $("#message_alert").slideUp(500);
        });
    }
})
//**fin validando el archivo lado del cliente

//**validando el archivo lado del cliente
$("#file_cr").on('change', function () {
    let file_ext = $(this).val().split(".").pop().toLowerCase();//dividiendo la imagen
    let allowed_ext = ["xlsx", "xlsm", "xlsb", "xltx", "xltm", "xls", "xlt", "xls", "xml", "xlam"]; //extension permitida
    let file_size = this.files[0].size;//tamaño de la imagen

    if (allowed_ext.includes(file_ext)) {

        if (file_size <= 4000000) {
            $("#enviar_archivos").prop("disabled", false);
            $("#message_alert2").alert('dispose');
        } else {
            $("#message_alert2").html(showMEssage('danger', 'El archivo debe ser menor de un 4MB'));
            $("#enviar_archivos").prop("disabled", true);
            $("#message_alert2").fadeTo(2000, 500).slideUp(500, function () {
                $("#message_alert2").slideUp(500);
            });
        }
    } else {
        $("#message_alert2").html(showMEssage('warning', 'Tipo de archivo no soportado! Solamente archivos de excel'));
        $("#enviar_archivos").prop("disabled", true);
        $("#message_alert2").fadeTo(2000, 500).slideUp(500, function () {
            $("#message_alert2").slideUp(500);
        });
    }
})
//**fin validando el archivo lado del cliente

function showMEssage(type, message) {
    return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
        <strong>${message}</strong>  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>`
}


Btn_enviar.addEventListener('click', function (e) {
    e.preventDefault();
    var formulario = new FormData(archivos_send);
    formulario.append('add_info', 1);
    formulario.append('file_ca', file_ca.files[0]);
    formulario.append('file_cr', file_cr.files[1]);

    if (archivos_send.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        archivos_send.classList.add('was-validated')
    } else {
        fetch('../Controlador/action.php', {
            method: 'POST',
            body: formulario
        })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data == "exito") {
                    $('#modal').modal('toggle');
                    swal(
                        'Exito!',
                        '¡Datos subidos correctamente!',
                        'success'
                    )
                } else {
                    swal(
                        'Oops...',
                        'Algo salio mal!',
                        'error'
                    )
                }
            });

    }//fin del else

});
