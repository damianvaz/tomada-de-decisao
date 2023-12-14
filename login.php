<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title> Login de usuário </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h1> Login de usuário </h1>

<form action="login.php" method="post">
    <fieldset>
        <legend> Login </legend>
        <label for="login" class="alinha"> Login: </label>
        <input id="login" type="text" name="login"> <br>

        <label for="password" class="alinha"> Senha: </label>
        <input id="password" type="password" name="senha"> <br>
        <div>
            <button class="home" name="logar"> Logar usuário </button>
        </div>
    </fieldset>
</form>

<?php
require "./includes/mysqlDatabase.inc.php";

if(isset($_POST['logar']))
{
    require "./includes/logar.inc.php";
}

require "./includes/desconectar.inc.php";
?>
</body>
</html>