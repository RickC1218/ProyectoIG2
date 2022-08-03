'use strict'
window.addEventListener('load', () => {
    var mostrar = $("#modificar");
    mostrar.hide();
    var modificar = document.querySelector("#modif-promo")
    var form = document.querySelector("#modificar")

    modificar.addEventListener("click", function () {
        if (mostrar.is(":hidden")) {
            mostrar.show();
        } else {
            mostrar.hide();
        }
    })

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        let formulario = new FormData(form)
        fetch('php/registrar.php', {
                method: 'POST',
                body: formulario
        })
        .then(res =>{
            return res.json()
        })
        .then(data => {
            if (data == 'true') {
                document.getElementById('idPromo').value = ''
                document.getElementById('tipo-Promocion').value = ''
                document.getElementById('Desc-Promocion').value = ''
                document.getElementById('img-Promocion').value = ''
                alert('Information sent successfully.')
            } else {
                console.log('data error: ' + data)
            }
        });
    })
});