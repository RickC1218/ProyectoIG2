<?php
include("BasedeDatos.php");
$Peliculas = "SELECT *FROM PELICULA WHERE ID_PELICULA =" . $_GET["ID"] . ";";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nùmero de Boletos</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <!-- Compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <link rel="stylesheet" href="../resources/fuentes/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: #041C32;
            background-repeat: no-repeat;
            background-attachment: cover;
        }

        .Pelicula {
            float: left;
            margin-top: 6%;
            margin-left: 10%;
        }

        .Info_Pelicula {
            width: 400px;

        }

        .img_Pelicula {
            width: 100%;
            height: 70vh;
            border-radius: 20px;
        }

        .text_Pelicula h1,
        h2,
        p {
            padding-top: 20px;
            text-align: center;
            color: white;
        }

        .Numero_Boletos {
            position: relative;
            width: 40%;
            margin-top: 8%;
            margin-right: 10%;
            float: right;
            background-color: #064663;
            border-radius: 20px;
        }

        .fechas_Disponibles {
            width: 40%;
            margin-top: 40px;
            margin-right: 10%;
            float: right;
            background-color: #064663;
            border-radius: 20px;
        }

        .fechas_Disponibles h2 {
            margin: 0 auto;
            font-size: 2.0rem;
            background-color: #064663;
            border-radius: 20px;
        }

        .caja_fecha {
            text-align: center;
            color: white;
            margin: auto 0;
            width: 100%;
            border-radius: 10px;
            font-size: 1.8rem;
            background-color: transparent;
            display: inline-flex;
            cursor: pointer;
            border: none;
        }

        .caja_fecha:hover {
            background-color: #ECB365;
        }

        .Salas_Disponibles {

            width: 40%;
            margin-top: 40px;
            margin-right: 10%;
            float: right;
            background-color: #064663;
            border-radius: 20px;
        }

        .Salas_Disponibles h2 {
            margin: 0 auto;
            font-size: 2.0rem;
            background-color: #064663;
            border-radius: 20px;
        }

        .caja_hora {
            padding-top: 5px;
            margin: auto 40px;
            padding-left: 5px;
            width: 70px;
            height: 40px;
            border-radius: 10px;
            font-size: 1.8rem;
            background-color: transparent;
            display: inline-flex;
            cursor: pointer;
        }

        .caja_hora:hover {
            background-color: #ECB365;
        }

        /* Contador */

        .contador {
            margin: 0 auto;
            position: relative;
            width: 80px;
            height: 50px;
            border-radius: 40px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: 0.5s;
        }

        .contador:hover {
            width: 120px;
            border: 2px solid #ECB365;
            box-shadow: 0px 0px 14px #ECB365;
        }

        .contador .next {
            position: absolute;
            top: 50%;
            right: 30px;
            display: block;
            width: 12px;
            height: 12px;
            border-top: 2px solid #ECB365;
            border-left: 2px solid #ECB365;
            z-index: 1;
            transform: translateY(-50%) rotate(135deg);
            cursor: pointer;
            opacity: 0;
            transition: 0.5s;
        }

        .contador:hover .next {
            opacity: 1;
            right: 20px;
        }

        .contador .prev {
            position: absolute;
            top: 50%;
            left: 20px;
            display: block;
            width: 12px;
            height: 12px;
            border-top: 2px solid #ECB365;
            border-left: 2px solid #ECB365;
            z-index: 1;
            transform: translateY(-50%) rotate(315deg);
            cursor: pointer;
            opacity: 0;
            transition: 0.5s;
        }

        .contador:hover .prev {
            opacity: 1;
            right: -20px;
        }

        #box span {
            position: absolute;
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 20px;
            text-align: center;
            line-height: 46px;
            display: none;
            color: #ECB365;
            font-size: 24px;
            font-weight: 700;
            user-select: none;
        }

        #box span:nth-child(1) {
            display: inline;
        }

        /* Header Volver*/
        #headerEstrenos {
            margin: 40px 50px;
        }

        #headerEstrenos a {
            color: #ecb365;
            text-decoration: none;
            font-size: 20px;
        }

        #headerEstrenos a span {
            padding-left: 20px;
        }
</style>
</head>

<body>
    <?php
    //Se trae la imagen de la base de datos
    $result = mysqli_query($con, $Peliculas);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
    ?>

        <div class="container" id="headerEstrenos">
            <a href="../UI/estrenos.html">
                <i class="fa fa-arrow-left" aria-hidden="true"></i><span> Volver</span>
            </a>
        </div>
        <!--Fin Header-->

        <hr>
        <div class="Pelicula">
            <div class="Info_Pelicula">
                <h1 style="color: white; margin-bottom: 20px;">Escoger Numero de Entradas</h1>
            <?php echo '<img class=img_Pelicula src="../' . $row['IMAGEN_PELICULA'] . '"/>';
        }
            ?>

            <div class="text_Pelicula">
                <h1><?php echo $row['TITULO_PELICULA'] ?></h1>
                <h2>Duracion: <?php echo $row['DURACION_PELICULA'] ?> minutos </h2>
                <h2>Reparto:</h2>
                <p>Actores Principales:<?php echo $row['ACTPRIN_PELICULA'] ?> <br> Actores Secundarios:<?php echo $row['ACTSECUN_PELICULA'] ?> </p>
                <h2>Sinapsis:</h2>
                <p><?php echo $row['SINOPSIS_PELICULA'] ?></p>
            </div>
            </div>
        </div>
        <div class="Numero_Boletos">
            <h2 style="background-color: #064663; border-radius: 20px;">Boletos</h2>
            <div id="n_boletos" class="contador">
                <div id="box"></div>
                <span class="next" onclick="nextNum()"></span>
                <span class="prev" onclick="prevNum()"></span>
            </div>
        </div>
        <script src="/ProyectoIG2/Controller/js/Contador.js"></script>
        <div style="color: white;" class="fechas_Disponibles">
            <input type="date" class="caja_fecha"></input>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var elems = document.querySelectorAll('.datepicker');
                    var instances = M.Datepicker.init(elems, options);
                    $(document).ready(function() {
                        $('.datepicker').datepicker();
                    });
                });
            </script>
        </div>
        <div style="color: white;" class="Salas_Disponibles">
            <?php
            $var1 = '10:00';
            $var2 = '20:00';
            $intervarlo = '150';

            $HoraInicio = new DateTime($var1);
            $HoraFin = new DateTime($var2);
            $HoraFin = $HoraFin->modify('+150 minutes');

            $rangoHoras = new DatePeriod($HoraInicio, new DateInterval('PT150M'), $HoraFin);
            echo "<h2>Sala 2D</h2> <br>";
            $id_sala1 = 1;
            foreach ($rangoHoras as $Hora) {
                echo "<div class =caja_hora onclick= 'EnviarInfo(${id_sala1})' <p>" . $Hora->format("H:i") . PHP_EOL . "</p><br></div>";
            }
            echo "<h2>Sala IMAX</h2> <br>";
            $id_sala2 = 2;
            foreach ($rangoHoras as $Hora) {
                $id_sala2 =$id_sala2+1;
                echo "<div class =caja_hora onclick= 'EnviarInfo(${id_sala2})' <p>" . $Hora->format("H:i") . PHP_EOL . "</p><br></div>";
            }
            ?>
        </div>
        <!-- Contador -->

        <script src="js/Contador.js"></script>
        <script>
            function EnviarInfo(id) {

                window.location.href = "Butacas.php?ID_SALA=" + id

            }
        </script>

</body>

</html>