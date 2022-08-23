<?php
    $servidor = "mysql:dbname=bmedwpkvqgclxvayszaa; host=bmedwpkvqgclxvayszaa-mysql.services.clever-cloud.com";
    $user = "u4njwbpubmoozhpo";
    $pwd = "urZrypNkE3L25QF0n9jx";
    try {
        $pdo = new PDO($servidor, $user, $pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }catch(PDOException $e){
        echo "Conexión fallida ".$e->getMessage();
    }
?>