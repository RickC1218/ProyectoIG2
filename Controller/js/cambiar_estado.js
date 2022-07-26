
var reservacion = {
  // Asiento escogido
  toggle: (btn_Butaca) => {
    btn_Butaca.classList.toggle("selected");
  },
  guardar: () => {
    // Recoger los Asientos Seleccionados
    var num_boletos = localStorage.numboletos;
    console.log(num_boletos);
    var seleccionados = document.querySelectorAll(".Butacas .selected");
    console.log(seleccionados.length);
    console.log(seleccionados);

    // Si no se ha escodigo asientos se le envia una alerta al usuario
    if (seleccionados.length == 0) {
      //alert("Por Favor Seleccione sus Asientos");
      Swal.fire({
        icon: 'error',
        title: 'Escoja sus asientos porfavor',
        background: '#041C32',
        color: '#ffff',
        confirmButtonColor: '#ECB365',
        showCloseButton: true,
      });
    }
    if (seleccionados.length > num_boletos) {
      Swal.fire({
        icon: 'error',
        title: 'Escoja unicamente ' + num_boletos + ' asiento(s)',
        background: '#041C32',
        color: '#ffff',
        confirmButtonColor: '#ECB365',
        showCloseButton: true,
      });
    }

    // Se envia al formulario para hacer la reservación de los asientos
    else {
      var reservado = document.getElementById("reservado");
      for (let asiento of seleccionados) {
        let input = document.createElement("input");
        id = asiento.id;
        input.type = "hidden";
        input.name = "asientos[]";
        input.value = id;
        console.log(input);
        reservado.appendChild(input);
        let costo = document.createElement("input");
        costo.type = "hidden";
        costo.name = "costo_entradas";
        costo.value = num_boletos * 5.0;
        reservado.appendChild(costo);
        console.log(costo.value);
      }
      reservado.submit();
    }
  },
};

