'use strict'
//Ocultar boton Ingresar si no exite una sesion
var login = $('#login');
var carrito = $('#carritoHeader');
var sesion = localStorage.getItem('sesion');
if (sesion == 'si') {
    login.hide()
    carrito.show()
} else {
    login.show()
    carrito.hide()
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