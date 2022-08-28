let validation = document.getElementById('valida');
let verification = document.getElementById('valida2');
function checkPassword(data) {
    const ps = new RegExp('(^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(([A-Za-z\d$@$!%*?&]|[^ ]){8,15}))');
    if (ps.test(data)) {
        validation.classList.add('valid');
    } else {
        validation.classList.remove('valid');
    }
}
function checkSamePwd() {
    var p1 = document.formRegistro.pswd.value;
    var p2 = document.formRegistro.v_pswd.value;
    console.log(p1);
    console.log(p2);
    if (p1 == p2) {
        verification.classList.add('valid');
    } else {
        verification.classList.remove('valid');
    }
}
