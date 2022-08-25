'use strict'

window.addEventListener('load', () => {
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