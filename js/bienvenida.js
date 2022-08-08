'use strict'
window.addEventListener('load', () => {
    listarCliente()
    alert('Please wait...')

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