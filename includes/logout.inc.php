<?php
session_start();

//para desconectarmos, manualmente, o usuário da nossa aplicação, executamos os comandos abaixo
$_SESSION = [];
session_destroy();
header("location: ../home.php");