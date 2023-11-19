<?php
// Устанавливаем связи с базой данных
$connection = mysqli_connect('localhost', 'root', '', 'calc');

if (!$connection) {
    die('Связь не установлена :' . mysqli_connect_error());
}


// Проверяем, заполнены ли все поля. ЕСли да, присваиваем их значения соответствующим переменным
if (isset($_REQUEST['valueX'])) {
    $x = $_REQUEST['valueX'];
}

if (isset($_REQUEST['valueY'])) {
    $y = $_REQUEST['valueY'];
}

if (isset($_REQUEST['selectOption'])) {
    $operation = $_REQUEST['selectOption'];
}


//Многомерный массив (или объект), который будем возвращать в виде JSON объекта в ответ на запрос.
// Объявляем для наглядности. Работает и без объявления
$resultArray = [
    "operand1" => [],
    "operand2" => [],
    "operation" => [],
    "resultOperation" => [],
    "resultExpression" => []
];

//Переменная, куда будет записывать результат вычисления
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
// Отправляем все полученные данные в таблицу в базу данных
    mysqli_query($connection, "INSERT INTO results (operand_1, `operation`, operand_2, resault, `result_expression`) VALUES (" . $x . ", '" . $operation . "', " . $y . ", " . $calculate . ", '" . $x . $operation . $y . "=" . $calculate . "');");
}

//Присваиваем переменной строчку, которая соответствует SQL запросу на выборку последних семи результатов
$queryLastSevenResults = "SELECT `operand_1`,`operation`,`operand_2`,`resault`, `result_expression`  FROM results ORDER BY `id` DESC LIMIT 7";

//Проверяем установлена ли связь
$resultConnectionLastSeven = mysqli_query($connection, $queryLastSevenResults) or die("Ошибка: " . mysqli_error($connection));


// Цикл, который запускается при условии, что связь установлена.
// Заполняем соответствующие массивы данными, полученными с БД
if ($resultConnectionLastSeven) {

    // Присваем переменной число, соответствующее количеству строк, полученных с помощью запроса
    $numberOfRows = mysqli_num_rows($resultConnectionLastSeven);

    while ($numberOfRows = mysqli_fetch_assoc($resultConnectionLastSeven)) {
        $resultArray["operand1"][] = $numberOfRows['operand_1'];
        $resultArray["operand2"][] = $numberOfRows['operand_2'];
        $resultArray["operation"][] = $numberOfRows['operation'];
        $resultArray["resultOperation"][] = $numberOfRows['resault'];
        $resultArray["resultExpression"][] = $numberOfRows['result_expression'];
    }
};

// Преобразуем многомерный массив в JSON объект для ответа на запрос.
echo json_encode($resultArray);

// Не рассмотрена обработка ошибок. Не успел. Доработаю.
?>

