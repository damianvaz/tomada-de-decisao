<?php
require "./includes/mysqlDatabase.inc.php";
require "./includes/util.inc.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title> Projeto Tomada de decisão</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h1>Tomada de decisão</h1>

<form action="main.php" method="post" id="form">

    <?php
    // check if session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_POST['deleteDecision'])){
        require "./includes/excluir.inc.php";
    }
    if(isset($_POST['go'])){
        $_SESSION['decisionId'] = $_POST['decisionName'];
    }

    if(isset($_POST['newDecision'])){

        require "./includes/nova-decisao.inc.php";
    }
    if (handlePost()  AND !isset($_POST['calcular'])) {
        if(isset($_SESSION['decisionId'])){
            echo "Getting from decision ID: " . $_SESSION['decisionId'] . "<br>";
        }
        getFromDB();
//        if(isset($_SESSION['decisionId'])) {
//            echo "decision ID: " . $_SESSION['decisionId'] . "<br>
//            decision Name: " . $_SESSION['decisionName'] . "<br>";
//        }
//
    }


    ?>



    <fieldset class="decisionOuter">
        <fieldset class="decision">
            <legend >Decisão</legend>

            <label for="decisionName"></label>
            <?php
                if(isset($_POST['decisionName'])){
                    $_SESSION['decisionName'] = $_POST['decisionName'];
                    // DO i Need this?
                }

            ?>

            <select class="decisionName" id="decisionName" name="decisionName">
                <?php
                    selectDecisions($_SESSION['user_id']);
                ?>
            </select><br><br>

            <label class="decisionNameLabel" for="name">Nome:</label>
            <?php
         //   echo "<br>decisionID: " . $_SESSION['decisionId'] . "<br>";
                getDecisionName();
            ?>

            <br><br>

            <button class="save" name="saveDecision">Salvar</button>
            <button class="save" name="go">Ver</button>
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
         //   handlePost();

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


    <?php
        if(isset($_POST['calcular'])) {
            require "./includes/calcular.inc.php";
        }
        if(isset($_POST['saveDecision'])){

            require "./includes/salvar.inc.php";
        }

        saveInputs(0,0);

    ?>

</form>

<form action="./includes/logout.inc.php" method="post">
    <fieldset>
        <legend> Desconectar </legend>
        <button class="home"> Logout </button>
    </fieldset>
</form>
</body>
</html>