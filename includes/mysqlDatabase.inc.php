<?php
    $servidor = "localhost"; //127.0.0.1
    $usuario = "root";
    $senha = "";

    $nomeBanco = "GTI_PRW2";
    $conexao = new mysqli($servidor, $usuario, $senha);
    $conexao->query("CREATE DATABASE IF NOT EXISTS $nomeBanco") or die($conexao->error);
    // open
    $conexao->select_db($nomeBanco);
    $conexao->set_charset("utf8");

    $sql = "CREATE TABLE IF NOT EXISTS user(
            ID INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(500),
            email VARCHAR(300),
            login VARCHAR(300),
            password VARCHAR(128)
            ) ENGINE=innoDB;";

$conexao->query($sql) or die($conexao->error);


$sql2 = "CREATE TABLE IF NOT EXISTS decision(
            ID INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(500),
            userId INT,
            FOREIGN KEY(userId) REFERENCES user(ID)
            ) ENGINE=innoDB";

$conexao->query($sql2) or die($conexao->error);

$sql3 = "CREATE TABLE IF NOT EXISTS nature_state(
            id INT PRIMARY KEY AUTO_INCREMENT,
            decision_id INT,
            name VARCHAR(300),
            FOREIGN KEY(decision_id) REFERENCES decision(id)
            ) ENGINE=innoDB";

$conexao->query($sql3) or die($conexao->error);

$sql4 = "CREATE TABLE IF NOT EXISTS alternative(
            id INT PRIMARY KEY AUTO_INCREMENT,
            decision_id INT,
            name VARCHAR(300),
            FOREIGN KEY(decision_id) REFERENCES decision(id)
            ) ENGINE=innoDB";

$conexao->query($sql4) or die($conexao->error);

$sql5 = "CREATE TABLE IF NOT EXISTS alternative_nature_state(
            id INT PRIMARY KEY AUTO_INCREMENT,
            alternative_id INT,
            nature_state_id INT,
            value DECIMAL(10, 2),
            FOREIGN KEY(nature_state_id) REFERENCES nature_state(id),
            FOREIGN KEY(alternative_id) REFERENCES alternative(id)
            ) ENGINE=innoDB";

$conexao->query($sql5) or die($conexao->error);

//function createTable($nomeDaTabela, $estadosDaNatureza) {
//    /** @var $conexao  **/
//
//    $sql = "CREATE TABLE IF NOT EXISTS $nomeDaTabela(
//            ID INT PRIMARY KEY AUTO_INCREMENT,
//            alternativeName VARCHAR(500)
//            ) ENGINE=innoDB";
//
//    $conexao->query($sql) or die($conexao->error);
//
//    $Columns = count($estadosDaNatureza);
//    $count = 0;
//    while ($count < $Columns) {
//        $sql = "ALTER TABLE $nomeDaTabela ADD $estadosDaNatureza[$count] VARCHAR(500)";
//        $conexao->query($sql) or die($conexao->error);
//        $count++;
//    }
//
//}