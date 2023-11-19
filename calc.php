<?php

$connection = mysqli_connect('localhost', 'root', '', 'calc');

if (!$connection) {
    die('Связь не установлена :' . mysqli_connect_error());
}

if (isset($_REQUEST['valueX'])) {
    $x = $_REQUEST['valueX'];
}

if (isset($_REQUEST['valueY'])) {
    $y = $_REQUEST['valueY'];
}

if (isset($_REQUEST['selectOption'])) {
    $operation = $_REQUEST['selectOption'];
}

$resultArray = [
    "operand1" => [],
    "operand2" => [],
    "operation" => [],
    "resultOperation" => [],
    "resultExpression" => []
];

$calculate = '';

if (!empty($x) && !empty($y)) {
    if ($operation == "add") {
        $calculate = $x + $y;
    } elseif ($operation == "-") {
        $calculate = $x - $y;
    } elseif ($operation == "*") {
        $calculate = $x * $y;
    } elseif ($operation == ":") {
        if ($y != 0) {
            $calculate = $x / $y;
        } else {
            $error = "Деление на ноль невозможно";
        }
    }

    mysqli_query($connection, "INSERT INTO results (operand_1, `operation`, operand_2, resault, `result_expression`) VALUES (" . $x . ", '" . $operation . "', " . $y . ", " . $calculate . ", '" . $x . $operation . $y . "=" . $calculate . "');");
}



$queryLastSevenResults = "SELECT `operand_1`,`operation`,`operand_2`,`resault`, `result_expression`  FROM results ORDER BY `id` DESC LIMIT 7";
$resultConnectionLastSeven = mysqli_query($connection, $queryLastSevenResults) or die("Ошибка: " . mysqli_error($connection));

//echo '<pre>';
//print_r($queryLastSevenResults);
//echo '</pre>';
//echo '<pre>';
//print_r($resultConnectionLastSeven);
//echo '</pre>';

if ($resultConnectionLastSeven) {

    $numberOfRows = mysqli_num_rows($resultConnectionLastSeven);

    while ($numberOfRows = mysqli_fetch_assoc($resultConnectionLastSeven)) {
        $resultArray["operand1"][] = $numberOfRows['operand_1'];
        $resultArray["operand2"][] = $numberOfRows['operand_2'];
        $resultArray["operation"][] = $numberOfRows['operation'];
        $resultArray["resultOperation"][] = $numberOfRows['resault'];
        $resultArray["resultExpression"][] = $numberOfRows['result_expression'];
    }
};

$resultArray["operand1"] = join(',', $resultArray["operand1"]);
$resultArray["operand2"] = join(',', $resultArray["operand2"]);
$resultArray["operation"] = join(',', $resultArray["operation"]);
$resultArray["resultOperation"] = join(',', $resultArray["resultOperation"]);
$resultArray["resultExpression"] = join(',', $resultArray["resultExpression"]);


echo json_encode($resultArray);
//echo '<pre>';
//print_r($resultArray);
//echo '</pre>';



?>

