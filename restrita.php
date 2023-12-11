<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title> Login de usuário </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
require "includes/valida-acesso.inc.php";
?>
<h1> Conteúdo restrito. Acesso mediante login de usuário </h1>
<h2> Bem-vindo(a), usuário(a)! <br>
    Aqui, você tem acesso a recursos restritos de nossa aplicação blá, blá, blá... </h2>

<form action="./includes/logout.inc.php" method="post">
    <fieldset>
        <legend> Desconectar </legend>
        <button> Logout </button>
    </fieldset>
</form>
</body>
</html>