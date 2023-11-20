<?php
    /** @var $tabelaCurso  **/
    /** @var $conexao  **/

    // opreações de cadastro das informações do formulário no banco de dados
    $id = trim($conexao->escape_string($_POST['id']));
    $curso = $conexao->escape_string($_POST['curso']);

    // inserção dos dados no banco de dados  for 'text' or 'date' numbers without
    $conexao->query("INSERT $tabelaCurso VALUES('$id', '$curso')") OR exit($conexao->error);

    echo "<p>Dados cadastrados com sucesso no banco de dados.</p>";

