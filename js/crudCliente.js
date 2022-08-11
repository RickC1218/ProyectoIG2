'use strict'
window.addEventListener('load', () => {
    alert ('vinculado js')
    var form = document.querySelector("#formRegistro")
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let formulario = new FormData(form)
        fetch('php/registrar.php', {
                method: 'POST',
                body: formulario
            })
            .then(response => response.text())
            .then(response => {
                if (response == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario registrado!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    form.reset()
                } else {
                    alert('Error al registrar')
                }
            });
    });

    function borrarInfo(id) {
        Swal.fire({
            title: 'Estas seguro?',
            text: "No podras revertirlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borralo!',
            cancelButtonText: 'No, deseo conservarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('php/borrarInfo.php', {
                        method: 'POST',
                        body: id
                    })
                    .then(response => response.text())
                    .then(response => {
                        console.log(response);
                        if (response == 'ok') {
                            listarPromocion()
                            Swal.fire(
                                'Eliminado!',
                                'La promocion ha sido borrada!',
                            )
                        }
                    })
            }
        })
    }



});
