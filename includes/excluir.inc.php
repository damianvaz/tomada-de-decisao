<?php
/** @var $conexao  **/
$id = $_POST['decisionName'];
$conexao->query("DELETE from decision WHERE ID = '$id'") or die($conexao->error);

//    TODO Drop the table and make a new one with the new name
//    $conexao->query("DROP TABLE $id") or die($conexao->error);
//    $conexao->query("CREATE TABLE $nome (
//        ID int NOT NULL AUTO_INCREMENT,
//        nome varchar(255) NOT NULL,
//        PRIMARY KEY (ID)
//    )") or die($conexao->error);
//
//    header("location: ../main.php");