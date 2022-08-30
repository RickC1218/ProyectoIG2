'use strict'

window.addEventListener('load', () => {

    //Ocultar boton Ingresar si no exite una sesion
    var login = $('#login');
    var sesion = localStorage.getItem('sesion');
    if (sesion=='si'){
        login.hide()
    }else{
        login.show()
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