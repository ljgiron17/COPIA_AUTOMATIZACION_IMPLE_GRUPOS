<?php
ob_start();
session_start();
require_once('../clases/Conexion.php');
require_once('../vistas/pagina_inicio_vista.php');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body onload="cargar_detalle_recurso();">

    <div class="content-wrapper">
        <br><br>
        <div class="card">
            <div class="card-body">
                <div class="col-sm-6">
                    <h3>AGREGAR NUEVOS DETALLES DE RECURSOS OPERATIVOS</h3>
                </div>
                <hr>
                <div class="col-sm-6">
                    <div class="card card-default">
                        <!--inciio primer card -->
                        <div class="card-header" style="background-color: #ced2d7;">
                            <h3 class="card-title"><strong>RECURSOS OPERATIVOS</strong> </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="form_detalles_r">
                                <label for="">SELECCIONE EL TIPO DE RECURSO</label>
                                <select name="" id="tipos_recursos" class="form-control">
                                </select>
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" id="nombre_detalle_r" name="nombre_detalle_r" required>
                                <label for="">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad_detalle" name="cantidad_detalle" required>
                                <label for="">Precio</label>
                                <input type="number" step=".01" class="form-control" id="precio_detalle" name="precio_detalle" required>
                                <label for="">Descripcion</label>
                                <input type="text" class="form-control" id="descp_detalle" name="descp_detalle" required>
                                <br>
                                <button class="btn btn-primary" id="guardar_detalles_recursos">Guardar</button>
                            </form>
                        </div><!-- fin del card body -->
                    </div><!-- fin primer card -->
                </div>


            </div>
        </div>
    </div>
</body>

</html>

<script>
    function cargar_detalle_recurso() {
        const form_recursos_tipo = new FormData();
        form_recursos_tipo.append('getDataRecursos', 1);
        fetch('../Controlador/action.php', {
                method: 'POST',
                body: form_recursos_tipo
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                let res = document.querySelector("#tipos_recursos");
                res.innerHTML = '';
                for (let item of data) {
                    res.innerHTML += `<option value="${item.id_recurso_tipo}">${item.nombre_recurso}</option>`
                }
            })
    }


    const button_guardar = document.getElementById('guardar_detalles_recursos');
    const formulario_detalles = document.getElementById('form_detalles_r');

    button_guardar.addEventListener('click', function(e) {
        e.preventDefault();

        if (form_detalles_r.checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
            form_detalles_r.classList.add('was-validated')
        } else {
            var select_id = $('#tipos_recursos').val();
            const formulario_add_detalle_r = new FormData(formulario_detalles);
            formulario_add_detalle_r.append('addData_r_detalle', 1);
            formulario_add_detalle_r.append('valor_select', select_id)
            fetch('../Controlador/action.php', {
                    method: 'POST',
                    body: formulario_add_detalle_r
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data == 'exito') {
                        swal({
                            title: '¡Dato Agregado!',
                            type: 'success',
                            html: '¿Desea agregar mas datos?',
                            showCloseButton: true,
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonText: '<a href="../vistas/g_detalle_recursos.php" style="color:white;">No, Regresar </a>  !',
                            //confirmButtonAriaLabel: 'Thumbs up, great!',
                            cancelButtonText: '<i class="fa fa-thumbs-up"></i> Si, quedarse!',
                            cancelButtonAriaLabel: 'Thumbs up, great!',
                        })
                    } else {
                        swal(
                            'Oops...',
                            'Something went wrong!',
                            'error'
                        )
                    }
                })
        }
    });
</script>