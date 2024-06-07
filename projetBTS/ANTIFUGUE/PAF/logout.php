<?php 
    session_start(); // demarrage de la session
    session_destroy(); // on détruit la/les session
    header('Location: ./login.php'); // On redirige vers la page login
    exit();
?>