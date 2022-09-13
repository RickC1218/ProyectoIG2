var $N_Aforo = document.querySelector("#N_Aforo"),
    $N_Estado_Sala = document.querySelector("#N_Estado_Sala"),
    $EditarSala = document.querySelector("#Editar_Sala"),
    $Id_sala;

// Una global para establecerla al rellenar el formulario y leerla al enviarlo


async function rellenarFormulario (Idsala) {

    const respuestaRaw = await fetch("../core/crud_Salas/obtener_sala_id.php?id=" + Idsala);
    const Sala = await respuestaRaw.json();
    // Rellenar formulario
    $N_Aforo.value = Sala.TOTALASIENTOS_SALA;
    $N_Estado_Sala.value = Sala.ESTADO_SALA;
    $Id_sala = Idsala;
    
};




$EditarSala.onclick = async () => {
    const N_Aforo = $N_Aforo.value,
    N_Estado_Sala = $N_Estado_Sala.value,
    Id_Sala = $Id_sala;

    if (!N_Aforo) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el Aforo",
            timer: 700, 
        });
    }
    if (!N_Estado_Sala) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el Estado de la sala",
            timer: 700, 
        });
    }

    const cargaUtil = {
        N_Aforo,
        N_Estado_Sala,
        Id_Sala
    };

    const cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("../core/crud_Salas/Update_sala.php", {
            method:"PUT",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "sala Actualizado",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $N_Aforo.value = $N_Estado_Sala.value ="";

            window.location.reload();
        } else {
            Swal.fire({
                icon: "error",
                text: "El servidor no envió una respuesta exitosa "+respuesta,
            });
        }
    } catch (e) {
        // En caso de que haya un error
        Swal.fire({
            icon: "error",
            title: "Error de servidor",
            text: "Inténtalo de nuevo. El error es: " + e,
        });
    }

   // Fin Crud Pelicula 
};