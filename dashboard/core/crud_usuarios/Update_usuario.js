var $N_Nombre_Cli = document.querySelector("#N_Nombre_Cli"),
    $N_Apellidos_Cli = document.querySelector("#N_Apellidos_Cli"),
    $N_Fecha_Cli = document.querySelector("#N_Fecha_Cli"),
    $N_email_Cli = document.querySelector("#N_email_Cli"),
    $N_pass_Cli = document.querySelector("#N_pass_Cli"),
    $N_EditarUser = document.querySelector("#Editar_Usuario"),
    $N_Ci_Cli = document.querySelector("#N_Ci_Cli"),
    $N_Ci;

// Una global para establecerla al rellenar el formulario y leerla al enviarlo


async function rellenarFormulario (CiUser) {

    const respuestaRaw = await fetch("../core/crud_usuarios/obtener_usuario_id.php?id=" + CiUser);
    const User = await respuestaRaw.json();
    // Rellenar formulario
    $N_Nombre_Cli.value = User.NOMBRE_CLI;
    $N_Apellidos_Cli.value = User.APELLIDO_CLI;
    $N_Fecha_Cli.value = User.FECHANACIMIENTO_CLI;
    $N_email_Cli.value = User.EMAIL_CLI;
    $N_pass_Cli.value = User.CONTRASENA_CLI;
    $N_Ci_Cli.value = User.NUMCED_CLI;
    $N_Ci = CiUser;
    
};




$N_EditarUser.onclick = async () => {
    const N_Nombre_Cli = $N_Nombre_Cli.value,
    N_Apellidos_Cli = $N_Apellidos_Cli.value,
    N_Fecha_Cli = $N_Fecha_Cli.value,
    N_email_Cli = $N_email_Cli.value,
    N_pass_Cli = $N_pass_Cli.value,
    N_Ci_Cli = $N_Ci;

        if (!N_Nombre_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el nombre del cliente",
            timer: 700, 
        });
    }
    if (!N_Apellidos_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el apellido del cliente",
            timer: 700, 
        });
    }
    if (!N_Fecha_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la fecha de nacimiento",
            timer: 700, 
        });
    }
    if (!N_email_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el email",
            timer: 700, 
        });
    }
    if (!N_pass_Cli) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la contraseña",
            timer: 700, 
        });
    }

    const cargaUtil = {
        N_Nombre_Cli,
        N_Apellidos_Cli,
        N_Fecha_Cli,
        N_email_Cli,
        N_pass_Cli,
        N_Ci_Cli
    };

    const cargaUtilCodificada = JSON.stringify(cargaUtil);
    console.log(cargaUtilCodificada);


    try {
        const respuestaRaw = await fetch("../core/crud_usuarios/Update_usuario.php", {
            method:"POST",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            
            Swal.fire({
                icon: "success",
                text: "Usuario Actualizado",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $N_Ci_Cli.value = $N_Nombre_Cli.value = $N_Apellidos_Cli.value = $N_Fecha_Cli.value= $N_email_Cli = $N_pass_Cli = "";

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