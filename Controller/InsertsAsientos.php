<?php
require ("SALA.php");
require("BasedeDatos.php");

SALA::Aforo(1,50,25);
SALA::Aforo(2,100,25);
SALA::Aforo(3,200,25);

echo "Inserts Hechos con exito";
