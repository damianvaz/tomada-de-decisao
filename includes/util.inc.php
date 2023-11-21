<?php
    function printAlternative($alternativeNumber, $StatesQtd) {
        $alternative = "alternativa $alternativeNumber";

        echo "<input class='alternativeName' type='text' name='$alternative' placeholder='$alternative'>";
        $counter = 0;
        // Printing the inputs for the alternative data
        while($counter < $StatesQtd) {
            $counter++;
            $name = "alternative".$alternativeNumber."state".$counter;
            echo "<input class='alternativeData' type='text' name='$name'>";
        }

        // Printing the minus button for the alternative with correct style and position and the highlight for the button
        $top = 60 + (22 * $alternativeNumber);
        $top .= "px";
        $width = (15 + (5.5 * $StatesQtd));
        $totalWidth = (18.5 + (5.5 * $StatesQtd));
        $left = (100 - $totalWidth)/2;
        $highlight = "<div class='minusAlternativeHighlight minusAlternativeHighlight$alternativeNumber' style='top:$top;width:$width%;left: $left%'></div>";
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
        //$height = ((19 * $alternativesNumber));
        $height = (30 + (22 * $alternativesNumber));
        $height .= "px";
        $totalWidth = (18.5 + (5.5 * $StatesNumber));

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
            $left += 5.5;
            $stateNameEcho .= "<input class='stateName' type='text' name='stateName$counter' placeholder='Estado $counter'>";
        }

        // Prints placeholder button to space correctly after the minus state buttons, then prints the inputs for the states names, and finally prints the add state button
        echo "$placeholderButton$stateNameEcho$addStateButton";
    }
    function handlePost() {
        if(isset($_POST['addState'])) {
            $_SESSION['states']++;
        }
        if(isset($_POST['addAlternative'])) {
            $_SESSION['alternatives']++;
        }
        if(isset($_SESSION['states'])) {
            $counter = 0;
            while ($counter < $_SESSION['states']) {
                $counter++;
                $atribute = "minusState$counter";
                if(isset($_POST[$atribute])) {
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
                    $_SESSION['alternatives']--;
                }
            }
        }
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