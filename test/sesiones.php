<?php
session_start(); //declaron de sesion

$_SESSION['user'] = 1234;//inicialización de session
if(isset($_SESSION['user'])){
    echo 'SI';
}else{
    echo 'NO';
}



echo 'session_id(): ' . session_id();
echo "<br />\n";
echo 'session_name(): ' . session_name();
echo "<br />\n";
print_r(session_get_cookie_params());





$_SESSION = array();
// Borra la cookie que almacena la sesión 
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
echo 'destruir ';

?>
