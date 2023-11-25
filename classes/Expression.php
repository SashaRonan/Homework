<?php

require_once ("Database.php");
class Expression extends Database
{
    public function __construct (){
        Database::connect();
    }
    function saveExpression($x, $operation, $y, $result)
    {
        $result_expression = $x . $operation . $y . "=" . $result;
        Database::query("INSERT INTO results (operand_1, `operation`, operand_2, resault, `result_expression`) VALUES ('$x', '$operation', '$y', '$result', '$result_expression')");
    }

    function loadResults()
    {
        //Присваиваем переменной строчку, которая соответствует SQL запросу на выборку последних семи результатов
        $queryLastSevenResults = "SELECT `operand_1`,`operation`,`operand_2`,`resault`, `result_expression`  FROM results ORDER BY `id` DESC LIMIT 7";

        //Проверяем установлена ли связь
        $resultConnectionLastSeven = Database::query($queryLastSevenResults);

        // Цикл, который запускается при условии, что связь установлена.
        if ($resultConnectionLastSeven) {

            // Присваиваем переменной число, соответствующее количеству строк, полученных с помощью запроса
            $numberOfRows = Database::fetcNumRows($resultConnectionLastSeven);

            // Заполняем соответствующие массивы данными, полученными с БД
            while ($numberOfRows =  Database::fetch($resultConnectionLastSeven)) {
                $resultArray["operand1"][] = $numberOfRows['operand_1'];
                $resultArray["operand2"][] = $numberOfRows['operand_2'];
                $resultArray["operation"][] = $numberOfRows['operation'];
                $resultArray["resultOperation"][] = $numberOfRows['resault'];
                $resultArray["resultExpression"][] = $numberOfRows['result_expression'];
            }
        };
        return $resultArray;
    }
}