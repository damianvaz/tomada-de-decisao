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

        $top = 60 + (22 * $alternativeNumber);
        $top .= "px";
        $width = (13.5 + (5.5 * $StatesQtd));
        $left = 0 + (100 - $width)/2;
        $highlight = "<div class='minusAlternativeHighlight minusAlternativeHighlight$alternativeNumber' style='top:$top;width:$width%;left: $left%'></div>";
        $style = "<style>button.minusAlternative$alternativeNumber:hover + .minusAlternativeHighlight$alternativeNumber{ display: block }</style>";
        echo "<button class='minusAlternative minusAlternative$alternativeNumber' name='minusAlternative$alternativeNumber'>-</button>$highlight$style<br>";
    }
    function printStates($StatesNumber, $alternativesNumber) {
        $counter = 0;
        $addStateButton = "<button class='addState' name='addState'>+</button><br>";
        $placeholderButton = "<button class='placeholder'>+</button><br>";
        $labelStateName = "<label for='stateName' class='alinha'>Estados da natureza:</label>";


        echo "<label class='placeholder'>-</label>";
        $stateNameEcho = $labelStateName;
        $height = (30 + (21 * $alternativesNumber));
        $height .= "px";
        $width = (18.5 + (5.5 * $StatesNumber));

        if($width > 100) {
            $left = 15.5;
        } else {
            $left = 15.5 + (100 - $width)/2;
        }

        // Prints the minus buttons for the states with corret style and position, and also prepares the text for the states input to echo after
        while ($counter < $StatesNumber) {
            $counter++;
            $style = "<style>button.minusState$counter:hover + .minusStateHighlight$counter{ display: block; }</style>";
            $buttonMinusState = "<button class='minusState minusState$counter' name='minusState$counter'>-</button>";
            $highlight = "<div class='minusStateHighlight minusStateHighlight$counter' style='height:$height;left:$left%'></div>";
            echo "$buttonMinusState$highlight$style";
            $left += 5.5;
            $stateNameEcho .= "<input class='stateName' type='text' name='stateName$counter' placeholder='Estado $counter'>";
        }

        // Prints placeholder button to space correctly after the minus state buttons, then prints the inputs for the states names, and finally prints the add state button
        echo "$placeholderButton$stateNameEcho$addStateButton";
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