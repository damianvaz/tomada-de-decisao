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

<form action="main.php" method="post">
    <fieldset>
        <div class="enterData">
        <legend>Entrar com dados</legend>

        <?php
            session_start();
            $_SESSION['states'] = (isset($_SESSION['states']) ? $_SESSION['states'] : 3);
            $_SESSION['alternatives'] = (isset($_SESSION['alternatives']) ? $_SESSION['alternatives'] : 3);

            if (isset($_POST['addAlternative'])) {
                $alternatives = $_SESSION['alternatives'] + 1;
                $_SESSION['alternatives'] = $alternatives;
            }


            if (isset($_POST['addState'])) {
                $states = $_SESSION['states'] + 1;
                $_SESSION['states'] = $states;
            }
            printStates($_SESSION['states'], $_SESSION['alternatives']);

            $counter = 0;
            while ($counter < $_SESSION['alternatives']) {
                $counter++;
                printAlternative($counter,$_SESSION['states']);
            }
            $buttonWidth = 15 + (5.5 * $_SESSION['states']);
            echo "<button class='addAlternative' name='addAlternative' style='width:$buttonWidth%'>+</button><button class='placeholder'>+</button><br>";
        ?>
        </div>
    </fieldset>



</form>

</body>
</html>