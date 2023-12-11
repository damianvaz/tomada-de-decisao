<?php
session_start();
//esta include testa se o usuário passou pelo cadastro ou pelo login antes de exibirmos o conteúdo restrito

if(!isset($_SESSION["conectado"]) OR !$_SESSION["conectado"])
{
    exit("<p> Acesso proibido. Faça o cadastro ou o login na aplicação! </p>");
}