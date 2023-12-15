<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title> Login de usuário </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h1> Cadastro de usuário</h1>

<form action="cadastro.php" method="post">
    <fieldset>
        <legend> Cadastro </legend>

        <label for='nome' class="alinha"> Nome completo: </label>
        <input id='nome' type="text" name="nome" autofocus> <br>

        <label for="email" class="alinha"> E-mail: </label>
        <input id="email" type="email" name="email"> <br>

        <label for="login" class="alinha"> Login: </label>
        <input id="login" type="text" name="login"> <br>

        <label for="password" class="alinha"> Senha: </label>
        <input id="password" type="password" name="senha"> <br>

        <div>
            <button class="floatRightButton" name="cadastrar"> Cadastrar usuário </button>
        </div>
    </fieldset>
</form>

<?php
require "./includes/mysqlDatabase.inc.php";

if(isset($_POST['cadastrar']))
{
    // Check if the inputs are empty
    if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['login']) || empty($_POST['senha']))
    {
        echo "<p class='error'>Preencha todos os campos!</p>";
    }
    else
    {
        require "./includes/cadastrar.inc.php";
    }
}

require "./includes/desconectar.inc.php";
?>
</body>
</html>