<?php
    function maximax() {
        $numRows = $_SESSION['alternatives'];
        $numCols = $_SESSION['states'];
        $data = $_SESSION['alternativesData'];
        $maximax = array();
        $max = 0;
        $bestValueRow = 0;
        $bestValueCol = 0;
        for($i = 0; $i < $numRows; $i++) {
            $alternativeMax = 0;
            for($j = 0; $j < $numCols; $j++) {
                if ($data[$i][$j] > $alternativeMax) {
                    $alternativeMax = $data[$i][$j];
                    $bestValueRow = $i;
                    $bestValueCol = $j;
                }
                if($data[$i][$j] > $max) {
                    $max = $data[$i][$j];
                }
            }
            $maximax[$i] = $alternativeMax;
        }

        printTable($maximax, $max, "Maximax", "Maior");
        echo "<br><br>
        <h4 class='result'>Melhor alternativa: " . $_SESSION['alternativesNames'][$bestValueRow] . "<br>Valor esperado: $max</h4>";

    }

    function printTable($vector, $max, $caption, $lastColName) {
        echo "<table>
          <caption>$caption</caption>
          <tr>";
        $numRows = $_SESSION['alternatives'];
        $numCols = $_SESSION['states'] + 1;
        for($i = 0; $i < $numCols; $i++) {
            $states = $_SESSION['statesNames'];
            if ($i == 0) {
                echo "<th>Alternatives</th>";
            }
            if($i == $numCols - 1) {
                echo "<th>$lastColName</th>";
            } else {
                $statename = $states[$i];
                if ($statename == "") {
                    $num = $i + 1;
                    $statename = "State $num";
                }
                echo "<th>$statename</th>";
            }
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
                } else if($j == $numCols) {
                    if($vector[$i] == $max) {
                        $atribute = "<mark>" . $vector[$i] . "</mark>";
                    } else {
                        $atribute = $vector[$i];
                    }

                } else {
                    $col = $j - 1;

                    if ($_SESSION['alternativesData'][$i][$col] == $vector[$i]) {
                        $atribute = "<span>" . $_SESSION['alternativesData'][$i][$col] . "</span>";
                    } else {
                        $atribute = $_SESSION['alternativesData'][$i][$col];
                    }
                }
                echo "<td>$atribute</td>";
            }
            echo "</tr>";

        }
        echo "</tr>";
        echo "</table>";
    }

    function maximin() {
        $numRows = $_SESSION['alternatives'];
        $numCols = $_SESSION['states'];
        $data = $_SESSION['alternativesData'];
        $maxmin = array();
        $maxOfMin = 0;
        $bestValueRow = 0;
        $bestValueCol = 0;
        for($i = 0; $i < $numRows; $i++) {
            $alternativeMin = INF;
            for ($j = 0; $j < $numCols; $j++) {
                if ($data[$i][$j] < $alternativeMin) {
                    $alternativeMin = $data[$i][$j];
                    $bestValueRow = $i;
                    $bestValueCol = $j;
                }
            }
            $maxmin[$i] = $alternativeMin;
            if($alternativeMin > $maxOfMin) {
                $maxOfMin = $alternativeMin;
            }
        }
        printTable($maxmin, $maxOfMin, "Maximin", "Menor");
        echo "<br><br>
        <h4 class='result'>Melhor alternativa: " . $_SESSION['alternativesNames'][$bestValueRow] . "<br>Valor esperado: $maxOfMin</h4>";
    }

    function laplace() {
        $numRows = $_SESSION['alternatives'];
        $numCols = $_SESSION['states'];
        $data = $_SESSION['alternativesData'];
        $laplace = array();
        $bestValueRow = 0;
        $bestValueCol = 0;
        $maxOfLaplace = 0;
        for($i = 0; $i < $numRows; $i++) {
            $alternativeLaplace = 0;
            for ($j = 0; $j < $numCols; $j++) {
                $alternativeLaplace += $data[$i][$j];
            }
            $alternativeLaplace /= $numCols;
            $laplace[$i] = $alternativeLaplace;
            if($alternativeLaplace > $maxOfLaplace) {
                $maxOfLaplace = $alternativeLaplace;
                $bestValueRow = $i;
            }
        }
        // Format numbers
        for($i = 0; $i < $numRows; $i++) {
            $laplace[$i] = number_format($laplace[$i], 2, '.', '');
        }
        $maxOfLaplace = number_format($maxOfLaplace, 2, '.', '');

        printTable($laplace, $maxOfLaplace, "Laplace", "Média");
        echo "<br><br>
        <h4 class='result'>Melhor alternativa: " . $_SESSION['alternativesNames'][$bestValueRow] . "<br>Valor esperado: $maxOfLaplace</h4>";
    }
    function averageVariability() {
        $numRows = $_SESSION['alternatives'];
        $numCols = $_SESSION['states'];
        $data = $_SESSION['alternativesData'];
        $averageVariability = array();
        $bestValueRow = 0;
        $bestValueCol = 0;
        $maxOfAverageVariability = 0;
        for($i = 0; $i < $numRows; $i++) {
            $average = 0;
            $maxValue = 0;
            $minValue = INF;
            for ($j = 0; $j < $numCols; $j++) {
                $average += $data[$i][$j];
                if($data[$i][$j] > $maxValue) {
                    $maxValue = $data[$i][$j];
                }
                if($data[$i][$j] < $minValue) {
                    $minValue = $data[$i][$j];
                }
            }
            $average /= $numCols;
            $averageVariability[$i] = $average/($maxValue - $minValue);
            if($averageVariability[$i] > $maxOfAverageVariability) {
                $maxOfAverageVariability = $averageVariability[$i];
                $bestValueRow = $i;
            }
        }
        // Format numbers
        for($i = 0; $i < $numRows; $i++) {
            $averageVariability[$i] = number_format($averageVariability[$i], 2, '.', '');
        }
        $maxOfAverageVariability = number_format($maxOfAverageVariability, 2, '.', '');

        printTable($averageVariability, $maxOfAverageVariability, "Average Variability", "Média/Max-min");
        echo "<br><br>
        <h4 class='result'>Melhor alternativa: " . $_SESSION['alternativesNames'][$bestValueRow] . "<br>Valor esperado: $maxOfAverageVariability</h4>";
    }
    function savage() {
        $numRows = $_SESSION['alternatives'];
        $numCols = $_SESSION['states'];
        $data = $_SESSION['alternativesData'];
        $savage = array();
        $bestValueRow = 0;
        $bestValueCol = 0;
        $minOfSavage = INF;

        $maxValues = array();
        for($j = 0; $j < $numCols; $j++) {
            // Getting max value of each column
            $maxCol = 0;
            for ($i = 0; $i < $numRows; $i++) {
                if ($data[$i][$j] > $maxCol) {
                    $maxCol = $data[$i][$j];
                }
            }
            $maxValues[] = $maxCol;
        }
        // Setting minimum regret matrix
            $minRegret = array();
            // Num cols of the states minus 1 for the alternative names
            $numCols = $_SESSION['states'];

            $maxLineValue = array();
            $minOfSavage = INF;
            for($i = 0; $i < $numRows; $i++) {
                $line = array();
                $maxCol = 0;

                for ($j = 0; $j < $numCols; $j++) {
                    $line[] = $maxValues[$j] - $data[$i][$j];
                    if($maxValues[$j] - $data[$i][$j] > $maxCol) {
                        $maxCol = $maxValues[$j] - $data[$i][$j];
                    }
                }
                $maxLineValue[] = $maxCol;
                $minRegret[] = $line;
            }
            // Getting minimum value of maxLineValue
            for($i = 0; $i < $numRows; $i++) {
                if($maxLineValue[$i] < $minOfSavage) {
                    $minOfSavage = $maxLineValue[$i];
                    $bestValueRow = $i;
                }
            }

            // Printing minimum regrets table
            echo "<table>
            <caption>Matriz mínimo arrependimento</caption>
            <tr>";
for($i = 0; $i <= $numCols; $i++) {
                $states = $_SESSION['statesNames'];
                if ($i == 0) {
                    echo "<th>Alternatives</th>";
                }
                if($i == $numCols) {
                    echo "<th>Mínimo arrependimento</th>";
                } else {
                    $statename = $states[$i];
                    if ($statename == "") {
                        $num = $i + 1;
                        $statename = "State $num";
                    }
                    echo "<th>$statename</th>";
                }
            }
            echo "</tr>";

            $numCols++; // because I'm adding a col
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
                    } else if($j == $numCols) {
                        if($maxLineValue[$i] == $minOfSavage) {
                            $atribute = "<mark>" . $maxLineValue[$i] . "</mark>";
                        } else {
                            $atribute = $maxLineValue[$i];
                        }

                    } else {
                        $col = $j - 1;

                        $cell = $maxValues[$col] - $data[$i][$col];


                        if ($cell == $maxLineValue[$i]) {
                            $atribute = "<span>" . $cell . "</span>";
                        } else {
                            $atribute = $cell;
                        }
                    }
                    echo "<td>$atribute</td>";
                }
                echo "</tr>";
            }
            echo "</tr>";
            echo "</table>";

        echo "<br><br>
        <h4 class='result'>Melhor alternativa: " . $_SESSION['alternativesNames'][$bestValueRow] . "<br>Valor esperado: $minOfSavage</h4>";

    }