'use strict'

var login = $('#login');
var sesion = localStorage.getItem('sesion');
if (sesion == 'si') {
    login.hide()
} else {
    login.show()
}

function listarPeliculas(id) {
    fetch("../UseCases/listarEstrenos.php", {
            method: "POST",
            body: id
        })
        .then(response => response.text())
        .then(response => {
            listaPeliculas.innerHTML = response;
            var comprar_boletos = document.querySelector('#comprarBoletos');
            comprar_boletos.addEventListener('click', () => {
                if (localStorage.getItem('sesion') === undefined || localStorage.getItem('sesion') != 'no') {
                    Swal.fire({
                        title: '¿Haz iniciado sesión?',
                        background: '#041C3299',
                        color: '#ffff',
                        showCancelButton: true,
                        confirmButtonText: 'No',
                        confirmButtonColor: '#ECB365',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../UI/login.html"
                        } else {
                            window.location.href = "../index.html"
                        }
                    })
                }
            })
        })



}