'use strict'

window.addEventListener('load', () => {

    //Ocultar boton Ingresar si no exite una sesion
    var login = $('#login');
    var carrito = $('#carritoHeader');
    var sesion = localStorage.getItem('sesion');
    if (sesion=='si'){
        login.hide()
        carrito.show();
    }else{
        login.show()
        carrito.hide();
    }
    listarPromocion();

    function listarPromocion() {
        fetch('UseCases/listarPromociones.php', {
            method: 'POST'
        })
            .then(response => response.text())
            .then(response => {
                promocion.innerHTML = response
            })
    }
});