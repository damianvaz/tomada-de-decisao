<?php
require "./includes/tddFuncctions.inc.php";

$numRows = $_SESSION['alternatives'];
$numCols = $_SESSION['states'];
// check if any of the data is empty
for($i = 0; $i < $numRows; $i++) {
    for($j = 0; $j < $numCols; $j++) {
        if($_SESSION['alternativesData'][$i][$j] == "") {
            echo "<p class='error'>Por favor, preencha todos os campos!</p>";
            exit();
        }
    }
}
    require 'salvar.inc.php';

    echo "<fieldset>
             <legend>Resultados</legend>
             <h3>Maximax</h3>
             <p>    O método Maximax é uma abordagem na tomada de decisões que busca maximizar o benefício máximo possível em situações de incerteza. <br>Essa estratégia envolve a avaliação das diferentes opções disponíveis e a seleção daquela que oferece o melhor resultado esperado em termos de ganho máximo.
O método Maximax é particularmente aplicado em ambientes em que o tomador de decisão está disposto a assumir riscos elevados para buscar os maiores benefícios possíveis. No entanto, essa abordagem pode ser criticada por não considerar as possíveis perdas associadas às decisões, focando exclusivamente nos resultados mais otimistas.

</p>";

    maximax();

    echo "<h3>Maximin</h3>
             <p>Visa minimizar as perdas potenciais em situações de incerteza. Essa estratégia envolve a análise das opções disponíveis e a seleção daquela que oferece o menor resultado esperado em termos de perda mínima. O método maximin é frequentemente utilizado em ambientes nos quais o tomador de decisão deseja mitigar o risco e as consequências adversas associadas às escolhas. Ele se concentra em identificar a pior situação possível para cada decisão e escolher a opção que minimiza o impacto negativo, mesmo que isso signifique sacrificar algum potencial de ganho máximo. Essa abordagem é especialmente valiosa em contextos nos quais as perdas têm implicações mais significativas do que os ganhos.</p>";
    maximin();

    echo "<h3>Laplace</h3>
             <p>O método de Laplace, na tomada de decisão, é uma abordagem que visa equilibrar as expectativas em situações de incerteza. Também conhecido como o princípio da igualdade das probabilidades, o método de Laplace pressupõe que todas as opções possíveis têm a mesma probabilidade de ocorrer. Ao calcular a média aritmética dos resultados para cada opção, o tomador de decisão pode tomar uma decisão baseada na expectativa média. Este método é frequentemente aplicado em situações onde não há informações suficientes para atribuir probabilidades precisas e o tomador de decisão opta por uma abordagem mais neutra, considerando todas as opções como igualmente prováveis. No entanto, a simplicidade do método de Laplace pode ser uma limitação em cenários mais complexos e informativos.</p>";
   laplace();

    echo "<h3>Média variabilidade</h3>
             <p>O método da média-variabilidade, na tomada de decisão, é uma abordagem que busca equilibrar a média dos resultados com a variabilidade associada a cada opção disponível. Ao contrário de algumas técnicas que focam apenas na maximização de ganhos ou minimização de perdas, o método da média-variabilidade considera tanto a média quanto a dispersão dos resultados. Ele procura opções que, além de proporcionar uma média satisfatória, apresentam uma variabilidade controlada, oferecendo uma visão mais abrangente do risco associado a cada escolha. Isso torna o método da média-variabilidade uma abordagem mais equilibrada ao lidar com a incerteza, buscando resultados consistentes e previsíveis.</p>";
    averageVariability();

    echo "<h3>Savage</h3>
             <p>O método de Savage, também conhecido como Critério de Mínimo Arrependimento, é uma abordagem na tomada de decisões sob condições de incerteza. Esse método destaca o conceito de minimizar o arrependimento associado a cada decisão tomada. Em vez de se concentrar apenas nas probabilidades dos resultados, o método de Savage considera as consequências futuras percebidas e como o tomador de decisões poderia se arrepender de suas escolhas. Ele envolve a construção de uma tabela de arrependimento que compara as perdas associadas a cada combinação possível de decisões e resultados. O tomador de decisões escolhe a opção que minimiza o arrependimento máximo esperado, oferecendo uma abordagem cautelosa que leva em conta as consequências emocionais e psicológicas de cada decisão possível.</p>";
    savage();

    echo "<h3>Hurwicz</h3>
                 <p>O método de Hurwicz é uma abordagem na tomada de decisões que busca equilibrar otimismo e pessimismo em ambientes de incerteza. Proposto por Abraham Hurwicz, esse método utiliza um parâmetro chamado coeficiente de otimismo, que varia entre 0 e 1. Ao avaliar as opções disponíveis, o tomador de decisões calcula uma pontuação ponderada para cada alternativa, combinando o resultado máximo e mínimo possível para cada escolha com base no coeficiente de otimismo. Essa abordagem permite que o tomador de decisões ajuste o nível de aversão ao risco, ponderando a importância tanto dos resultados mais otimistas quanto dos mais pessimistas. O método de Hurwicz proporciona uma flexibilidade útil na tomada de decisões, permitindo que o decisor ajuste a sua postura em relação ao risco com base em sua propensão individual para o otimismo ou pessimismo.
</p>";
    // hurwicz();

echo "</fieldset>";


//    echo "<table>
//          <caption>New Table </caption>
//          <tr>";

//    for($i = 0; $i < $numCols; $i++) {
//        $states = $_SESSION['statesNames'];
//        if ($i == 0) {
//            echo "<th>Alternatives</th>";
//        }
//        $statename = $states[$i];
//        if ($statename == "") {
//            $num = $i + 1;
//            $statename = "State $num";
//        }
//        echo "<th>$statename</th>";
//    }
//    echo "</tr>";
//    for($i = 0; $i < $numRows; $i++) {
//        echo "<tr>";
//        for($j = 0; $j <= $numCols; $j++) {
//            $atribute = "";
//            if ($j == 0) {
//                $alternativeName = $_SESSION['alternativesNames'][$i];
//                if($alternativeName == "") {
//                    $num = $i + 1;
//                    $atribute = "Alternative $num";
//                } else {
//                    $atribute = $_SESSION['alternativesNames'][$i];
//                }
//            } else {
//                $col = $j - 1;
//                $atribute = $_SESSION['alternativesData'][$i][$col];
//            }
//            echo "<td>$atribute</td>";
//        }
//        echo "</tr>";
//
//    }
//echo "</tr>";
//echo "</table>";

//echo "<table>
//          <caption>New Table </caption>
//          <tr>";
//
//    for($i = 0; $i < $numCols; $i++) {
//        $states = array();
//        $sql = "SELECT name FROM nature_state WHERE decision_id = $decisionId";
//        $resultado = $conexao->query($sql) or die($conexao->error);
//        while($registro = $resultado->fetch_array()) {
//            $states[] = $registro[0];
//        }
//        if ($i == 0) {
//            echo "<th>Alternatives</th>";
//        }
//        $statename = $states[$i];
//        if ($statename == "") {
//            $num = $i + 1;
//            $statename = "State $num";
//        }
//        echo "<th>$statename</th>";
//    }
//    echo "</tr>";
//    for($i = 0; $i < $numRows; $i++) {
//        echo "<tr>";
//        for($j = 0; $j <= $numCols; $j++) {
//            $atribute = "";
//            if ($j == 0) {
//                //$alternativeName = $_SESSION['alternativesNames'][$i];
//                $sql = "SELECT name FROM alternative WHERE decision_id = $decisionId";
//                $resultado = $conexao->query($sql) or die($conexao->error);
//                $alternatives = array();
//                while($registro = $resultado->fetch_array()) {
//                    $alternatives[] = $registro[0];
//                }
//                if($alternatives[$i] == "") {
//                    $num = $i + 1;
//                    $atribute = "Alternative $num";
//                } else {
//                    $atribute = $alternatives[$i];
//                }
//            } else {
//                $col = $j - 1;
//                $sql = "SELECT value FROM alternative_nature_state WHERE alternative_id = $alternativeId AND nature_state_id = $natureStateId[$col]";
//                //$atribute = $_SESSION['alternativesData'][$i][$col];
//                echo "<td>$sql</td>";
////                $resultado = $conexao->query($sql) or die($conexao->error);
////                $resultado->fetch_array();
//              //  print_r($resultado);
//                //$atribute = $resultado[0];
//
//            }
//            echo "<td>$atribute</td>";
//        }
//        echo "</tr>";
//
//    }
//echo "</tr>";
//echo "</table>";