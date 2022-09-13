'use strict'
window.addEventListener('load', () => {

    var logout = document.querySelector('#logout_dashboard');

    logout.addEventListener('click', () => {
        fetch('../../UseCases/logout.php', {
            method: 'POST'
        })
        .then(response => response.text())
        .then(response => {
            if (response == 'ok') {
                Swal.fire({
                    title: 'Sesión Cerrada',
                    background: '#041C3299',
                    color: '#ffff',
                    confirmButtonText: 'OK!',
                    confirmButtonColor: '#ECB365',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../../index.html"
                    }
                })
            }
        });
    })

    
})


