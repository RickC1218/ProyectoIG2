'use strict'
window.addEventListener('load', () => {
    listarCliente()

    function listarCliente() {
        fetch('../UseCases/mostrarInfo.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(response => {
                if (response != "NO") {
                    contenidoCli.innerHTML = response
                    var form = document.querySelector("#formMostrarCli")
                    form.addEventListener("submit", function (e) {
                        e.preventDefault();
                    })

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

                    var logout = document.querySelector('#logout');

                    logout.addEventListener('click', () => {
                        fetch('../UseCases/logout.php', {
                            method: 'POST'
                        })
                        .then(response => response.text())
                        .then(response => {
                            if (response == 'ok') {
                                Swal.fire({
                                    title: 'Sesion Cerrada',
                                    confirmButtonText: 'OK!',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "../index.html"
                                    }
                                })
                            }
                        });
                    })
                }else{
                    Swal.fire({
                        title: 'Haz iniciado sesion?',
                        showCancelButton: true,
                        confirmButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../UI/login.html"
                        } else {
                            window.location.href = "../index.html"
                        }
                    })
                }
            })
    }

});