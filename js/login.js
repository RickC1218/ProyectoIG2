'use strict'
window.addEventListener('load', () => {
    var formulario = document.querySelector("#formLogin")
    formulario.addEventListener("submit", function (e) {
        e.preventDefault();
        let form = new FormData(formulario)
        fetch('../UseCases/login.php', {
                method: 'POST',
                body: form
            })
            .then(response => response.text())
            .then(response => {
                if (response == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    window.location.href = "./usuario.html"
                } else {
                    alert('Error al iniciar sesión')
                }
            });
    });
})




