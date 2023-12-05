<?php
require "./includes/mysqlDatabase.inc.php";
require "./includes/util.inc.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title> Projeto Tomada de decisão </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h1>Tomada de decisão</h1>

<form action="main.php" method="post" id="form">
    <fieldset class="decisionOuter">
        <fieldset class="decision">
            <legend >Decisão</legend>

            <label for="decisionName"></label>
            <select class="decisionName" id="decisionName" name="decisionName">
                <!--TODO - Puxar do banco de dados-->
                <option>Decisão 1</option>
                <option>Decisão 2</option>
            </select> <br><br>

            <label class="decisionNameLabel" for="name">Nome:</label>
            <input class="decisionNameIn" type="text" name="name" id="name" value="Decisão 1">
            <br><br>
            <button class="save" name="saveDecision">Salvar</button>
        </fieldset>
        <div class="buttons">
            <button class="decisionButtonTop" name="newDecision">Nova decisão</button>
            <button class="decisionButtonMiddle" name="deleteDecision">Excluir decisão</button>
            <button class="decisionButtonBottom" name="calcular">Calcular</button>
        </div>

    </fieldset>

    <fieldset>
        <legend>Entrar com dados</legend>
        <div class="enterData">
        <?php
            session_start();
            handlePost();
            $states = $_SESSION['states'] = (isset($_SESSION['states']) ? $_SESSION['states'] : 3);
            $alternatives = $_SESSION['alternatives'] = (isset($_SESSION['alternatives']) ? $_SESSION['alternatives'] :5);

            printStates($states, $alternatives);

            $counter = 1;
            while ($counter <= $alternatives) {
                printAlternative($counter, $_SESSION['alternatives'], $_SESSION['states']);
                $counter++;
            }
            $buttonWidth = 15 + (9.5 * $_SESSION['states']);
            $buttonAddAlternative = "<button class='addAlternative' name='addAlternative' style='width:$buttonWidth%'>+</button>";
            $buttonPlaceHolder = "<button class='placeholder'>+</button>";
            echo "$buttonAddAlternative$buttonPlaceHolder";
        ?>
        </div>
    </fieldset>


</form>

</body>
</html>