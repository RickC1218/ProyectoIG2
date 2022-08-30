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
        })
}