'use strict'

function listarPeliculas(id) {
    fetch("../UseCases/listarEstrenos.php", {
        method: "POST",
        body: id
    })
        .then(response => response.text())
        .then(response => {
            listaPeliculas.innerHTML = response;
        })
}