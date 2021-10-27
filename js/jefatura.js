console.log('jefatura_fila_js')
const archivos_send = document.getElementById('archivos_send');
const Btn_enviar = document.getElementById("enviar_archivos");

//archivos a enviar
const file_ca = document.getElementById("file_ca");
const file_cr = document.getElementById("file_cr");


//!envio de datos del formulario
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
                    // var tabla = $('#tabla').dataTable();
                    // tabla.api().ajax.reload();
                    // var tabla_craed = $('#tabla_craed').dataTable();
                    // tabla_craed.api().ajax.reload();

                    // var tabla_academica = $('#tabla_academica').dataTable();
                    // tabla_academica.api().ajax.reload();
                    $('#tabla_academica').DataTable().ajax.reload();
                    $('#tabla_craed').DataTable().ajax.reload();
                } else if (data == "cr_incorrecto") {
                    swal(
                        'Oops...',
                        'Archivo de coordinacion académica no es el correcto!',
                        'error'
                    )
                } else if (data == "cread_invalido") {
                    swal(
                        'Oops...',
                        'Archivo de coordinacion CREAD no es el correcto!',
                        'error'
                    )
                } 
            });

    }//fin del else

});

//!Fin envio de datos del formulario




function myFunction1(){                    
    var a = document.getElementById("descrip_cr");
    a.value = a.value.toUpperCase();
    }
    /*==============================================
    =     VALIDACION SOLO LETRAS            =
    ==============================================*/
    function sololetras(e){
        
        key=e.keyCode || e.wich;
    
        teclado= String.fromCharCode(key).toUpperCase();
    
        letras= " ABCDEFGHIJKLMNOPQRSTUVWXYZÑ";
        
        especiales ="8-37-38-46-164";
    
        teclado_especial=false;
    
        for (var i in especiales) {
          
          if(key==especiales[i]){
            teclado_especial= true;break;
          }
        }
    
        if (letras.indexOf(teclado)==-1 && !teclado_especial) {
          return false;
        }
    
    }
    /*=====  FIN DE LA FUNCION  ======*/
    
    /*==============================================
    =        VALIDACION SOLO NUMEROS           =
    ==============================================*/
    function solonumeros(e){
        
        key=e.keyCode || e.wich;
    
        teclado= String.fromCharCode(key).toUpperCase();
    
        letras= "1234567890";
        
        especiales ="8-37-38-46-164";
    
        teclado_especial=false;
    
        for (var i in especiales) {
          
          if(key==especiales[i]){
            teclado_especial= true;break;
          }
        }
    
        if (letras.indexOf(teclado)==-1 && !teclado_especial) {
          return false;
        }
    
    }
    /*=====  FIN DE LA FUNCION  ======*/

    /*=============================================
    =    VALIDAION QUE SOLO PERMITA UN ESPACIO          =
    =============================================*/
    
    
    function validate(s){
        if (/^(\w+\s?)*\s*$/.test(s)){
          return s.replace(/\s+$/,  '');
        }
        return 'NOT ALLOWED';
        }
        
        validate('tes ting')      //'test ing'
        validate('testing')       //'testing'
        validate(' testing')      //'NOT ALLOWED'
        validate('testing ')      //'testing'
        validate('testing  ')     //'testing'
        validate('testing   ')   

    /*=====  FIN DE LA FUNCION  ======*/

    //FUNCION NO DEJA ESCRIBIR 3 LETRAS IGUEALES
    function MismaLetra(id_input) {
	    var valor = $('#' + id_input).val();
	    var longitud = valor.length;
	    //console.log(valor+longitud);
	    if (longitud > 2) {
		    var str1 = valor.substring(longitud - 3, longitud - 2);
		    var str2 = valor.substring(longitud - 2, longitud - 1);
		    var str3 = valor.substring(longitud - 1, longitud);
		    nuevo_valor = valor.substring(0, longitud - 1);
		    if (str1 == str2 && str1 == str3 && str2 == str3) {
			    swal('Error', 'No se permiten 3 letras consecutivamente', 'error');

			    $('#' + id_input).val(nuevo_valor);
		    }
	    }
    }
    function letrasynumeros(e){
        
        key=e.keyCode || e.wich;
    
        teclado= String.fromCharCode(key).toUpperCase();
    
        letras= "ABCDEFGHIJKLMNOPQRSTUVWXYZÑ1234567890";
        
        especiales ="8-37-38-46-164";
    
        teclado_especial=false;
    
        for (var i in especiales) {
          
          if(key==especiales[i]){
            teclado_especial= true;break;
          }
        }
    
        if (letras.indexOf(teclado)==-1 && !teclado_especial) {
          return false;
        }
    
    }
