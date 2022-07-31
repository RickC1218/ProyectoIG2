'use strict'
window.addEventListener('load', () => {
    let mostrar = $("#modificar");
    mostrar.hide();
    var modificar = document.querySelector("#modif-promo")

    modificar.addEventListener("click",function(){
        if (mostrar.is(":hidden")){
            mostrar.show();
        }else{
            mostrar.hide();
        }
    })
});