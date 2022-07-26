'use strict'
window.addEventListener('load', () => {
    var form = document.querySelector("#formRecuperar")
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let formulario = new FormData(form)
        fetch('../UseCases/recuperar.php', {
                method: 'POST',
                body: formulario
            })
            .then(response => response.text())
            .then(response => {
                if (response == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correo Enviado, verifica tu bandeja de entrada',
                        showConfirmButton: false,
                        background: '#041C3299', 
                        color: '#ffff',
                        timer: 1500
                    })
                    form.reset()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Aún no tienes cuenta',
                        showConfirmButton: false,
                        background: '#041C3299', 
                        color: '#ffff',
                        timer: 1500
                    })
                }
            });
    });
});
