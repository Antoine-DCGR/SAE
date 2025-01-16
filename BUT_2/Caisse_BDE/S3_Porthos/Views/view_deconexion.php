<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: ../Controllers/controller_connexion.php");
?>