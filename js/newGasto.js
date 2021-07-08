console.log('gatos');
const formualrio = document.getElementById('enviar_Datos');
const button = document.getElementById('guardar_gasto');

button.addEventListener('click', function (e) {
    e.preventDefault();
    var form2 = new FormData(formualrio);
    form2.append('agregar_tipo_gasto', 1);

    fetch('../Controlador/action.php', {
        method: 'POST',
        body: form2
    })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            if(data== 'exito'){
                swal();
            }
        })

});