<?php

require_once ("classes/Calculator.php");
require_once  ("classes/Expression.php");
require_once ("classes/Database.php");

// Проверяем, заполнены ли все поля. Если да, присваиваем их значения соответствующим переменным
if (isset($_REQUEST['valueX'])) {
    $x = $_REQUEST['valueX'];
}

if (isset($_REQUEST['valueY'])) {
    $y = $_REQUEST['valueY'];
}

if (isset($_REQUEST['selectOption'])) {
    $operation = $_REQUEST['selectOption'];
}

$Calculator = new Calculator();
$expression = new Expression();

$result = $Calculator->calculate($x, $y, $operation);

$expression->saveExpression($x, $operation, $y, $result);

$resultArray = $expression->loadResults();

echo json_encode($resultArray);

?>



