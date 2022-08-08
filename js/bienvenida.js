'use strict'
window.addEventListener('load', () => {
    listarCliente();


    function listarCliente() {
        fetch('php/listar.php', {
                metod: 'POST'
            })
            .then(respose => respose.text())
            .then(response => {
                promocion.innerHTML = response
            })
    }


});