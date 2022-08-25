<?php

    $server= 'mysql:host=bmedwpkvqgclxvayszaa-mysql.services.clever-cloud.com;port=3306;dbname=bmedwpkvqgclxvayszaa';
    $user ='u4njwbpubmoozhpo';
    $psw ='urZrypNkE3L25QF0n9jx';

    try{

        $conexion   = new PDO($server,$user,$psw);

        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    }catch (PDOException $error){
        echo $error->getMessage();
        die();
    }
?>