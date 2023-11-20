<?php
/** @var $tabelaAluno  **/
/** @var $conexao  **/

// opreações de cadastro das informações do formulário no banco de dados
$matricula = trim($conexao->escape_string($_POST['matricula']));
$aluno = trim($conexao->escape_string($_POST['aluno']));
$creditos = $_POST['creditos'];
$curso = trim($conexao->escape_string($_POST['lista-curso']));

// inserção dos dados no banco de dados  for 'text' or 'date' numbers without
$conexao->query("INSERT $tabelaAluno VALUES('$matricula', '$aluno', $creditos, '$curso')") OR exit($conexao->error);

echo "<p>Dados cadastrados com sucesso no banco de dados.</p>";

