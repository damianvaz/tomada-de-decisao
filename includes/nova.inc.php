<?php
/** @var $conexao  **/

    $user= $_SESSION['user_id'];
    $decisoes = $conexao->query("SELECT * FROM decision WHERE userId = $user") or exit($conexao->error);
    $number = mysqli_num_rows($decisoes);
    $number++;
    $conexao->query("INSERT INTO decision (userId, nome) VALUES ($user, 'Decisão $number')") or exit($conexao->error);

