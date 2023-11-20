<?php
    $servidor = "localhost"; //127.0.0.1
    $usuario = "root";
    $senha = "";

    $nomeBanco = "GTI_PRW2";
    $tabelaCurso = "curso";
    $tabelaAluno = "aluno";
    $conexao = new mysqli($servidor, $usuario, $senha);
    $conexao->query("CREATE DATABASE IF NOT EXISTS $nomeBanco") or die($conexao->error);
    // open
    $conexao->select_db($nomeBanco);
    $conexao->set_charset("utf8");
    // include para criar automaticamente a estrutura da tabela no banco de dados

    $query = "CREATE TABLE IF NOT EXISTS $tabelaCurso (
                    id VARCHAR(10) PRIMARY KEY,
                    curso VARCHAR(50)) ENGINE=InnoDB";
    $conexao->query($query) or die($conexao->error);

    $query = "CREATE TABLE IF NOT EXISTS $tabelaAluno (
                    matricula VARCHAR(10) PRIMARY KEY,
                    aluno VARCHAR(150),
                    creditos INT,
                    curso VARCHAR(10),
                    FOREIGN KEY(curso) REFERENCES curso(id)) ENGINE=InnoDB";
    $conexao->query($query) or die($conexao->error);

