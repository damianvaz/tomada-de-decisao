<?php
    echo "<fieldset>
             <legend>Resultados</legend>
             <h3>Maximax</h3>
             <p>    O método Maximax é uma abordagem na tomada de decisões que busca maximizar o benefício máximo possível em situações de incerteza. <br>Essa estratégia envolve a avaliação das diferentes opções disponíveis e a seleção daquela que oferece o melhor resultado esperado em termos de ganho máximo.
O método Maximax é particularmente aplicado em ambientes em que o tomador de decisão está disposto a assumir riscos elevados para buscar os maiores benefícios possíveis. No entanto, essa abordagem pode ser criticada por não considerar as possíveis perdas associadas às decisões, focando exclusivamente nos resultados mais otimistas.

</p>
          </fieldset>";
    $userId = $_SESSION['user_id'];
    $decisionId = $_POST['decisionName'];
    $newTableName = "User$userId"."Decision$decisionId"."Table";





//s  echo $newTableName;
    // print table
//    $sql = "SELECT * FROM $newTableName";
//    $resultado = $conexao->query($sql) or die($conexao->error);
//    $vetorRegistros = $resultado->fetch_all();
//    $numRows = mysqli_num_rows($resultado);
//    $numCols = mysqli_num_fields($resultado);


    $numRows = $_SESSION['alternatives'];
    $numCols = $_SESSION['states'];
    echo "<table>
          <caption>New Table $newTableName</caption>
          <tr>";

    /** @var $conexao  **/


//    $sql = "CREATE TABLE IF NOT EXISTS $newTableName(
//            ID INT PRIMARY KEY AUTO_INCREMENT, ";
//
//    for($i = 0; $i < $numCols; $i++) {
//        $states = $_SESSION['statesNames'];
//        if ($i == 0) {
//            $sql .= "alternativeName VARCHAR(500), ";
//        }
//        $statename = $states[$i];
//
//        //take spaces and special chars
//        $statename = preg_replace('/[^A-Za-z0-9\-]/', '', $statename);
//        $statename = str_replace(' ', '_', $statename);
//        if(ctype_digit($statename)) {
//            $statename = "state_$statename";
//        }
//        if ($statename == "") {
//            $num = $i + 1;
//            $statename = "estado_$num";
//        }
//        if($i == $numCols - 1)
//            $sql .= "$statename VARCHAR(500)";
//        else
//            $sql .= "$statename VARCHAR(500), ";
//    }
//    $sql .= ") ENGINE=innoDB";
////    echo "$sql";
//    $conexao->query($sql) or die($conexao->error);
//    //INSERT INTO your_table
//    //VALUES ('value1', 'value2', 'value3');
//    $sql2 = "INSERT INTO $newTableName VALUES (NULL, ";
//    for($i = 0; $i < $numRows; $i++) {
//        for($j = 0; $j <= $numCols; $j++) {
//            $atribute = "";
//            if ($j == 0) {
//                $alternativeName = $_SESSION['alternativesNames'][$i];
//                if($alternativeName == "") {
//                    $num = $i + 1;
//                    $atribute = "Alternative $num";
//                } else {
//                    $atribute = $_SESSION['alternativesNames'][$i];
//                }
//            } else {
//                $col = $j - 1;
//                $atribute = $_SESSION['alternativesData'][$i][$col];
//                if ($atribute == "") {
//                    $atribute = "NULL";
//                }
//            }
//            if($j == $numCols) {
//                $sql2 .= "'$atribute'";
//            }
//            else {
//                $sql2 .= "'$atribute', ";
//            }
//        }
//        if($i == $numRows - 1) {
//
//            $sql2 .= ")";
//        }
//        else {
//            $sql2 .= "), (NULL, ";
//        }
//    }
////echo $sql2;
//    $conexao->query($sql2) or die($conexao->error);

//
//
//
////------------------------------------------------------------------------------------------
//
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
//$conexao->query($sql) or die($conexao->error);

//    function createTableOnDB($newTableName) {
//        /** @var $conexao  **/
//
//        $sql = "CREATE TABLE IF NOT EXISTS $newTableName(
//            ID INT PRIMARY KEY AUTO_INCREMENT,
//            alternativeName VARCHAR(500)
//            ) ENGINE=innoDB";
//
//        $conexao->query($sql) or die($conexao->error);
//    }
