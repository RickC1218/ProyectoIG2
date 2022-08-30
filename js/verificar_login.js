'use strict'

window.addEventListener('load', () => {
    var boton_carrito = document.querySelector('#addProdCarrito');
    boton_carrito.addEventListener('click', () => {
        if (localStorage.getItem('sesion') === undefined || localStorage.getItem('sesion')!='no'){
            Swal.fire({
                title: '¿Haz iniciado sesión?',
                background: '#041C3299',
                color: '#ffff',
                showCancelButton: true,
                confirmButtonText: 'No',
                confirmButtonColor: '#ECB365',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../UI/login.html"
                } else {
                    window.location.href = "../index.html"
                }
            })
        }
    })
   
});