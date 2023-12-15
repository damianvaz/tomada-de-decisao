<?php
    echo "<fieldset>
             <legend>Resultados</legend>
             <h3>Maximax</h3>
             <p>    O método Maximax é uma abordagem na tomada de decisões que busca maximizar o benefício máximo possível em situações de incerteza. <br>Essa estratégia envolve a avaliação das diferentes opções disponíveis e a seleção daquela que oferece o melhor resultado esperado em termos de ganho máximo.
O método Maximax é particularmente aplicado em ambientes em que o tomador de decisão está disposto a assumir riscos elevados para buscar os maiores benefícios possíveis. No entanto, essa abordagem pode ser criticada por não considerar as possíveis perdas associadas às decisões, focando exclusivamente nos resultados mais otimistas.

</p>
          </fieldset>";
    $userId = $_SESSION['user_id'];
    global $conexao;
    $decisionId = $_POST['decisionName'];

    // First delete all data associated with decisionId
//    $sql = "DELETE FROM alternative_nature_state WHERE alternative_id IN (SELECT id FROM alternative WHERE decision_id = $decisionId);
//            DELETE FROM alternative WHERE decision_id = $decisionId;
//            DELETE FROM nature_state WHERE decision_id = $decisionId;
//";
    $sql1 = "DELETE FROM alternative_nature_state WHERE alternative_id IN (SELECT id FROM alternative WHERE decision_id = $decisionId)";
    $sql2 = "DELETE FROM alternative WHERE decision_id = $decisionId";
    $sql3 = "DELETE FROM nature_state WHERE decision_id = $decisionId";

    $conexao->query($sql1) or die($conexao->error);
    $conexao->query($sql2) or die($conexao->error);
    $conexao->query($sql3) or die($conexao->error);


$numRows = $_SESSION['alternatives'];
$numCols = $_SESSION['states'];
$states = $_SESSION['statesNames'];

// inserting State names in DB
    global $conexao;
    for($i = 0; $i < $numCols; $i++) {
      //  $states = $_SESSION['statesNames'];
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
    for($i = 0; $i < $numRows; $i++) {
        $alternativeName = $_SESSION['alternativesNames'][$i];
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
            $atribute = $_SESSION['alternativesData'][$i][$j];
            if ($atribute == "") {
                $atribute = "NULL";
            }
            $natureStateId = $natureStateIds[$j];
            $alternativeId = $alternativeIds[$i];
            $sql = "INSERT INTO alternative_nature_state (alternative_id, nature_state_id, value) VALUES ($alternativeId, $natureStateId, $atribute)";
            $conexao->query($sql) or die($conexao->error);
        }
    }

    echo "<table>
          <caption>New Table </caption>
          <tr>";

    for($i = 0; $i < $numCols; $i++) {
        $states = $_SESSION['statesNames'];
        if ($i == 0) {
            echo "<th>Alternatives</th>";
        }
        $statename = $states[$i];
        if ($statename == "") {
            $num = $i + 1;
            $statename = "State $num";
        }
        echo "<th>$statename</th>";
    }
    echo "</tr>";
    for($i = 0; $i < $numRows; $i++) {
        echo "<tr>";
        for($j = 0; $j <= $numCols; $j++) {
            $atribute = "";
            if ($j == 0) {
                $alternativeName = $_SESSION['alternativesNames'][$i];
                if($alternativeName == "") {
                    $num = $i + 1;
                    $atribute = "Alternative $num";
                } else {
                    $atribute = $_SESSION['alternativesNames'][$i];
                }
            } else {
                $col = $j - 1;
                $atribute = $_SESSION['alternativesData'][$i][$col];
            }
            echo "<td>$atribute</td>";
        }
        echo "</tr>";

    }
echo "</tr>";
echo "</table>";

//echo "<table>
//          <caption>New Table </caption>
//          <tr>";
//
//    for($i = 0; $i < $numCols; $i++) {
//        $states = array();
//        $sql = "SELECT name FROM nature_state WHERE decision_id = $decisionId";
//        $resultado = $conexao->query($sql) or die($conexao->error);
//        while($registro = $resultado->fetch_array()) {
//            $states[] = $registro[0];
//        }
//        if ($i == 0) {
//            echo "<th>Alternatives</th>";
//        }
//        $statename = $states[$i];
//        if ($statename == "") {
//            $num = $i + 1;
//            $statename = "State $num";
//        }
//        echo "<th>$statename</th>";
//    }
//    echo "</tr>";
//    for($i = 0; $i < $numRows; $i++) {
//        echo "<tr>";
//        for($j = 0; $j <= $numCols; $j++) {
//            $atribute = "";
//            if ($j == 0) {
//                //$alternativeName = $_SESSION['alternativesNames'][$i];
//                $sql = "SELECT name FROM alternative WHERE decision_id = $decisionId";
//                $resultado = $conexao->query($sql) or die($conexao->error);
//                $alternatives = array();
//                while($registro = $resultado->fetch_array()) {
//                    $alternatives[] = $registro[0];
//                }
//                if($alternatives[$i] == "") {
//                    $num = $i + 1;
//                    $atribute = "Alternative $num";
//                } else {
//                    $atribute = $alternatives[$i];
//                }
//            } else {
//                $col = $j - 1;
//                $sql = "SELECT value FROM alternative_nature_state WHERE alternative_id = $alternativeId AND nature_state_id = $natureStateId[$col]";
//                //$atribute = $_SESSION['alternativesData'][$i][$col];
//                echo "<td>$sql</td>";
////                $resultado = $conexao->query($sql) or die($conexao->error);
////                $resultado->fetch_array();
//              //  print_r($resultado);
//                //$atribute = $resultado[0];
//
//            }
//            echo "<td>$atribute</td>";
//        }
//        echo "</tr>";
//
//    }
//echo "</tr>";
//echo "</table>";