
// Inicio Crud Usuarios

var $Aforo = document.querySelector("#Aforo"),
    $Estado_Sala = document.querySelector("#Estado_Sala"),
    $GuardarSala = document.querySelector("#Guardar_Sala");

$GuardarSala.onclick = async () => {
    var Aforo = $Aforo.value,
        Estado_Sala= $Estado_Sala.value;
    
    if (!Aforo) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el Aforo",
            timer: 700, 
        });
    }
    if (!Estado_Sala) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el Estado de la sala",
            timer: 700, 
        });
    }
    

    var cargaUtil = {
        Aforo,
        Estado_Sala
    };

    var cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("../core/crud_Salas/Insert_sala.php", {
            method:"POST",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "Sala Guardado",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $Aforo.value = $Estado_Sala.value = "";

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