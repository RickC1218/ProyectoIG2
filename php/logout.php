<?php
    session_start();
    $_SESSION = array();
    // Borra la cookie que almacena la sesión
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    session_destroy();
    echo 'ok'
?>