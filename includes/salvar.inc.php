<?php
/** @var $conexao  **/
    $nome = trim($conexao->escape_string($_POST['name']));
    $id = $_POST['decisionName'];
//    // get the name of the decision
//    $idDecisaoNameIn = $conexao->query("SELECT id FROM decision WHERE nome = '$nome'") or die($conexao->error);
//    $idResult = $idDecisaoNameIn->fetch_array()[0];
//
//    // check if the id is the same as the nomeDaDecisao
//    if() {
//        exit("<p> Credenciais incorretas. </p>");
//    }
    $conexao->query("UPDATE decision SET nome = '$nome' WHERE ID = '$id'") or die($conexao->error);

//    TODO Drop the table and make a new one with the new name
//    $conexao->query("DROP TABLE $id") or die($conexao->error);
//    $conexao->query("CREATE TABLE $nome (
//        ID int NOT NULL AUTO_INCREMENT,
//        nome varchar(255) NOT NULL,
//        PRIMARY KEY (ID)
//    )") or die($conexao->error);
//
//    header("location: ../main.php");