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
        $width = (15 + (9.5 * $StatesQtd));
        $totalWidth = 18.5 + (9.5 * $StatesQtd);
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
        $totalWidth = (18.5 + (9.5 * $StatesNumber));

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
            $left += 9.5;
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
            return false;
        }
        if(isset($_POST['addAlternative'])) {
            saveInputs(0, 0);
            $_SESSION['alternatives']++;
            return false;
        }
        if(isset($_POST['calcular']) OR isset($_POST['saveDecision'])) {
            saveInputs(0, 0);
        }
        if(isset($_SESSION['states'])) {
            $counter = 0;
            while ($counter < $_SESSION['states']) {
                $counter++;
                $atribute = "minusState$counter";
                if(isset($_POST[$atribute])) {
                    saveInputs($counter, 0);
                    $_SESSION['states']--;
                    return false;
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
                    return false;
                }
            }
        }
        return true;
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
                } else {
                    $alternativesData[$line][] = "";
                }
            }
        }
        $_SESSION['statesNames'] = $statesNames;
        $_SESSION['alternativesNames'] = $alternativesNames;
        $_SESSION['alternativesData'] = $alternativesData;

    }

    function insertInputs() {
        global $conexao;
        $decisionId = $_POST['decisionName'];

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
    }
    function selectDecisions($user) {
        global $conexao;
        $decisoes = $conexao->query("SELECT * FROM decision WHERE user_id = $user") or exit($conexao->error);
        // TODO take this out once the decision id is always made by here
        if(mysqli_num_rows($decisoes) == 0) {
            $conexao->query("INSERT INTO decision (user_id, name) VALUES ($user, 'Decisão 1')") or exit($conexao->error);
        }
        $decisoes = $conexao->query("SELECT * FROM decision WHERE user_id = $user") or exit($conexao->error);
        $number = mysqli_num_rows($decisoes);
        $counter = 0;
        while($registro = $decisoes->fetch_array()) {
            $counter++;
            $id = htmlentities($registro[0], ENT_QUOTES, "UTF-8");
            $decisao = htmlentities($registro[1], ENT_QUOTES, "UTF-8");

            if($counter == $number AND (isset($_POST['newDecision']) OR isset($_POST['deleteDecision']))) {
                echo "<option value='$id' selected>$decisao</option>";
                $_SESSION['decisionId'] = $id;
            } else if(isset($_SESSION['decisionName'])) {
                if($id == $_SESSION['decisionName']) {
                    echo "<option value='$id' selected>$decisao</option>";
                    $_SESSION['decisionId'] = $id;
                } else {
                    echo "<option value='$id'>$decisao</option>";
                }
            } else {
                echo "<option value='$id'>$decisao</option>";
                $_SESSION['decisionName'] = $decisao;
            }
        }
    }

    function userSession(string $login, mysqli $conexao): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['conectado'] = true;
        $_SESSION['user'] = $login;

        // get user id
        $sql = "SELECT id FROM user WHERE login = '$login'";
        $resultado = $conexao->query($sql) or die($conexao->error);
        $vetorRegistro = $resultado->fetch_array();
        $userId = $vetorRegistro[0];
        $_SESSION['user_id'] = $vetorRegistro[0];
        echo "login: $login <br>UserId: $userId <br>";

        // get decisionid
        $sql = "SELECT id FROM decision WHERE user_id = '$userId' ORDER BY id DESC LIMIT 1";
        $resultado = $conexao->query($sql) or die($conexao->error);
        $vetorRegistro = $resultado->fetch_array();
        // check if the query returned any results
        if(mysqli_num_rows($resultado) > 0) {
            $decisionId = $vetorRegistro[0];
            $_SESSION['decisionId'] = $vetorRegistro[0];
            echo "login: $login <br>UserId: $userId <br> DecisionId: $decisionId <br>";
            return true;
        } else {
            return false;
        }
    }

    function makeFirstDecision() {
        global $conexao;
        $userId = $_SESSION['user_id'];
        $conexao->query("INSERT INTO decision (user_id, name) VALUES ($userId, 'Decisão 1')") or exit($conexao->error);
        $sql = "SELECT id FROM decision WHERE user_id = '$userId' ORDER BY id DESC LIMIT 1";
        $resultado = $conexao->query($sql) or die($conexao->error);
        $vetorRegistro = $resultado->fetch_array();
        $_SESSION['decisionId'] = $vetorRegistro[0];
        // TODO
}

    function unsetSessionVars() {
        unset($_SESSION['states']);
        unset($_SESSION['statesNames']);
        unset($_SESSION['alternatives']);
        unset($_SESSION['alternativesNames']);
        unset($_SESSION['alternativesData']);
    }

    function getDecisionName() {
        global $conexao;
        $sql = "SELECT name FROM decision WHERE user_id = '$_SESSION[user_id]'";

        if (isset($_POST['decisionName']) AND !isset($_POST['newDecision']) AND !isset($_POST['deleteDecision'])) {
            $sql .= " AND id = '$_POST[decisionName]'";
        }
        $resultado = $conexao->query($sql) or die($conexao->error);
        $vetorDecisionName = array();

        foreach($resultado as $indice => $valor) {
            $vetorDecisionName[$indice] = $valor['name'];
            // TODO Test when the user logs fresh (no session vars set) if this works
        }

        $numberOfDecisions = mysqli_num_rows($resultado) - 1;

        echo "<input class='decisionNameIn' type='text' name='name' id='name' value='$vetorDecisionName[$numberOfDecisions]'>";
    }

    function getFromDB() {
        // Getting the nature_state
        global $conexao;
        $decisionId = $_SESSION['decisionId'];
        $sql = "SELECT name FROM nature_state WHERE decision_id = $decisionId";
        $resultado = $conexao->query($sql) or die($conexao->error);
        // check if the query returned any results
        if(mysqli_num_rows($resultado) > 0) {
            $states = array();
            while($registro = $resultado->fetch_array()) {
                $states[] = $registro[0];
            }
            $_SESSION['states'] = count($states);
            $_SESSION['statesNames'] = $states;
        }

        // getting alternatives
        $sql = "SELECT name FROM alternative WHERE decision_id = $decisionId";
        $resultado = $conexao->query($sql) or die($conexao->error);
        // check if the query returned any results
        if(mysqli_num_rows($resultado) > 0) {
            $alternatives = array();
            while($registro = $resultado->fetch_array()) {
                $alternatives[] = $registro[0];
            }
            $_SESSION['alternatives'] = count($alternatives);
            $_SESSION['alternativesNames'] = $alternatives;

            // getting alternative_nature_state
            for($i = 1; $i <= $_SESSION['alternatives']; $i++) {
                for($j = 1; $j <= $_SESSION['states']; $j++) {
                    $sql = "SELECT value FROM alternative_nature_state WHERE alternative_id = $i AND nature_state_id = $j";
                    $resultado = $conexao->query($sql) or die($conexao->error);
                    // check if the query returned any results
                    if(mysqli_num_rows($resultado) > 0) {
                        $registro = $resultado->fetch_array();
                        $_SESSION['alternativesData'][$i-1][$j-1] = $registro[0];
                        //$_SESSION['alternativesData'][$i][$j] = $registro[0];
                    }
                }
            }
        }

    }
