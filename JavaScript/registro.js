'use strict'
window.addEventListener('load', () => {

    var form = document.querySelector("#formRegistro")

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        let formulario = new FormData(form)
        fetch('php/registrar.php', {
                method: 'POST',
                body: formulario
            })
            .then(response => response.text())
            .then(response => {
                if (response == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario registrado!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    form.reset()
                } else {
                    console.log('data error: ' + data)
                }
            });
    })




});
