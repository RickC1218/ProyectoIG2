<?php

// se llama a la clase que tiene un metodo de guardado mediante un metodo estático
require "SALA.php";

//Se reservan los asientos en la base de datos
SALA::save($_POST["id_sala"], $_POST["asientos"], $_POST["id_usuario"], $_POST["costo_entradas"]);
printf("<script language='javascript'>
window.location.href = '../UI/CarritoCompras.html';
</script>");
