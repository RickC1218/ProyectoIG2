<?php
    include ("BasedeDatos.php");
    $Peliculas = "SELECT *FROM PELICULA WHERE ID_PELICULA =". $_GET["ID"].";";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numero de Boletos</title>
    <script src="js/CarteleraPrincipal.js"></script>
    <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  background-color: #041C32;
}        
        .Pelicula{
    float:left;
    margin-top: 6%;
    margin-left: 10%;
}
.Info_Pelicula{
        width: 600px;
    }
.img_Pelicula{
    width: 100%;
    border-radius: 20px;
}

.text_Pelicula h1,h2,p{
    padding-top: 20px;
    text-align: center;
    color: white;

}
.Numero_Boletos{
    width: 600px;
    margin-top: 8%;
    margin-right: 10%;
    float: right;
    background-color: #064663;
    border-radius: 20px;
}
.Numero_Boletos button{
    background-color: #064663;
    color: white;
    font-size: 2.4rem;
    text-align: center;
    margin-top: 10px;
    margin-left: 16vh;
    margin-right: 15vh;
    margin-top: 20px;
    margin-bottom: 20px;
    border: none;
}
.Numero_Boletos input{
    border-radius: 10px;
    width: 50px;
    height: auto;
    font-size: 2.4rem;
}
    </style>
</head>
<body>
<?php
    //Get image data from database
    $result = mysqli_query($con,$Peliculas);
    
    if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        ?>        
        .Numero_Boletos

    <div class="Pelicula">
        <div class="Info_Pelicula">
        <h1 style="color: white; margin-bottom: 20px;">Escoger Numero de Entradas</h1>
            <?php echo '<img class=img_Pelicula src="data:image/png;base64,'.base64_encode($row['IMAGEN_PELICULA']).'"/>';}
?>
 
            <div class="text_Pelicula">
                <h1><?php echo $row['TITULO_PELICULA']?></h1>
                <h2>Duracion: <?php echo $row['DURACION_PELICULA']?> minutos </h2>
                <h2>Reparto</h2>
                <p>Actores Principales:<?php echo $row['ACTPRINCIPAL_PELICULA']?> <br> Actores Secundarios:<?php echo $row['ACTSECUNDARIOS_PELICULAS']?> </p>
            </div>
        </div>
    </div>
    <div class="Numero_Boletos">
        <h2>Boletos Adulto</h2>
        <button>+</button>
        <input type="text">
        <button>-</button>
    </div>
</body>
</html>