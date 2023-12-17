<?php
/** @var $conexao  **/

    $user= $_SESSION['user_id'];
    $decisoes = $conexao->query("SELECT * FROM decision WHERE user_id = $user") or exit($conexao->error);
    $number = mysqli_num_rows($decisoes);
    $number++;
    $conexao->query("INSERT INTO decision (user_id, name) VALUES ($user, 'Decisão $number')") or exit($conexao->error);

    $decisionId = $conexao->query("SELECT id FROM decision WHERE user_id = $user ORDER BY id DESC LIMIT 1") or exit($conexao->error);
    $decisionId = $decisionId->fetch_array()[0];
    $_SESSION['decisionId'] = $decisionId;

    unsetSessionVars();
