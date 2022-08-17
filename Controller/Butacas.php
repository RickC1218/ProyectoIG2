<?php
$URL_BASE = "http://localhost:90/ProyectoIG2/Controller";
#require ("ASIENTO.php");
include("BasedeDatos.php");
#$Salas = "SELECT *FROM SALA WHERE ID_SALA =". $_GET["ID_SALA"].";";
require("SALA.php");
#$N_Butacas = $_GET['n_butacas'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost:90/ProyectoIG2/Controller/node_modules/sweetalert2/dist/sweetalert2.css">
    <script src="http://localhost:90/ProyectoIG2/Controller/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://localhost:90/ProyectoIG2/Controller/js/cambiar_estado.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border;
            background: #041C32;
            background-repeat: no-repeat;
            background-attachment: cover;
        }

        .Contenedor_principal {
            margin-left: 0;
            width: 100%;
            text-align: center;
        }

        .Pantalla {
            color: white;
            width: 115px;
            margin: 40px auto;
            justify-content: center;
        }

        .Pantalla h1 {

            text-align: center;
            border: 1px solid white;
            border-radius: 20px;
        }

        .Butacas {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
        }

        .Butacas form {
            margin: 0 auto;
        }

        .btn_Butaca {
            background: #ECB365;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
        }

        .btn_Butaca:hover {
            background-color: #51b071;
        }

        .Butacas .taken {
            background: #064663;
        }

        .Butacas .selected {
            background: #51b071;
        }

        .estados_Asientos {
            width: 100%;
            margin: 15px auto;
            display: inline-flex;
            color: white;
            justify-content: space-around;
        }

        .circle_seleccionado {
            margin: 0 auto;
            border-radius: 50%;
            width: 1.2rem;
            height: 1.2rem;
            background: #51b071;
        }

        .circle_disponible {
            margin: 0 auto;
            border-radius: 50%;
            width: 1.2rem;
            height: 1.2rem;
            background: #ECB365;
        }

        .circle_ocupado {
            margin: 0 auto;
            border-radius: 50%;
            width: 1.2rem;
            height: 1.2rem;
            background: #064663;
        }

        .btn_reservacion {

            width: 200px;
            margin: 40px 40%;
            color: white;
            border-radius: 20px;
            background-color: #064663;
            font-size: 1.4rem;
            border: none;
            cursor: pointer;
        }

        .btn_reservacion:hover {
            background-color: #ECB365;
        }
    </style>
</head>

<body>

    <div class="Contenedor_principal">
        <h1 style="color:white; margin-top: 40px;">Escoja sus asientos</h1>
        <hr>
        <div class="estados_Asientos">
        
            <div class="seleccionado">
                <div class="circle_seleccionado"></div>
                <p>Seleccionado</p>
            </div>
            <div class="disponible">
                <div class="circle_disponible"></div>
                <p>Disponible</p>
            </div>
            <div class="ocupado">
                <div class="circle_ocupado"></div>
                <p>Ocupado</p>
            </div> 
        </div>
        <hr>
    </div>
    
    <div class="Pantalla">

        <h2>PANTALLA</h2>
    </div>
    <div class="Butacas" id="Butacas">
        <?php
        $id_sala = $_GET['ID_SALA'];
        $Asientos = SALA::get_sala($id_sala);
        $json = json_encode($Asientos);
        ?>
        <?php
        //$id = $_GET["id"];
        $id_usuario = 1;

        ?>
        <form id="reservado" method="post" action="http://localhost:90/ProyectoIG2/Controller/reservar.php">
            <!-- <input type="hidden" name="id_asiento" value="<?= $id_asiento ?>"/> -->
            <input type="hidden" name="id_sala" value="<?= $id_sala ?>" />
            <!-- Para integración del sistema relacionar las reservaciones con los usuarios-->
            <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>" />
        </form>
        <button class="btn_reservacion" onclick="reservacion.guardar()">Reservar Asientos</button>
    </div>


    </div>
</body>

</html>