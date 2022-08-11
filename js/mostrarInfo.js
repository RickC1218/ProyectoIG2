'use strict'
window.addEventListener('load', () => {
    listarCliente()
    alert('Please wait...')

    function listarCliente() {
        fetch('php/mostrarInfo.php', {
                metod: 'POST'
            })
            .then(respose => respose.text())
            .then(response => {
                contenidoCli.innerHTML = response
                var datosCliente = document.querySelector('#editProfile');
                var historialCliente = document.querySelector('#showRecord');

                var cliente = $('#editarInfo');
                var historial = $('#pedidos');

                var cajaCli = $('.info-perfil');
                var cajaHis = $('.info-pedidos');

                cliente.hide();
                historial.show();
                cajaHis.css("border", "4px solid white").css("margin", "1%").css("border-radius", "15px");

                datosCliente.addEventListener('click', () => {
                    historial.hide();
                    cliente.show();
                    cajaHis.css("border", "").css("margin", "").css("border-radius", "");
                    cajaCli.css("border", "4px solid white").css("margin", "1%").css("border-radius", "15px");
                });

                historialCliente.addEventListener('click', () => {
                    cliente.hide();
                    historial.show();
                    cajaHis.css("border", "4px solid white").css("margin", "1%").css("border-radius", "15px");
                    cajaCli.css("border", "").css("margin", "").css("border-radius", "");
                });
            })
    }

});