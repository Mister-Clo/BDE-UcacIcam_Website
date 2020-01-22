<?php

session_start();
unset($_SESSION['nom']);
unset($_SESSION['status']);
unset($_SESSION['prenom']);
unset($_SESSION['localisation']);
unset($_SESSION['email']);
unset($_SESSION['password']);
session_destroy();
sleep(1);
header ('location: index.php');

?>