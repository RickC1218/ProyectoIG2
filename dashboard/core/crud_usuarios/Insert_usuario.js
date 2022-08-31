
// Inicio Crud Usuarios

var $Ci_Cli = document.querySelector("#Ci_Cli"),
    $Nombre_Cli = document.querySelector("#Nombre_Cli"),
    $Apellidos_Cli = document.querySelector("#Apellidos_Cli"),
    $Fecha_Cli = document.querySelector("#Fecha_Cli"),
    $email_Cli = document.querySelector("#email_Cli"),
    $pass_Cli = document.querySelector("#pass_Cli"),
    $GuardarUser = document.querySelector("#Guardar_Usuario");

$GuardarUser.onclick = async () => {
    var Ci_Cli = $Ci_Cli.value,
        Nombre_Cli = $Nombre_Cli.value,
        Apellidos_Cli = $Apellidos_Cli.value,
        Fecha_Cli = $Fecha_Cli.value,
        email_Cli = $email_Cli.value,
        pass_Cli = $pass_Cli.value;
    
    if (!Ci_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el Ci",
            timer: 700, 
        });
    }
    if (!Nombre_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el nombre del cliente",
            timer: 700, 
        });
    }
    if (!Apellidos_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el apellido del cliente",
            timer: 700, 
        });
    }
    if (!Fecha_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la fecha de nacimiento",
            timer: 700, 
        });
    }
    if (!email_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el email",
            timer: 700, 
        });
    }
    if (!pass_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la contraseña",
            timer: 700, 
        });
    }
    

    var cargaUtil = {
        Ci_Cli,
        Nombre_Cli,
        Apellidos_Cli,
        Fecha_Cli,
        email_Cli,
        pass_Cli
    };

    var cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("../core/crud_usuarios/Insert_usuario.php", {
            method:"POST",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "Usuario Guardado",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $Ci_Cli.value = $Nombre_Cli.value = $Apellidos_Cli.value = $Fecha_Cli.value= $email_Cli = $pass_Cli = "";

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