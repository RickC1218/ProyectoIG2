let minuscula = document.getElementById('minuscula');
let mayuscula = document.getElementById('mayuscula');
let numero = document.getElementById('numero');
let caracter = document.getElementById('caracter');
let tamanio = document.getElementById('tamanio');

let verification = document.getElementById('valida2');

function checkPassword(data) {
    const min = new RegExp('(?=.*[a-z])');
    const may = new RegExp('(?=.*[A-Z])');
    const num = new RegExp('(?=.*[0-9])');
    const car = new RegExp('(?=.*[!@#\$%\^&\*])');
    const tam = new RegExp('(?=.{8,15})');

    //tamaño de la contraseña
    if (tam.test(data)) {
        tamanio.classList.add('valid');
    } else {
        tamanio.classList.remove('valid');
    }

    //verificar minúsculas
    if (min.test(data)) {
        minuscula.classList.add('valid');
    } else {
        minuscula.classList.remove('valid');
    }

    //verificar mayusculas
    if (may.test(data)) {
        mayuscula.classList.add('valid');
    } else {
        mayuscula.classList.remove('valid');
    }

    //Verificar número
    if (num.test(data)) {
        numero.classList.add('valid');
    } else {
        numero.classList.remove('valid');
    }

    //Verificar caracter
    if (car.test(data)) {
        caracter.classList.add('valid');
    } else {
        caracter.classList.remove('valid');
    }
}
function checkSamePwd() {
    var p1 = document.formRegistro.pswd.value;
    var p2 = document.formRegistro.v_pswd.value;
    if (p1 == p2) {
        verification.classList.add('valid');
    } else {
        verification.classList.remove('valid');
    }
}
