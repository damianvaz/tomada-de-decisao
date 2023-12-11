<?php
require "./includes/util.inc.php";
/** @var $conexao  **/


$nome          = trim($conexao->escape_string($_POST['nome']));
$email         = trim($conexao->escape_string($_POST['email']));
$login         = trim($conexao->escape_string($_POST['login']));
$senha         = trim($conexao->escape_string($_POST['senha']));

//criptografar a senha
$senha = password_hash($senha, PASSWORD_ARGON2I);

//gravamos os dados do usuário no banco
$sql = "INSERT user VALUES(
             null,
             '$nome',
             '$email',
             '$login',
             '$senha')";
$conexao->query($sql) or die($conexao->error);

//aqui, também, iniciaremos uma sessão para este usuário
/**
 * @param string $login
 * @param mysqli $conexao
 * @return void
 */


userSession($login, $conexao);

//redirecionamos o usuário para a página restrita
header("location: main.php");