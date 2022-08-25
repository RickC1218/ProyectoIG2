'use strict'

var idClickDulceria;
var items = 0;
var cantidad;

function getId(idClick) {
    idClickDulceria = idClick;
    localStorage.setItem("idClickDulceria", idClickDulceria);
}

function opcionTabs() {
    var id = localStorage.getItem("idClickDulceria");
    var elemento;
    var activeTab;

    switch (id) {
        case 'combos': {
            console.log(id);
            elemento = document.getElementById("combosTab");
            elemento.classList.add('active');
            activeTab = document.getElementById("combos");
            activeTab.style.display = 'block';
            break;
        }
        case 'bebidas': {
            console.log(id);
            elemento = document.getElementById("bebidasTab");
            elemento.classList.add('active');
            activeTab = document.getElementById("bebidas");
            activeTab.style.display = "block";
            break;
        }
        case 'snacks': {
            console.log(id);
            elemento = document.getElementById("snacksTab");
            elemento.classList.add('active');
            activeTab = document.getElementById("snacks");
            activeTab.style.display = "block";
            break;
        }
        case 'dulces': {
            console.log(id);
            elemento = document.getElementById("dulcesTab");
            elemento.classList.add('active');
            activeTab = document.getElementById("dulces");
            activeTab.style.display = "block";
            break;
        }
    }
}

function openTab(idTab) {
    var i;
    var x = document.getElementsByClassName("tab-pane");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(idTab).style.display = "block";
    localStorage.setItem("idClickDulceria", idTab);
}


/*Funciones para aumentar y disminuir número de productos a comprar*/
function aumentarItem() {
    items++;
    cantidad.textContent = items;
    getTotalPagar();
}

function disminuirItem() {
    if (items > 0) items--;
    cantidad.textContent = items;
    getTotalPagar();
}

/*
Función encargada de colocar en cero la cantidad de 
cada producto en el caso que se abra un nuevo Popup.
*/
function setItemCantidad() {
    cantidad = document.getElementById("cantidad");
    cantidad.textContent = 0;
    items = 0;
}

// ver total en funcion de la cantidad adquiridad
function getTotalPagar() {
    var precioTotal = items * parseFloat(localStorage.getItem('precio_C_S'));
    precioTotal = Math.round((precioTotal + Number.EPSILON) * 100) / 100;
    document.getElementById("precioPopup").textContent = '$ ' + precioTotal;
}

// colocar precio dentro de Popup
function setPrecioPopup() {
    document.getElementById("precioPopup").textContent = '$ 0';
}

// cambiar background del boton (botones Popup) en caso de ser seleccionado
function botonClick(id) {
    var element = document.getElementById(id);
    if ($('#' + id).css('background-color') == 'rgb(236, 179, 101)') {
        element.style.backgroundColor = '#064663';
    } else {
        element.style.backgroundColor = '#ECB365';
    }
}

/*
Función encargada de devolver el ID del botón que posea un color RGB (236, 179, 101), 
este color hace énfasis a que el botón esta elegido y se almacenan los IDs en el LocalStorage.
*/
function getID_boton() {
    var array_id = [];
    var aux_id;

    var botones = document.getElementsByClassName('botonPopup');

    // verificar que el arreglo de botones es diferente de cero
    if (botones.length != 0) {
        for (var i = 0; i < botones.length; i++) {
            if ($('#' + botones[i].id).css('background-color') == 'rgb(236, 179, 101)') { // verificar si se dio click en el boton
                aux_id = parseInt(botones[i].id.split('botonPopup_')[1]);
                array_id.push(aux_id);
                localStorage.setItem("array_ids", JSON.stringify(array_id));
            }
        }
    } else {
        localStorage.setItem("array_ids", 0); // condicion para verificar si el snack elegido posee subtipos de snacks
    }
}