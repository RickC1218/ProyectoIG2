//NO VALEEEEEEEEEEEEEe AAAAAAAAAAH
'use strict'
window.addEventListener('load', () => {
    showLogOut()

    function showLogOut() {
        fetch('php/mostrarInfo.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(response => {
                if (response == "NO") {
                    
                }
            })
    }
});