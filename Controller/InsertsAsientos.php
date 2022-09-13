<?php
require("SALA.php");
require("BasedeDatos.php");

SALA::Aforo(1, 100, 25);
SALA::Aforo(2, 100, 25);
SALA::Aforo(3, 100, 25);
SALA::Aforo(6, 200, 25);
SALA::Aforo(7, 100, 25);

echo "Inserts Hechos con exito";
