<?php
/** @var $tabelaAluno  **/
/** @var $tabelaCurso  **/
/** @var $conexao  **/

$cursoID = trim($conexao->escape_string($_POST['lista-curso-pesquisa']));
$cursoNomeResultado = $conexao->query("SELECT curso FROM $tabelaCurso WHERE id = '$cursoID'") or exit($conexao->error);
$cursoNome = $cursoNomeResultado->fetch_array()[0];
$resultado = $conexao->query("SELECT * FROM $tabelaAluno WHERE curso = '$cursoID'") or exit($conexao->error);

// testar se o resultado da consulta é vazio
$quantidadeAlunos = mysqli_num_rows($resultado);
$creditosCounter = 0;
if($quantidadeAlunos == 0) {
    exit("<p>Nenhum aluno cadastrado no curso $cursoNome. Aplicação encerrada</p>");
}
echo "<table>
          <caption>Alunos do curso $cursoNome</caption>
          <tr>
            <th>Matrícula</th>
            <th>Aluno</th>
            <th>Creditos</th>
          </tr>";
// PHP vai considerar variavel $registro como true enquanto estiver voltando um array, quando não tiver mais nada, vai considerar falso
while($registro = $resultado->fetch_array()) {
    $matricula = htmlentities($registro[0], ENT_QUOTES, "UTF-8");
    $aluno = htmlentities($registro[1], ENT_QUOTES, "UTF-8");
    $creditos = htmlentities($registro[2], ENT_QUOTES, "UTF-8");
    $creditosCounter += (int)$creditos;
    echo "<tr>
                <td>$matricula</td>
                <td>$aluno</td>
                <td>$creditos</td>
              </tr>";
}
$mediaCreditos = $creditosCounter / $quantidadeAlunos;
$mediaCreditos = number_format($mediaCreditos, 2, ',', '.');
echo "<tr>
        <td colspan='2'>Média de creditos dos alunos</td>
        <td>$mediaCreditos</td>
      </tr>";
echo "</table>";
