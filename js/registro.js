'use strict'
window.addEventListener('load', () => {
    var form = document.querySelector("#formRegistro")
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let formulario = new FormData(form)
        fetch('../UseCases/registrar.php', {
                method: 'POST',
                body: formulario
            })
            .then(response => response.text())
            .then(response => {
                console.log(response)
                if (response == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario registrado!',
                        text: 'Revisa tu correo electrónico',
                        showConfirmButton: false,
                        background: '#041C3299',
                        color: '#ffff',
                        timer: 1500
                    })
                    form.reset()
                } else {
                    alert('Error al registrar')
                }
            });
    });
});
