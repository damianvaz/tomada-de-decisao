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
                printAlternative($counter,$_SESSION['states']);
                $counter++;
            }
            $buttonWidth = 15 + (5.5 * $_SESSION['states']);
            $buttonAddAlternative = "<button class='addAlternative' name='addAlternative' style='width:$buttonWidth%'>+</button>";
            $buttonPlaceHolder = "<button class='placeholder'>+</button>";
            echo "$buttonAddAlternative$buttonPlaceHolder";
        ?>
        </div>
    </fieldset>


</form>

</body>
</html>