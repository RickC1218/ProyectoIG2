'use strict'
window.addEventListener('load', () => {
    listarCliente();


    function listarCliente() {
        fetch('php/bienvenida.php', {
                metod: 'POST'
            })
            .then(respose => respose.text())
            .then(response => {
                contenidoCli.innerHTML = response
            })
    }


});