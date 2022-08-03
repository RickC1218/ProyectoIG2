<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    //DB details
    $dbHost     = 'localhost';
    $dbUsername = 'Carlos';
    $dbPassword = 'Linkcar_1999';
    $dbName     = 'TOPCINE';
    
    //Create connection and select DB
    $db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
    
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . mysqli_connect_error());
    }
    
    //Get image data from database
    $result = mysqli_query($bd,"SELECT IMAGEN_PELICULA FROM PELICULA WHERE ID_PELICULA = {$_GET['ID_PELICULA']}");
    
    if($result->num_rows > 0){
        $imgData = mysqli_fetch_assoc($result);
        
        //Render image
        header("Content-type: image/png/jpg"); 
        echo $imgData['IMAGEN_PELICULA']; 
    }else{
        echo 'Image not found...';
    }
?>
</body>
</html>
