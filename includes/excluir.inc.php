<?php
/** @var $conexao  **/
$id = $_POST['decisionName'];
$conexao->query("DELETE from alternative_nature_state WHERE alternative_id IN (SELECT id FROM alternative WHERE decision_id = '$id')") or die($conexao->error);
$conexao->query("DELETE from nature_state WHERE decision_id = '$id'") or die($conexao->error);
$conexao->query("DELETE from alternative WHERE decision_id = '$id'") or die($conexao->error);
$conexao->query("DELETE from decision WHERE ID = '$id'") or die($conexao->error);

// clear session variables
unset($_SESSION['alternatives']);
unset($_SESSION['states']);
unset($_SESSION['statesNames']);
unset($_SESSION['alternativesNames']);
unset($_SESSION['alternativesData']);
unset($_SESSION['decisionId']);
unset($_SESSION['decisionName']);

// Get the latest decision from the database
$user = $_SESSION['user_id'];
$decisao = $conexao->query("SELECT * FROM decision WHERE user_id = $user ORDER BY id DESC LIMIT 1") or exit($conexao->error);

// check if query returned a decision
if(mysqli_num_rows($decisao) == 0) {
    // if not, create a new decision
    $decisoes = $conexao->query("SELECT * FROM decision WHERE user_id = $user") or exit($conexao->error);
    $number = mysqli_num_rows($decisoes);
    $number++;
    $conexao->query("INSERT INTO decision (user_id, name) VALUES ($user, 'Decisão $number')") or exit($conexao->error);

    $decisionId = $conexao->query("SELECT id FROM decision WHERE user_id = $user ORDER BY id DESC LIMIT 1") or exit($conexao->error);
    $decisionId = $decisionId->fetch_array()[0];
    $_SESSION['decisionId'] = $decisionId;
} else {
    // if yes, get the decision
    $decisao = $decisao->fetch_array();
    $decisionId = $decisao[0];
    $_SESSION['decisionId'] = $decisionId;
}






