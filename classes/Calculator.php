<?php

class Calculator
{
    function calculate($x, $y, $operation)
    {

        $result = '';
        if (!empty($x) && !empty($y)) {
            if ($operation == "+") {
                $result = $x + $y;
                $operation = urldecode($operation);
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