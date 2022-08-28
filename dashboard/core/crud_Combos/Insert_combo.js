
// Inicio Crud Combos

var $Nombre_Combo = document.querySelector("#Nombre_Combo"),
    $Descripcion_Combo = document.querySelector("#Descripcion_Combo"),
    $Precio_Combo = document.querySelector("#Precio_Combo"),
    $Banner_Combo = document.querySelector("#Banner_Combo"),
    $GuardarCombo = document.querySelector("#Guardar_Combo");

$GuardarCombo.onclick = async () => {
    var Nombre_Combo = $Nombre_Combo.value,
        Descripcion_Combo = $Descripcion_Combo.value,
        Precio_Combo = $Precio_Combo.value,
        Banner_Combo = $Banner_Combo.value;
    
    if (!Nombre_Combo) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el nombre del combo",
            timer: 700, 
        });
    }
    if (!Descripcion_Combo) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la descripción",
            timer: 700, 
        });
    }
    if (!Precio_Combo) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la descripción",
            timer: 700, 
        });
    }
    if (!Banner_Combo) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el precio",
            timer: 700, 
        });
    }
    

    var cargaUtil = {
        Nombre_Combo,
        Descripcion_Combo,
        Precio_Combo,
        Banner_Combo
    };

    var cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("/ProyectoIG2/dashboard/core/crud_Combos/Insert_combo.php", {
            method:"POST",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "Combo Guardado",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $Descripcion_Combo.value = $Nombre_Combo.value = $Banner_Combo.value = $Precio_Combo.value= "";

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