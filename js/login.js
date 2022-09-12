'use strict'
window.addEventListener('load', () => {
    var formulario = document.querySelector("#formLogin")
    formulario.addEventListener("submit", function (e) {
        e.preventDefault();
        let form = new FormData(formulario)
        let usuario = document.getElementById('email').value;
        console.log(usuario)

        if (usuario === "admin@admin") {
            fetch('../UseCases/login.php', {
                method: 'POST',
                body: form
            })
                .then(response => response.text())
                .then(response => {
                    console.log(response)
                    if (response == 'ok') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Bienvenido!',
                            background: '#041C3299',
                            color: '#ffff',
                            confirmButtonColor: '#ECB365',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.location.href = "../dashboard/index.php"
                    } else {
                        alert('Error al iniciar sesión')
                    }
                });
        } else {
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
                            background: '#041C3299',
                            color: '#ffff',
                            confirmButtonColor: '#ECB365',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        localStorage.setItem('sesion', 'si');
                        window.location.href = "./usuario.html"
                    } else {
                        alert('Error al iniciar sesión')
                    }
                });
        }
    });
})




