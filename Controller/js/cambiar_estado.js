
var reservacion = {
  // Asiento escogido
  toggle: (btn_Butaca) => {
    btn_Butaca.classList.toggle("selected");
  },
  guardar: () => {
    // Recoger los Asientos Seleccionados
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
    if (seleccionados.length > num_asientos){
      Swal.fire({
        icon: 'error',
        title: 'Escoja unicamente'+ num_asientos + 'asientos',
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
      }
      reservado.submit();
    }
  },
};
