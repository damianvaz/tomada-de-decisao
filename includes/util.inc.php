<?php
    function printAlternative($alternativeNumber, $StatesQtd) {
        $alternative = "alternativa $alternativeNumber";
        echo "<input class='alternativeName' type='text' name='$alternative' placeholder='$alternative'>";
        $counter = 0;
        while($counter < $StatesQtd) {
            $counter++;
            $name = "alternative".$alternativeNumber."state".$counter;
            echo "<input class='alternativeData' type='text' name='$name'>";
        }
        echo "<button class='minusAlternative' name='minusAlternative$alternativeNumber'>-</button><br>";
    }
    // Print minus buttons for the states first, and prepares the text for the states input to echo after
    function printStates($StatesNumber, $alternativesNumber) {
        $counter = 0;
        $addStateButton = "<button class='addState' name='addState'>+</button><br>";
        $placeholderButton = "<button class='placeholder'>+</button><br>";
        $labelStateName = "<label for='stateName' class='alinha'>Estados da natureza:</label>";


        echo "<label class='placeholder'>-</label>";
        $stateNameEcho = $labelStateName;
        $rect = "";
     //   $height = (13 + (21.5 * $alternativesNumber));
        $height = (30 + (21 * $alternativesNumber));

       // $height = 155;
        $height .= "px";
        $width = (18.5 + (5.5 * $StatesNumber));

        if($width > 100) {
            $left = 15.5;
        } else {
            $left = 15.5 + (100 - $width)/2;
        }

//        while ($counter < $number) {
//            $counter++;
//            echo "<button class='minusState' name='minusState$counter'>-</button>";
//            $rect .= "<div id='highlight' class='minusStateHighlight' style=';left:$left%'></div>";
//            $left += 5.5;
//            $stateNameEcho .= "<input class='stateName' type='text' name='stateName$counter'
//                  placeholder='Estado $counter'>";
//        }
        while ($counter < $StatesNumber) {
            $counter++;
            echo "<button class='minusState minusState$counter' name='minusState$counter'>-</button><div id='highlight' class='minusStateHighlight minusStateHighlight$counter' style='height:$height;left:$left%'></div>";
            $left += 5.5;
            $stateNameEcho .= "<input class='stateName' type='text' name='stateName$counter'
                  placeholder='Estado $counter'>";
        }

        echo "$rect$placeholderButton$stateNameEcho$addStateButton";
    }
//function printStates($number) {
//    $counter = 0;
//    //$stateNameEcho = "<br><label for='stateName' class='alinha'>Estados da natureza:</label>";
//    echo "<label for='stateName' class='alinha'>Estados da natureza:</label>";
//    while ($counter < $number) {
//        $counter++;
//        echo "<input class='stateName' type='text' name='stateName$counter'
//                  placeholder='Estado $counter'>";
//       // echo "<button class='minusState' name='minusState$counter'>-</button>";
//    }
//    echo "<button class='addState' name='addState'>+</button><br>";
//}
//function printStates($number) {
//    $counter = 0;
//    echo "<label for='stateName' class='alinha'>Estados da natureza:</label>";
//    $echoInc = "";
//    while ($counter < $number) {
//        $counter++;
//        $echoInc .= "<input class='stateName' type='text' name='stateName$counter'
//                  placeholder='Estado $counter'>";
//        echo "<input class='stateName' type='text' name='stateName$counter'
//                  placeholder='Estado $counter'>";
//        // echo "<button class='minusState' name='minusState$counter'>-</button>";
//    }
//    echo "<button class='addState' name='addState'>+</button><br>
//          <label for='stateName' class='alinha'>Estados da natureza:</label>
//          $echoInc
//          <button class='addState' name='addState'>+</button><br>";
//}
//    function selectCursos() {
//        global $conexao, $tabelaCurso;
//        $cursos = $conexao->query("SELECT * FROM $tabelaCurso") or exit($conexao->error);
//        if(mysqli_num_rows($cursos) == 0) {
//            echo "<option value=''>Nenhum curso cadastrado</option>
//                  </select>
//                  <p class='error'>Nenhum curso cadastrado, cadastre cursos primeiro antes.</p>";
//            return false;
//        } else {
//            while($registro = $cursos->fetch_array()) {
//                $id = htmlentities($registro[0], ENT_QUOTES, "UTF-8");
//                $curso = htmlentities($registro[1], ENT_QUOTES, "UTF-8");
//                echo "<option value='$id'>$curso</option>";
//            }
//            echo "</select><br><br>";
//            return true;
//        }
//    }