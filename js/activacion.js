'use strict'
window.addEventListener('load', () => {
        fetch('php/activacion.php', {
            
            })
            .then(response => response.text())
            .then(response => {
                console.log(response)
            });

})




