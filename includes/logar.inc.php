<?php
/** @var $conexao  **/

require "./includes/util.inc.php";

$login         = trim($conexao->escape_string($_POST['login']));
$senha         = trim($conexao->escape_string($_POST['senha']));

//buscar, no banco de dados, a senha do usuário, usando, como chave de pesquisa, o seu login
$sql = "SELECT senha FROM user WHERE login = '$login'";

$resultado = $conexao->query($sql) OR die($conexao->error);

$vetorRegistro = $resultado->fetch_array();
if($vetorRegistro == null) {
    exit("<p> Credenciais incorretas. </p>");
}
$senhaCriptografada = $vetorRegistro[0];

$senhaCorreta = password_verify($senha, $senhaCriptografada);

if($senhaCorreta)
{
    userSession($login, $conexao);
}

else
{
    echo "<p> Credenciais incorretas. </p>";
}