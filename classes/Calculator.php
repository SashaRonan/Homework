<?php

require_once ("Database.php");
class Calculator extends Database
{
    function calculate($x, $y, $operation)
    {

        $result = '';
        if (!empty($x) && !empty($y)) {
            if ($operation == "add") {
                $result = $x + $y;
//                $operation = urldecode($operation);
                $operation = Database::encodedOperationSymbol($operation);
            } elseif ($operation == "-") {
                $result = $x - $y;
            } elseif ($operation == "*") {
                $result = $x * $y;
            } elseif ($operation == ":") {
                if ($y != 0) {
                    $result = $x / $y;
                } else {
                    $error = "Деление на ноль невозможно";
                }
            }
        }
        return $result;
    }
}