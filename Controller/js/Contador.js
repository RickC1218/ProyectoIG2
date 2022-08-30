let numbers = document.getElementById('box');
for(i=0; i<100; i++){
    var span = document.createElement('span')
    span.textContent = i;
    numbers.appendChild(span);
}
let num = numbers.getElementsByTagName('span');
let index = 0;



function nextNum(){
    num[index].style.display = "none";
    num[index].id = "non-active";
    index = (index + 1) % num.length;
    num[index].style.display = "initial";
    num[index].id = "active";
    CalcularPrecio (index);
}
function prevNum(){
    num[index].style.display = "none";
    num[index].id = "non-active";
    index = (index - 1 + num.length) % num.length;
    num[index].style.display = "initial";
    num[index].id = "active";
    CalcularPrecio (index);
}
function CalcularPrecio(num_boletos){
    var numboletos = num_boletos;
    var precio = numboletos*5.0;
    localStorage.setItem("numboletos",numboletos);
    localStorage.setItem("Precio",precio);
    console.log(precio);
}
console.log(index);
