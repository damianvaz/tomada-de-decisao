<?php
    function printAlternative($alternativeNumber, $totalAlternatives, $StatesQtd) {
        $alternative = "alternativa $alternativeNumber";
        if(isset($_SESSION['alternativesNames']) AND $alternativeNumber <= count($_SESSION['alternativesNames']) AND $_SESSION['alternativesNames'][$alternativeNumber-1] != "") {
            $alternativeName = "<input class='alternativeName' type='text' name='alternative$alternativeNumber' value='{$_SESSION['alternativesNames'][$alternativeNumber-1]}'>";
        } else {
            $alternativeName = "<input class='alternativeName' type='text' name='alternative$alternativeNumber' placeholder='$alternative'>";
        }
        echo $alternativeName;
        $counter = 0;
        // Printing the inputs for the alternative data
        while($counter < $StatesQtd) {
            $counter++;
            $name = "alternative".$alternativeNumber."state".$counter;
            if(isset($_SESSION['alternativesData'][$alternativeNumber-1]) AND $counter <= count($_SESSION['alternativesData'][$alternativeNumber-1]) AND $_SESSION['alternativesData'][$alternativeNumber-1][$counter-1] != "") {
                echo "<input class='alternativeData' type='number' name='$name' value='{$_SESSION['alternativesData'][$alternativeNumber-1][$counter-1]}'>";
            } else {
                echo "<input class='alternativeData' type='number' name='$name' step='0.01'>";
            }
        }

        // Printing the minus button for the alternative with correct style and position and the highlight for the button
        $bottom = 5 + (($totalAlternatives - $alternativeNumber) * 3.5 );
        $bottom .= "vh";
        $width = (15 + (6.5 * $StatesQtd));
        $totalWidth = 18.5 + (6.5 * $StatesQtd);
        $left = ($totalWidth < 100) ? (100 - $totalWidth)/2: 0;
        $highlight = "<div class='minusAlternativeHighlight minusAlternativeHighlight$alternativeNumber' style='bottom:$bottom;width:$width%;left: $left%'></div>";
        $style = "<style>button.minusAlternative$alternativeNumber:hover + .minusAlternativeHighlight$alternativeNumber{ display: block }</style>";
        $atribute = "minusAlternative$alternativeNumber";
        $buttonMinusAlternative = "<button class='minusAlternative $atribute' name='$atribute'>-</button>";
        echo "$buttonMinusAlternative$highlight$style<br>";
    }
    function printStates($StatesNumber, $alternativesNumber) {
        $counter = 0;
        $addStateButton = "<button class='addState' name='addState'>+</button><br>";
        $placeholderButton = "<button class='placeholder'>+</button><br>";
        $labelStateName = "<label for='stateName' class='alinha'>Estados da natureza:</label>";


        echo "<label class='placeholder'>-</label>";
        $stateNameEcho = $labelStateName;
        $height = (4 + (3.5 * $alternativesNumber));
        $height .= "vh";
        $totalWidth = (18.5 + (6.5 * $StatesNumber));

        if($totalWidth > 100) {
            $left = 15.5;
        } else {
            $left = 15.5 + (100 - $totalWidth)/2;
        }

        // Prints the minus buttons for the states with correct style and position, and also prepares the text for the states input to echo after
        while ($counter < $StatesNumber) {
            $counter++;
            $style = "<style>button.minusState$counter:hover + .minusStateHighlight$counter{ display: block; }</style>";
            $buttonMinusState = "<button class='minusState minusState$counter' name='minusState$counter'>-</button>";
            $highlight = "<div class='minusStateHighlight minusStateHighlight$counter' style='height:$height;left:$left%'></div>";
            echo "$buttonMinusState$highlight$style";
            $left += 6.5;
            if(isset($_SESSION['statesNames']) AND $counter <= count($_SESSION['statesNames']) AND $_SESSION['statesNames'][$counter-1] != "") {
                $stateNameEcho .= "<input class='stateName' type='text' name='stateName$counter' value='{$_SESSION['statesNames'][$counter-1]}'>";
            } else {
                $stateNameEcho .= "<input class='stateName' type='text' name='stateName$counter' placeholder='Estado $counter'>";
            }
        }

        // Prints placeholder button to space correctly after the minus state buttons, then prints the inputs for the states names, and finally prints the add state button
        echo "$placeholderButton$stateNameEcho$addStateButton";
    }
    function handlePost() {
        if(isset($_POST['addState'])) {
            saveInputs(0, 0);
            $_SESSION['states']++;
        }
        if(isset($_POST['addAlternative'])) {
            saveInputs(0, 0);
            $_SESSION['alternatives']++;
        }
        if(isset($_SESSION['states'])) {
            $counter = 0;
            while ($counter < $_SESSION['states']) {
                $counter++;
                $atribute = "minusState$counter";
                if(isset($_POST[$atribute])) {
                    saveInputs($counter, 0);
                    $_SESSION['states']--;
                }
            }
        }
        if(isset($_SESSION['alternatives'])) {
            $counter = 0;
            while ($counter < $_SESSION['alternatives']) {
                $counter++;
                $atribute = "minusAlternative$counter";
                if(isset($_POST[$atribute])) {
                    saveInputs(0, $counter);
                    $_SESSION['alternatives']--;
                }
            }
        }
    }
    function saveInputs($skipState, $skipAlternative) {

        // Saving the inputs for the states names
       $statesNames = array();
       $alternativesNames = array();
       $alternativesData = array();
        for($i= 1; $i <= $_SESSION['states']; $i++) {
            if ($i == $skipState) {
                continue;
            }
            $atribute = "stateName$i";
            if(isset($_POST[$atribute])) {
                $statesNames[] = $_POST[$atribute];
            }
            for($j = 1; $j <= $_SESSION['alternatives']; $j++) {
                if($j == $skipAlternative) {
                    continue;
                }
                $atribute = "alternative$j";
                if($i==1 AND isset($_POST[$atribute])) {
                    $alternativesNames[] = $_POST[$atribute];
                }
                // if button minus alternative was clicked, we only save the inputs for the next line next in the array
                $line = ($j > $skipAlternative AND $skipAlternative != 0) ? $j -2 : $j -1;
                $atribute = "alternative".$j."state".$i;
                if(isset($_POST[$atribute])) {
                    $alternativesData[$line][] = $_POST[$atribute];
                }
            }
        }
        $_SESSION['statesNames'] = $statesNames;
        $_SESSION['alternativesNames'] = $alternativesNames;
        $_SESSION['alternativesData'] = $alternativesData;
    }
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