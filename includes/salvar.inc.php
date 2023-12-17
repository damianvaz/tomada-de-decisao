<?php
/** @var $conexao  **/

$decisionId = $_POST['decisionName'];
$alternatives = $_SESSION['alternativesNames'];
$states = $_SESSION['statesNames'];
$data = $_SESSION['alternativesData'];
$alternativesNum = $_SESSION['alternatives'];
$statesNum = $_SESSION['states'];
//saveInputs(0, 0);

$sql1 = "DELETE FROM alternative_nature_state WHERE alternative_id IN (SELECT id FROM alternative WHERE decision_id = $decisionId)";
$sql2 = "DELETE FROM alternative WHERE decision_id = $decisionId";
$sql3 = "DELETE FROM nature_state WHERE decision_id = $decisionId";

$conexao->query($sql1) or die($conexao->error);
$conexao->query($sql2) or die($conexao->error);
$conexao->query($sql3) or die($conexao->error);



$numRows = $alternativesNum;
$numCols = $statesNum;

// inserting State names in DB

// check if array states is empty
if (empty($states)) {
    for($i = 0; $i < $numCols; $i++) {
        $states[$i] = "";
    }
}

for($i = 0; $i < $numCols; $i++) {
    $statename = $states[$i];
    if ($statename == "") {
        $num = $i + 1;
        $statename = "Estado $num";
    }
    // INSERT INTO nature_state (decision_id, name) VALUES (1, 'State A');
    $sql = "INSERT INTO nature_state (decision_id, name) VALUES ($decisionId, '$statename')";
    $conexao->query($sql) or die($conexao->error);
}

// inserting Alternative names in DB

// check if array alternatives is empty
if (empty($alternatives)) {
    for($i = 0; $i < $numRows; $i++) {
        $alternatives[$i] = "";
    }
}
for($i = 0; $i < $numRows; $i++) {
    $alternativeName = $alternatives[$i];
    if($alternativeName == "") {
        $num = $i + 1;
        $alternativeName = "Alternative $num";
    }
    $sql = "INSERT INTO alternative (decision_id, name) VALUES ($decisionId, '$alternativeName')";
    $conexao->query($sql) or die($conexao->error);
}

// getting nature_state ids
$sql = "SELECT id FROM nature_state WHERE decision_id = $decisionId";

$resultado = $conexao->query($sql) or die($conexao->error);
$natureStateIds = array();
while($registro = $resultado->fetch_array()) {
    $natureStateIds[] = $registro[0];
}

// getting alternative ids
$sql = "SELECT id FROM alternative WHERE decision_id = $decisionId";

$resultado = $conexao->query($sql) or die($conexao->error);
$alternativeIds = array();
while($registro = $resultado->fetch_array()) {
    $alternativeIds[] = $registro[0];
}

// inserting data in DB
for($i = 0; $i < $numRows; $i++) {
    for ($j = 0; $j < $numCols; $j++) {
        $col = $j;
        $row = $i;
        $atribute = $data[$i][$j];
        if ($atribute == "") {
            $atribute = "NULL";
        }
        $natureStateId = $natureStateIds[$j];
        $alternativeId = $alternativeIds[$i];
        $sql = "INSERT INTO alternative_nature_state (alternative_id, nature_state_id, value) VALUES ($alternativeId, $natureStateId, $atribute)";
        $conexao->query($sql) or die($conexao->error);
    }
}
$nome = trim($conexao->escape_string($_POST['name']));
$conexao->query("UPDATE decision SET name = '$nome' WHERE ID = '$decisionId'") or die($conexao->error);
//    $nome = trim($conexao->escape_string($_POST['name']));
//    $decisionId = $_POST['decisionName'];
//    $nome = $conexao->escape_string($nome);
//
//    $numRows = $_SESSION['alternatives'];
//    $numCols = $_SESSION['states'];
//    $states = $_SESSION['statesNames'];
//    $alternatives = $_SESSION['alternativesNames'];
//    $data = $_SESSION['alternativesData'];
//
//
//$sql1 = "DELETE FROM alternative_nature_state WHERE alternative_id IN (SELECT id FROM alternative WHERE decision_id = $decisionId)";
//$sql2 = "DELETE FROM alternative WHERE decision_id = $decisionId";
//$sql3 = "DELETE FROM nature_state WHERE decision_id = $decisionId";
//
//$conexao->query($sql1) or die($conexao->error);
//$conexao->query($sql2) or die($conexao->error);
//$conexao->query($sql3) or die($conexao->error);
//
//// inserting State names in DB
//global $conexao;
//for($i = 0; $i < $numCols; $i++) {
//    //  $states = $_SESSION['statesNames'];
//    $statename = $states[$i];
//    if ($statename == "") {
//        $num = $i + 1;
//        $statename = "Estado $num";
//    }
//    // INSERT INTO nature_state (decision_id, name) VALUES (1, 'State A');
//    $sql = "INSERT INTO nature_state (decision_id, name) VALUES ($decisionId, '$statename')";
//    $conexao->query($sql) or die($conexao->error);
//}
//
//// inserting Alternative names in DB
//for($i = 0; $i < $numRows; $i++) {
//    $alternativeName = $alternatives[$i];
//    if($alternativeName == "") {
//        $num = $i + 1;
//        $alternativeName = "Alternative $num";
//    }
//    $sql = "INSERT INTO alternative (decision_id, name) VALUES ($decisionId, '$alternativeName')";
//    $conexao->query($sql) or die($conexao->error);
//}
//
//// getting nature_state ids
//$sql = "SELECT id FROM nature_state WHERE decision_id = $decisionId";
//
//$resultado = $conexao->query($sql) or die($conexao->error);
//$natureStateIds = array();
//while($registro = $resultado->fetch_array()) {
//    $natureStateIds[] = $registro[0];
//}
//
//// getting alternative ids
//$sql = "SELECT id FROM alternative WHERE decision_id = $decisionId";
//
//$resultado = $conexao->query($sql) or die($conexao->error);
//$alternativeIds = array();
//while($registro = $resultado->fetch_array()) {
//    $alternativeIds[] = $registro[0];
//}
//
//// inserting data in DB
//for($i = 0; $i < $numRows; $i++) {
//    for ($j = 0; $j < $numCols; $j++) {
//        $col = $j;
//        $row = $i;
//        $atribute = $data[$i][$j];
//        if ($atribute == "") {
//            $atribute = "NULL";
//        }
//        $natureStateId = $natureStateIds[$j];
//        $alternativeId = $alternativeIds[$i];
//        $sql = "INSERT INTO alternative_nature_state (alternative_id, nature_state_id, value) VALUES ($alternativeId, $natureStateId, $atribute)";
//        $conexao->query($sql) or die($conexao->error);
//    }
//}
//$conexao->query("UPDATE decision SET name = '$nome' WHERE ID = '$decisionId'") or die($conexao->error);
//

//    $conexao->query("DROP TABLE $id") or die($conexao->error);
//    $conexao->query("CREATE TABLE $nome (
//        ID int NOT NULL AUTO_INCREMENT,
//        nome varchar(255) NOT NULL,
//        PRIMARY KEY (ID)
//    )") or die($conexao->error);
//
//    header("location: ../main.php");